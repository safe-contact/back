<?php

namespace App\Repositories\User;

use App\Repositories\Repository;
use App\User;

class UserRepository extends Repository
{
    /**
     * @var User
     */
    protected $model;
    protected ?User $user;

    public function __construct(User $model)
    {
        $this->model = $model;
        $this->user = null;
    }

    public function findByDeviceId(string $deviceId): ?User
    {
        return $this->model->where('deviceId', $deviceId)->first();
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }
}
