<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\SavingAccount;
use App\Models\Loan;
use App\Models\LoanPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalysisController extends Controller
{
    public function index()
    {
        $stats = [
            'total_members' => Member::count(),
            'total_savings' => SavingAccount::sum('balance'),
            'total_loans' => Loan::where('status', 'active')->sum('remaining_balance'),
            'total_income' => \App\Models\LoanInstallment::where('status', 'paid')->sum('interest_amount'),
            'recent_loans' => Loan::with('member')->latest()->take(5)->get(),
        ];

        return view('analysis.index', compact('stats'));
    }
}
