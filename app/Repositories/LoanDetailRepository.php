<?php

namespace App\Repositories;

use App\Models\LoanDetail;

class LoanDetailRepository implements LoanDetailRepositoryInterface
{
    public function all()
    {
        return LoanDetail::all();
    }

    public function find($id)
    {
        return LoanDetail::findOrFail($id);
    }

    public function create(array $data)
    {
        return LoanDetail::create($data);
    }
}
