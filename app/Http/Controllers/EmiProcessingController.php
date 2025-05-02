<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\LoanDetail;
use Carbon\Carbon;

class EmiProcessingController extends Controller
{
    public function showForm()
    {
        return view('emi.process');
    }

    public function viewEmiDetails()
    {
        $emiDetails = DB::table('emi_details')->paginate(10);
        return view('emi.view', compact('emiDetails'));
    }

    public function process()
    {
        $loans = LoanDetail::all();

        if ($loans->isEmpty()) {
            return back()->with('error', 'No loan data found.');
        }

        $minDate = Carbon::parse($loans->min('first_payment_date'))->startOfMonth();
        $maxDate = Carbon::parse($loans->max('last_payment_date'))->startOfMonth();

        $columns = [];
        while ($minDate <= $maxDate) {
            $columns[] = $minDate->format('Y_M');
            $minDate->addMonth();
        }

        // Drop if exists, then create emi_details table
        DB::statement("DROP TABLE IF EXISTS emi_details");

        $columnSql = implode(', ', array_map(fn($col) => "`$col` DECIMAL(10,2) DEFAULT 0.00", $columns));
        DB::statement("CREATE TABLE emi_details (clientid INT, $columnSql)");

        // Insert EMI data
        foreach ($loans as $loan) {
            $firstDate = Carbon::parse($loan->first_payment_date)->startOfMonth();
            $emi = round($loan->loan_amount / $loan->num_of_payment, 2);
            $emis = [];
            $sum = 0;

            for ($i = 0; $i < $loan->num_of_payment; $i++) {
                $monthKey = $firstDate->format('Y_M');
                if (!isset($emis[$monthKey])) {
                    $emis[$monthKey] = 0;
                }

                $isLast = ($i === $loan->num_of_payment - 1);
                $emis[$monthKey] += $isLast
                    ? round($loan->loan_amount - $sum, 2)
                    : $emi;

                $sum += $emis[$monthKey];
                $firstDate->addMonth();
            }

            $cols = array_merge(['clientid' => $loan->clientid], array_fill_keys($columns, 0.00));
            foreach ($emis as $key => $value) {
                $cols[$key] = $value;
            }

            $fields = implode(', ', array_map(fn($k) => "`$k`", array_keys($cols)));
            $values = implode(', ', array_map(fn($v) => is_numeric($v) ? $v : "'$v'", $cols));
            DB::statement("INSERT INTO emi_details ($fields) VALUES ($values)");
        }
        
        return redirect()->back()->with('success', 'EMI Data Processed and Table Created!');
    }
}

