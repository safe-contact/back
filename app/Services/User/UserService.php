<?php

namespace App\Services\User;

use App\Classes\Health\Health;
use App\Exceptions\CovidException;
use App\Facades\MeetFacade;
use App\Repositories\User\UserRepository;
use App\Services\Service;
use App\User;

class UserService extends Service
{
    /**
     * @var UserRepository
     */
    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function setCurrentSick(): bool
    {
        $user = $this->repository->getUser();
        if($user){
            $now = \Carbon\Carbon::now();
            $arraySick = [
                'sick' => true,
                'sickDate' => $now,
            ];
            if(!$user->hasSymptom()){
                $arraySick['symptom_at'] = $now;
            }
            return $this->repository->update($user->id, $arraySick);
        }
        throw new CovidException('User does not found');
    }

    public function setUser(User $user): void
    {
        $this->repository->setUser($user);
    }

    public function getUser(): ?User
    {
        return $this->repository->getUser();
    }

    /**
     * User is safe ?
     */
    public function isSafe(): Health
    {
        $user = $this->getUser();
        $health = new Health($user->sick, $user->hasSymptom(), $user->hasRecovered());
        $meets = $user->meets;
        $meeted = $user->meeted;
        $userMeets = $meets->pluck('meetedUserId');
        $usersMeeted = $meeted->pluck('userId');

        $allDeviceMeet = $userMeets->merge($usersMeeted)->unique();
        $allDeviceMeet->each(function($userIdMeet)use(&$health){
            $userMeet = $this->find($userIdMeet);
            if($userMeet){
                if($userMeet->sick){
                    $health->meetIsSick = true;
                }
                if($userMeet->hasSymptom())
                {
                    $health->meetHasSymptom = true;
                }
            }
        });

        return $health;
    }

    /**
     * Set User has recovered
     */
    public function setCurrentRecovered(): bool
    {
        $user = $this->repository->getUser();
        if($user){
            return $this->repository->update($user->id, [
                'recovery_at' => \Carbon\Carbon::now()
            ]);
        }
        throw new CovidException('User does not found');
    }

     /**
     * Set User has Symptom
     */
    public function setCurrentSymptom(): bool
    {
        $user = $this->repository->getUser();
        if($user){
            return $this->repository->update($user->id, [
                'symptom_at' => \Carbon\Carbon::now()
            ]);
        }
        throw new CovidException('User does not found');
    }
}
