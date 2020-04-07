<?php

namespace App\Contracts;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

interface Service
{
    public function find($id): ?Model;

    public function all(): Collection;

    public function findOneByCriteria(array $criteria = []): ?Model;

    public function findOneByCriterias(array $criterias): ?Model;

    public function update($id, array $data = []): bool;

    public function create(array $data): ?Model;

    public function delete($id): bool;
}
