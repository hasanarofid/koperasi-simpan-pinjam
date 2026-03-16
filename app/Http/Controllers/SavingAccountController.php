<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SavingAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accounts = \App\Models\SavingAccount::with(['member', 'savingType'])->latest()->paginate(10);
        return view('savings.index', compact('accounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $members = \App\Models\Member::orderBy('name')->get();
        $savingTypes = \App\Models\SavingType::all();
        return view('savings.create', compact('members', 'savingTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(\Illuminate\Http\Request $request)
    {
        $validated = $request->validate([
            'member_id' => 'required|exists:members,id',
            'saving_type_id' => 'required|exists:saving_types,id',
            'account_number' => 'required|string|unique:saving_accounts,account_number',
        ]);

        $validated['balance'] = 0;
        $validated['status'] = 'active';

        \App\Models\SavingAccount::create($validated);

        return redirect()->route('savings.index')->with('success', 'Rekening simpanan berhasil dibuka.');
    }

    /**
     * Display the specified resource.
     */
    public function show(\App\Models\SavingAccount $account)
    {
        $account->load(['member', 'savingType', 'transactions' => function($q) {
            $q->latest()->take(10);
        }]);
        return view('savings.show', compact('account'));
    }

    public function deposit(\Illuminate\Http\Request $request, \App\Models\SavingAccount $account)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:1000',
            'description' => 'nullable|string|max:255',
        ]);

        \Illuminate\Support\Facades\DB::transaction(function () use ($account, $validated) {
            $account->transactions()->create([
                'transaction_date' => now(),
                'type' => 'deposit',
                'amount' => $validated['amount'],
                'reference_number' => 'DEP-' . now()->format('YmdHis'),
                'description' => $validated['description'] ?? 'Setoran Tunai',
            ]);

            $account->increment('balance', $validated['amount']);
        });

        return redirect()->back()->with('success', 'Setoran berhasil diproses.');
    }

    public function withdraw(\Illuminate\Http\Request $request, \App\Models\SavingAccount $account)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:1000',
            'description' => 'nullable|string|max:255',
        ]);

        if ($account->balance < $validated['amount']) {
            return redirect()->back()->withErrors(['amount' => 'Saldo tidak mencukupi untuk penarikan ini.']);
        }

        \Illuminate\Support\Facades\DB::transaction(function () use ($account, $validated) {
            $account->transactions()->create([
                'transaction_date' => now(),
                'type' => 'withdrawal',
                'amount' => $validated['amount'],
                'reference_number' => 'WD-' . now()->format('YmdHis'),
                'description' => $validated['description'] ?? 'Penarikan Tunai',
            ]);

            $account->decrement('balance', $validated['amount']);
        });

        return redirect()->back()->with('success', 'Penarikan berhasil diproses.');
    }
}
