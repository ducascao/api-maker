<?php

namespace App\Repositories;

use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get list
     *
     * @param array $filter
     * @param ?object $pagination
     * @param ?array $orderBy
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function list(array $filter = [], ?object $pagination = null, ?array $orderBy = null): object
    {
        $query = $this->query($filter, $pagination, $orderBy);

        return $query->get();
    }

    /**
     * Get query
     *
     * @param array $filter
     * @param ?object $pagination
     * @param ?array $orderBy
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(array $filter = [], ?object $pagination = null, ?array $orderBy = null): object
    {
        $query = $this->model->where($filter);

        if ($orderBy) {
            $query->orderBy(...$orderBy);
        }

        if ($pagination && $pagination->per_page) {
            return $query->paginate($pagination->per_page);
        }

        return $query;
    }

    /**
     * Get By Id
     *
     * @param number $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function get(int $id): object
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Save
     *
     * @param array $data
     * @param ?number $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function save(array $data, ?int $id = null): object
    {
        $model = new $this->model();

        if ($id) {
            $model = $model->findOrFail($id);
        }

        $model->fill($data);
        $model->save();

        return $model;
    }

    /**
     * Delete
     *
     * @param number $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function delete(int $id): object
    {
        $model = $this->model->findOrFail($id);

        $model->delete();

        return $model;
    }
}
