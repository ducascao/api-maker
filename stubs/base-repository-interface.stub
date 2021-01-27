<?php

namespace App\Repositories\Interfaces;

interface BaseRepositoryInterface
{
    public function list(array $filter = [], ?object $pagination = null, ?array $orderBy = null): object;
    public function query(array $filter = [], ?object $pagination = null, ?array $orderBy = null): object;
    public function get(int $id): object;
    public function save(array $data, ?int $id = null): object;
    public function delete(int $id): object;
}
