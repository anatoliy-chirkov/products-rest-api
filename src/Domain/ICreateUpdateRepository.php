<?php

namespace ProductsApi\Domain;

interface ICreateUpdateRepository
{
    public function create(array $data);
    public function update(int $id, array $data);
}
