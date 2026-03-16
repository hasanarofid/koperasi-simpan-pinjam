@extends('layouts.app')

@section('title', 'Laporan Transaksi')

@section('content')
<div class="space-y-8 pb-12">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Laporan Transaksi</h1>
            <p class="text-slate-500 mt-1">Rekapitulasi seluruh aktivitas simpanan dan pinjaman anggota.</p>
        </div>
        <div class="flex items-center gap-3">
            <button class="inline-flex items-center px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-2xl shadow-lg shadow-emerald-100 transition-all active:scale-95">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Ekspor Excel
            </button>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm flex flex-wrap items-center gap-4">
        <div class="flex-1 min-w-[200px]">
            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1 block">Periode</label>
            <div class="grid grid-cols-2 gap-2">
                <input type="date" class="bg-slate-50 border border-slate-100 rounded-xl px-3 py-2 text-xs focus:ring-1 focus:ring-indigo-500" value="{{ date('Y-m-01') }}">
                <input type="date" class="bg-slate-50 border border-slate-100 rounded-xl px-3 py-2 text-xs focus:ring-1 focus:ring-indigo-500" value="{{ date('Y-m-d') }}">
            </div>
        </div>
        <div class="flex-1 min-w-[150px]">
            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1 block">Jenis Transaksi</label>
            <select class="w-full bg-slate-50 border border-slate-100 rounded-xl px-3 py-2 text-xs focus:ring-1 focus:ring-indigo-500">
                <option>Semua Transaksi</option>
                <option>Simpanan</option>
                <option>Pinjaman</option>
                <option>Angsuran</option>
            </select>
        </div>
        <div class="flex items-end">
            <button class="px-6 py-2 bg-slate-900 text-white text-xs font-bold rounded-xl hover:bg-black transition-all">Filter</button>
        </div>
    </div>

    <!-- Placeholder List -->
    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden p-12 text-center">
        <div class="mx-auto w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-300 mb-6 rotate-3">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
        </div>
        <h3 class="text-xl font-bold text-slate-800 mb-2">Laporan Transaksi Terpadu</h3>
        <p class="text-slate-500 max-w-sm mx-auto text-sm">Gunakan filter di atas untuk menarik data transaksi spesifik. Modul laporan ini mendukung ekspor data ke format PDF dan Excel untuk keperluan audit.</p>
    </div>
</div>
@endsection
