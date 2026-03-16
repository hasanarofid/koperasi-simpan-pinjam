<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loans = \App\Models\Loan::with(['member', 'loanScheme'])->latest()->paginate(10);
        return view('loans.index', compact('loans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $members = \App\Models\Member::orderBy('name')->get();
        $loanSchemes = \App\Models\LoanScheme::all();
        return view('loans.create', compact('members', 'loanSchemes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(\Illuminate\Http\Request $request)
    {
        $validated = $request->validate([
            'member_id' => 'required|exists:members,id',
            'loan_scheme_id' => 'required|exists:loan_schemes,id',
            'principal_amount' => 'required|numeric|min:100000',
            'duration_months' => 'required|integer|min:1|max:60',
            'purpose' => 'nullable|string',
        ]);

        $scheme = \App\Models\LoanScheme::findOrFail($validated['loan_scheme_id']);
        
        // Calculate totals
        $interestRate = $scheme->interest_rate;
        $totalInterest = $validated['principal_amount'] * ($interestRate / 100) * $validated['duration_months'];
        $totalAmount = $validated['principal_amount'] + $totalInterest;
        $monthlyInstallment = round($totalAmount / $validated['duration_months']);

        \Illuminate\Support\Facades\DB::transaction(function () use ($validated, $scheme, $monthlyInstallment, $totalAmount) {
            // 1. Create Application (Approved)
            $application = \App\Models\LoanApplication::create([
                'member_id' => $validated['member_id'],
                'loan_scheme_id' => $validated['loan_scheme_id'],
                'amount_requested' => $validated['principal_amount'],
                'duration_months' => $validated['duration_months'],
                'purpose' => $validated['purpose'],
                'status' => 'approved',
            ]);

            // 2. Create Loan
            \App\Models\Loan::create([
                'member_id' => $validated['member_id'],
                'loan_application_id' => $application->id,
                'loan_scheme_id' => $validated['loan_scheme_id'],
                'loan_number' => 'LOAN-' . now()->format('YmdHis'),
                'principal_amount' => $validated['principal_amount'],
                'interest_rate' => $scheme->interest_rate,
                'duration_months' => $validated['duration_months'],
                'monthly_installment' => $monthlyInstallment,
                'remaining_balance' => $totalAmount,
                'disbursement_date' => now(),
                'status' => 'active',
            ]);
        });

        return redirect()->route('loans.index')->with('success', 'Pinjaman berhasil dicairkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(\App\Models\Loan $loan)
    {
        $loan->load(['member', 'loanScheme', 'installments' => function($q) {
            $q->orderBy('installment_number', 'asc');
        }]);
        return view('loans.show', compact('loan'));
    }

    public function payInstallment(\Illuminate\Http\Request $request, \App\Models\Loan $loan)
    {
        if ($loan->status !== 'active') {
            return redirect()->back()->withErrors(['error' => 'Pinjaman ini sudah tidak aktif atau sudah lunas.']);
        }

        \Illuminate\Support\Facades\DB::transaction(function () use ($loan) {
            $nextNumber = $loan->installments()->count() + 1;
            $amount = $loan->monthly_installment;

            // If remaining balance is less than standard installment (e.g. last payment)
            if ($loan->remaining_balance < $amount) {
                $amount = $loan->remaining_balance;
            }

            $loan->installments()->create([
                'installment_number' => $nextNumber,
                'amount_paid' => $amount,
                'payment_date' => now(),
                'status' => 'paid',
            ]);

            $loan->decrement('remaining_balance', $amount);

            if ($loan->remaining_balance <= 0) {
                $loan->update(['status' => 'closed']);
            }
        });

        return redirect()->back()->with('success', 'Pembayaran angsuran berhasil diproses.');
    }
}
