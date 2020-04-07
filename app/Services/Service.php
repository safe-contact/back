<?php

namespace App\Services;

use App\Repositories\Repository;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\Service as ContractService;

abstract class Service implements ContractService
{
    /**
     * @var Repository
     */
    protected $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * permet de trouver un Model par Id
     */
    public function find($id): ?Model
    {
        return $this->repository->find($id);
    }

    /**
     * Récupère tous les models existant
     */
    public function all(): Collection
    {
        return $this->repository->all();
    }

    /**
     * récupère un model selon un critère
     */
    public function findOneByCriteria(array $criteria = []): ?Model
    {
        return $this->repository->findOneByCriteria($criteria);
    }

    /**
     * récupère un model selon plusieurs critères
     */
    public function findOneByCriterias(array $criterias): ?Model
    {
        return $this->repository->findOneByCriterias($criterias);
    }

    /**
     * Update un Model
     */
    public function update($id, array $data = []): bool
    {
        return $this->repository->update($id, $data);
    }

    /**
     * Créé un Model
     */
    public function create(array $data): ?Model
    {
        return $this->repository->create($data);
    }

    /**
     * Delete un Model
     */
    public function delete($id): bool
    {
        return $this->repository->delete($id);
    }

    public function instantiate(array $attributes): ?Model
    {
        return $this->repository->instantiate($attributes);
    }
}
