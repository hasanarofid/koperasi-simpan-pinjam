@extends('layouts.app')

@section('title', 'Laporan SHU')

@section('content')
<div class="space-y-8 pb-12">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Sisa Hasil Usaha (SHU)</h1>
            <p class="text-slate-500 mt-1">Laporan surplus hasil usaha koperasi yang akan dibagikan ke anggota.</p>
        </div>
        <div class="flex items-center gap-3">
            <button class="inline-flex items-center px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-2xl shadow-lg shadow-indigo-100 transition-all active:scale-95">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Unduh PDF
            </button>
        </div>
    </div>

    <!-- Summary Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-sm">
            <div class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Total Pendapatan</div>
            <div class="text-3xl font-black text-emerald-600">Rp 45,250,000</div>
            <div class="mt-4 text-[10px] text-slate-400 uppercase tracking-wider">Pendapatan Bunga & Provisi</div>
        </div>
        <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-sm">
            <div class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Total Beban</div>
            <div class="text-3xl font-black text-rose-600">Rp 12,800,000</div>
            <div class="mt-4 text-[10px] text-slate-400 uppercase tracking-wider">Operasional & Gaji</div>
        </div>
        <div class="bg-indigo-600 rounded-3xl p-8 shadow-xl shadow-indigo-100 text-white">
            <div class="text-indigo-200 text-xs font-bold uppercase tracking-widest mb-1">Estimasi SHU Bersih</div>
            <div class="text-3xl font-black">Rp 32,450,000</div>
            <div class="mt-4 text-indigo-300 text-[10px] font-bold uppercase tracking-wider">Siap Dibagikan</div>
        </div>
    </div>

    <!-- SHU Placeholder -->
    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden p-12 text-center space-y-4">
        <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto text-slate-300">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
        </div>
        <h3 class="text-xl font-bold text-slate-800">Modul Perhitungan SHU Dinamis</h3>
        <p class="text-slate-500 max-w-md mx-auto">Modul ini akan menghitung alokasi SHU untuk setiap anggota berdasarkan kontribusi simpanan dan jasa pinjaman mereka selama satu periode fiskal.</p>
    </div>
</div>
@endsection
