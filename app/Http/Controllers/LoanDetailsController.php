<?php

namespace App\Http\Controllers;
use App\Models\LoanDetail;

use Illuminate\Http\Request;

class LoanDetailsController extends Controller
{
    public function index()
    {
        $loanDetails = LoanDetail::all();
        return view('loan_details.index', compact('loanDetails'));
    }
}
