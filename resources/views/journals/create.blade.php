@extends('layouts.app')

@section('title', 'Tambah Jurnal')

@section('content')
<div class="max-w-5xl mx-auto space-y-8 pb-12">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Entri Jurnal Umum</h1>
            <p class="text-slate-500 mt-1">Masukkan rincian debet dan kredit untuk transaksi keuangan.</p>
        </div>
        <a href="{{ route('journals.index') }}" class="inline-flex items-center px-4 py-2 text-slate-600 hover:text-indigo-600 hover:bg-white rounded-xl transition-all font-medium">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali
        </a>
    </div>

    <!-- Form -->
    <form action="{{ route('journals.store') }}" method="POST" id="journalForm">
        @csrf
        
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden p-8 space-y-8">
            <!-- Basic Info -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="space-y-2">
                    <label class="text-xs font-bold text-slate-400 uppercase tracking-widest">Tanggal Transaksi</label>
                    <input type="date" name="transaction_date" value="{{ old('transaction_date', date('Y-m-d')) }}" required 
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 transition-all font-bold">
                </div>
                <div class="space-y-2">
                    <label class="text-xs font-bold text-slate-400 uppercase tracking-widest">No. Referensi</label>
                    <input type="text" name="reference_number" value="{{ old('reference_number', 'JV-' . date('YmdHis')) }}" required 
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 transition-all font-bold" placeholder="JV-XXXXX">
                </div>
                <div class="space-y-2">
                    <label class="text-xs font-bold text-slate-400 uppercase tracking-widest">Keterangan Umum</label>
                    <input type="text" name="description" value="{{ old('description') }}" required 
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 transition-all" placeholder="Deskripsi transaksi">
                </div>
            </div>

            <!-- Items Table -->
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-sm font-bold text-slate-900 uppercase tracking-widest">Detail Akun (Double Entry)</h3>
                    <button type="button" onclick="addRow()" class="inline-flex items-center px-4 py-2 bg-slate-900 hover:bg-black text-white text-xs font-bold rounded-xl transition-all">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        Tambah Baris
                    </button>
                </div>

                <div class="bg-slate-50 rounded-2xl border border-slate-100 overflow-hidden">
                    <table class="w-full text-left" id="itemsTable">
                        <thead>
                            <tr class="text-[10px] text-slate-400 font-black uppercase tracking-widest border-b border-slate-100">
                                <th class="px-6 py-4">Akun Rekening</th>
                                <th class="px-6 py-4 w-32 text-center">Tipe</th>
                                <th class="px-6 py-4 w-48 text-right">Nominal (Rp)</th>
                                <th class="px-6 py-4 w-16"></th>
                            </tr>
                        </thead>
                        <tbody id="rowsContainer" class="divide-y divide-slate-100">
                            <!-- Rows will be injected here -->
                        </tbody>
                        <tfoot>
                            <tr class="bg-slate-100/50 font-black text-slate-700">
                                <td colspan="2" class="px-6 py-4 text-right text-xs uppercase tracking-widest">Total Debet / Kredit</td>
                                <td class="px-6 py-4 text-right">
                                    <div id="debitTotal" class="text-blue-600 text-sm">Rp 0</div>
                                    <div id="creditTotal" class="text-rose-600 text-sm mt-1 border-t border-slate-200 pt-1">Rp 0</div>
                                </td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                
                <div id="balanceAlert" class="hidden p-4 bg-rose-50 border border-rose-100 text-rose-600 text-xs font-bold rounded-xl flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    Jurnal tidak seimbang (Unbalanced). Total Debet harus sama dengan Total Kredit.
                </div>
            </div>

            <div class="flex items-center justify-end gap-4">
                <button type="submit" id="submitBtn" class="px-10 py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-2xl shadow-xl shadow-indigo-100 transition-all active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed">
                    Simpan Jurnal Umum
                </button>
            </div>
        </div>
    </form>
</div>

<!-- Template for Row -->
<template id="rowTemplate">
    <tr class="group hover:bg-white transition-all">
        <td class="px-6 py-3">
            <select name="items[{idx}][account_id]" required class="w-full bg-transparent border-none focus:ring-0 text-slate-800 font-bold p-0">
                <option value="">-- Pilih Akun --</option>
                @foreach($accounts as $acc)
                <option value="{{ $acc->id }}">[{{ $acc->code }}] {{ $acc->name }}</option>
                @endforeach
            </select>
        </td>
        <td class="px-6 py-3">
            <select name="items[{idx}][type]" required onchange="updateTotals()" class="w-full bg-white border border-slate-200 rounded-xl px-3 py-1.5 text-xs font-black uppercase tracking-wider focus:ring-1 focus:ring-indigo-500 transition-all">
                <option value="debit">DEBET</option>
                <option value="credit">KREDIT</option>
            </select>
        </td>
        <td class="px-6 py-3">
            <input type="number" name="items[{idx}][amount]" required min="0" oninput="updateTotals()" 
                class="w-full bg-white border border-slate-200 rounded-xl px-3 py-1.5 text-right font-bold text-slate-800 focus:ring-1 focus:ring-indigo-500 placeholder-slate-300" placeholder="0">
        </td>
        <td class="px-6 py-3 text-center">
            <button type="button" onclick="removeRow(this)" class="p-2 text-slate-300 hover:text-rose-500 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
            </button>
        </td>
    </tr>
</template>

<script>
    let rowsCount = 0;
    const container = document.getElementById('rowsContainer');
    const template = document.getElementById('rowTemplate').innerHTML;

    function addRow() {
        const idx = rowsCount++;
        const rowHtml = template.replace(/{idx}/g, idx);
        const tr = document.createElement('tr');
        tr.className = "group hover:bg-white transition-all";
        tr.innerHTML = rowHtml.replace('<tr>', '').replace('</tr>', '');
        container.appendChild(tr);
        updateTotals();
    }

    function removeRow(btn) {
        btn.closest('tr').remove();
        updateTotals();
    }

    function updateTotals() {
        let debits = 0;
        let credits = 0;

        const rows = container.querySelectorAll('tr');
        rows.forEach(row => {
            const type = row.querySelector('select[name*="[type]"]').value;
            const amount = parseFloat(row.querySelector('input[name*="[amount]"]').value) || 0;

            if (type === 'debit') debits += amount;
            else credits += amount;
        });

        document.getElementById('debitTotal').innerText = 'Rp ' + debits.toLocaleString('id-ID');
        document.getElementById('creditTotal').innerText = 'Rp ' + credits.toLocaleString('id-ID');

        const imbalance = Math.abs(debits - credits) > 0.01;
        const alert = document.getElementById('balanceAlert');
        const submitBtn = document.getElementById('submitBtn');

        if (imbalance || (debits === 0 && credits === 0)) {
            alert.classList.remove('hidden');
            submitBtn.disabled = true;
        } else {
            alert.classList.add('hidden');
            submitBtn.disabled = false;
        }
    }

    // Add initial 2 rows
    addRow();
    addRow();
</script>
@endsection
