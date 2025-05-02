<?php

namespace App\Repositories;

interface LoanDetailRepositoryInterface
{
    public function all();
    public function find($id);
    public function create(array $data);
}
