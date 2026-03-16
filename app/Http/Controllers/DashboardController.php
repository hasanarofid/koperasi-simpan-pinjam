<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_members' => \App\Models\Member::count(),
            'total_savings' => \App\Models\SavingAccount::sum('balance'),
            'active_loans' => \App\Models\Loan::where('status', 'active')->sum('remaining_balance'),
            'gross_revenue' => \App\Models\LoanInstallment::where('status', 'paid')->sum('interest_amount'),
        ];

        $recent_members = \App\Models\Member::latest()->take(5)->get();

        return view('dashboard', compact('stats', 'recent_members'));
    }
}
