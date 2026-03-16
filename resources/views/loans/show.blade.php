@extends('layouts.app')

@section('title', 'Detail Pinjaman')

@section('content')
<div class="space-y-8 pb-12">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center">
            <a href="{{ route('loans.index') }}" class="p-2 mr-4 text-slate-400 hover:text-indigo-600 hover:bg-white rounded-xl transition-all">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <div>
                <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Detail Pinjaman</h1>
                <p class="text-slate-500 mt-1">Informasi angsuran dan sisa tagihan {{ $loan->loan_number }}.</p>
            </div>
        </div>
        @if($loan->status == 'active')
        <form action="{{ route('loans.pay', $loan) }}" method="POST" onsubmit="return confirm('Proses pembayaran angsuran bulan ini?')">
            @csrf
            <button type="submit" class="inline-flex items-center px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-2xl shadow-lg shadow-emerald-100 transition-all active:scale-95">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                Bayar Angsuran
            </button>
        </form>
        @endif
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Loan Summary Cards -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Main Info Card -->
            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-8">
                <div class="flex items-center justify-between mb-6">
                    <span class="px-3 py-1 rounded-full {{ $loan->status == 'active' ? 'bg-blue-50 text-blue-600' : 'bg-emerald-50 text-emerald-600' }} text-[10px] font-black uppercase tracking-wider">
                        {{ $loan->status == 'active' ? 'Pinjaman Aktif' : 'Lunas / Tutup' }}
                    </span>
                    <span class="text-xs font-bold text-slate-400">{{ $loan->loan_number }}</span>
                </div>
                
                <div class="space-y-6">
                    <div>
                        <div class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mb-1">Anggota</div>
                        <div class="text-lg font-bold text-slate-900">{{ $loan->member->name }}</div>
                        <div class="text-xs text-slate-500">{{ $loan->member->member_number }}</div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4 pt-6 border-t border-slate-50">
                        <div>
                            <div class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mb-1">Tenor</div>
                            <div class="font-bold text-slate-800">{{ $loan->duration_months }} Bulan</div>
                        </div>
                        <div>
                            <div class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mb-1">Bunga</div>
                            <div class="font-bold text-slate-800">{{ $loan->interest_rate }}% / bln</div>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-slate-50">
                        <div class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mb-1">Angsuran Bulanan</div>
                        <div class="text-2xl font-black text-indigo-600">Rp {{ number_format($loan->monthly_installment) }}</div>
                    </div>
                </div>
            </div>

            <!-- Balance Card -->
            <div class="bg-rose-50 rounded-3xl p-8 border border-rose-100">
                <div class="text-rose-400 text-[10px] font-bold uppercase tracking-widest mb-1">Sisa Tagihan</div>
                <div class="text-3xl font-black text-rose-600">Rp {{ number_format($loan->remaining_balance) }}</div>
                
                <div class="mt-6 h-2 bg-rose-100 rounded-full overflow-hidden">
                    @php
                        $totalLoan = $loan->principal_amount * (1 + ($loan->interest_rate / 100 * $loan->duration_months));
                        $progress = min(100, max(0, (1 - ($loan->remaining_balance / $totalLoan)) * 100));
                    @endphp
                    <div class="h-full bg-rose-500 transition-all duration-1000" style="width: {{ $progress }}%"></div>
                </div>
                <div class="mt-2 flex justify-between text-[10px] font-bold text-rose-400 uppercase tracking-wider">
                    <span>Progres Pelunasan</span>
                    <span>{{ round($progress) }}%</span>
                </div>
            </div>
        </div>

        <!-- Installment History -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-8 py-6 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
                    <h3 class="text-lg font-bold text-slate-800">Riwayat Pembayaran Angsuran</h3>
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left font-sans">
                        <thead>
                            <tr class="text-slate-500 text-[10px] font-bold uppercase tracking-wider border-b border-slate-50">
                                <th class="px-8 py-4">Ke-</th>
                                <th class="px-8 py-4">Tanggal Bayar</th>
                                <th class="px-8 py-4 text-right">Jumlah Dibayar</th>
                                <th class="px-8 py-4 text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($loan->installments as $ins)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-8 py-4">
                                    <div class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center text-xs font-bold text-slate-600">
                                        {{ $ins->installment_number }}
                                    </div>
                                </td>
                                <td class="px-8 py-4 text-sm font-medium text-slate-700">
                                    {{ \Carbon\Carbon::parse($ins->payment_date)->format('d M Y H:i') }}
                                </td>
                                <td class="px-8 py-4 text-right text-sm font-black text-slate-800">
                                    Rp {{ number_format($ins->amount_paid) }}
                                </td>
                                <td class="px-8 py-4 text-center">
                                    <span class="px-2 py-1 rounded-lg bg-emerald-50 text-emerald-600 text-[10px] font-black uppercase">PAID</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-8 py-12 text-center text-slate-400 italic font-medium">Belum ada pembayaran angsuran yang tercatat.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
