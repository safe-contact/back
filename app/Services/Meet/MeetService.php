<?php

namespace App\Services\Meet;

use App\Exceptions\CovidException;
use App\Facades\UserFacade;
use App\Models\Meet;
use App\Repositories\Meet\MeetRepository;
use App\Services\Service;

class MeetService extends Service
{
    /**
     * @var MeetRepository
     */
    protected $repository;

    public function __construct(MeetRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getLastMeet(string $userId): ?Meet
    {
        $user = UserFacade::getUser();
        if($user){
            return $this->repository->getLastMeet($user, $userId);
        }
        throw new CovidException('User does not found');
    }

    /**
     * Create meets for an user
     */
    public function createForUser(array $meetings): void
    {
        $meetingsColl = collect($meetings);
        $user = UserFacade::getUser();
        $meetingsColl->each(function($meeting) use($user){
            if(isset($meeting['meetedUserId']) && isset($meeting['meetingDate'])){
                $meeting['userId'] = $user->id;
                $meeting['rssi'] ??= -200;
                $newMeet = $this->instantiate($meeting);

                $lastMeet = $this->getLastMeet($meeting['meetedUserId']);
                if($this->canAddNewMeet($newMeet, $lastMeet)){
                    try{
                       $newMeet->save();
                    }
                    catch(\Exception $e)
                    {
                        report($e);
                    }
                }
                else{
                    if($newMeet->rssi > $lastMeet->rssi){
                        $lastMeet->rssi = $newMeet->rssi;
                        $lastMeet->save();
                    }
                }
            }
        });
    }

    /**
     * Need to add meet ?
     */
    public function canAddNewMeet(Meet $newMeet, ?Meet $lastMeet): bool
    {
        if(!$lastMeet){
            return true;
        }
        if($this->getDiffBetweenTwoMeetsInHour($newMeet, $lastMeet) > config('custom.time_between_meeting')){
            return true;
        }
        return false;
    }

    /**
     * Diff in minutes between two meets
     */
    public function getDiffBetweenTwoMeetsInHour(Meet $newMeet, Meet $lastMeet): int
    {
        //doit fait un accessor et mutator
        $newMeetingDate = new \Carbon\Carbon($newMeet->meetingDate);
        $lastMeetingDate = new \Carbon\Carbon($lastMeet->meetingDate);
        return $lastMeetingDate->diffInMinutes($newMeetingDate, false);
    }
}
