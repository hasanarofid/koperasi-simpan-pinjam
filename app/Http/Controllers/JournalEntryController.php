<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JournalEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $journals = \App\Models\JournalEntry::with('items.account')->latest('transaction_date')->paginate(10);
        return view('journals.index', compact('journals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $accounts = \App\Models\ChartOfAccount::where('is_header', false)->orderBy('code')->get();
        return view('journals.create', compact('accounts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(\Illuminate\Http\Request $request)
    {
        $validated = $request->validate([
            'transaction_date' => 'required|date',
            'reference_number' => 'required|string|unique:journal_entries,reference_number',
            'description' => 'required|string|max:255',
            'items' => 'required|array|min:2',
            'items.*.account_id' => 'required|exists:chart_of_accounts,id',
            'items.*.type' => 'required|in:debit,credit',
            'items.*.amount' => 'required|numeric|min:0',
        ]);

        $debitTotal = 0;
        $creditTotal = 0;
        foreach ($validated['items'] as $item) {
            if ($item['type'] === 'debit') $debitTotal += $item['amount'];
            else $creditTotal += $item['amount'];
        }

        if (abs($debitTotal - $creditTotal) > 0.01) {
            return redirect()->back()->withErrors(['error' => 'Total Debet dan Kredit tidak seimbang.'])->withInput();
        }

        \Illuminate\Support\Facades\DB::transaction(function () use ($validated) {
            $entry = \App\Models\JournalEntry::create([
                'transaction_date' => $validated['transaction_date'],
                'reference_number' => $validated['reference_number'],
                'description' => $validated['description'],
                'status' => 'posted',
            ]);

            foreach ($validated['items'] as $item) {
                $entry->items()->create($item);
            }
        });

        return redirect()->route('journals.index')->with('success', 'Entri jurnal berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
