<?php

namespace App\Repositories\Contracts;

interface UserPointRepositoryContract
{
    public function index(array $fields);

    public function find(int $id);

    public function save(array $fields);

    public function update(int $id, array $fields);

    public function delete(int $id);
}
