<?php

namespace ProductsApi\Domain;

interface IRepository
{
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
}
