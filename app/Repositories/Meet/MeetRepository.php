<?php

namespace App\Repositories\Meet;

use App\Models\Meet;
use App\Repositories\Repository;
use App\User;

class MeetRepository extends Repository
{
    /**
     * @var Meet
     */
    protected $model;

    public function __construct(Meet $model)
    {
        $this->model = $model;
    }

    /**
     * get last meet between two user has met this user
     */
    public function getLastMeet(User $user, string $userId): ?Meet
    {
        return $this->model->where('userId', $user->id)
                    ->where('meetedUserId', $userId)
                    ->orderBy('meetingDate', 'desc')->first();
    }
}
