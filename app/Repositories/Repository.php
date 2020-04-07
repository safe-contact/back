<?php

namespace App\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\Repository as ContractRepository;
use App\Exceptions\CovidException;

abstract class Repository implements ContractRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get Model By Id
     */
    public function find($id): ?Model
    {
        return $this->model->find($id);
    }

    /**
     * Get All Models
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    /**
     * get Model By Criteria
     */
    public function findOneByCriteria(array $criteria = []): ?Model
    {
        if (count($criteria) > 0) {
            return $this->model->where($criteria)->first();
        }
        return null;
    }

    /**
     * Get Model By Criterias
     */
    public function findOneByCriterias(array $criterias): ?Model
    {
        if (count($criterias) > 0) {
            $queryBuilder = $this->model->query();
            foreach ($criterias as $key => $criteria) {
                $queryBuilder->where($criteria[0], $criteria[1], $criteria[2]);
            }
            return $queryBuilder->first();
        } else {
            return null;
        }
    }

    /**
     * Update a model
     */
    public function update($id, array $data = []): bool
    {
        if ($model = $this->find($id)) {
            return $model->update($data);
        }
        throw new CovidException('Model does not Found');
    }

    /**
     * Create model
     */
    public function create(array $data): ?Model
    {
        return $this->model->create($data);
    }

    /**
     * Delete model
     */
    public function delete($id): bool
    {
        $model = $this->find($id);
        if ($model) {
            return $model->delete();
        }
        throw new CovidException('Model does not found');
    }

    public function instantiate(array $attributes): ?Model
    {
        return $this->model->newInstance($attributes);
    }
}
