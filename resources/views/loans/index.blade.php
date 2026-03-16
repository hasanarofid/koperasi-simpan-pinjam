@extends('layouts.app')

@section('title', 'Data Pinjaman')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Data Pinjaman</h1>
            <p class="text-slate-500 mt-1">Kelola pinjaman dan penagihan angsuran anggota.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('loans.create') }}" class="inline-flex items-center px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-2xl shadow-lg shadow-indigo-100 transition-all active:scale-95">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Pengajuan Pinjaman Baru
            </a>
        </div>
    </div>

    <!-- Loans Table -->
    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50 text-slate-500 text-xs font-bold uppercase tracking-wider">
                        <th class="px-8 py-4">No. Pinjaman</th>
                        <th class="px-8 py-4">Nama Anggota</th>
                        <th class="px-8 py-4">Jenis & Tenor</th>
                        <th class="px-8 py-4 text-right">Pokok Pinjaman</th>
                        <th class="px-8 py-4 text-right">Sisa Tagihan</th>
                        <th class="px-8 py-4">Status</th>
                        <th class="px-8 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 transition-all duration-300">
                    @forelse($loans as $loan)
                    <tr class="hover:bg-slate-50/50">
                        <td class="px-8 py-4">
                            <span class="font-bold text-slate-800 tracking-wider">{{ $loan->loan_number }}</span>
                        </td>
                        <td class="px-8 py-4">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full bg-slate-100 text-slate-600 flex items-center justify-center text-xs font-bold">
                                    {{ substr($loan->member->name, 0, 2) }}
                                </div>
                                <span class="ml-3 font-semibold text-slate-700">{{ $loan->member->name }}</span>
                            </div>
                        </td>
                        <td class="px-8 py-4">
                            <div class="text-sm font-medium text-slate-800">{{ $loan->loanScheme->name }}</div>
                            <div class="text-[10px] text-slate-400 font-bold uppercase">{{ $loan->duration_months }} Bulan</div>
                        </td>
                        <td class="px-8 py-4 text-right font-medium text-slate-600">
                            Rp {{ number_format($loan->principal_amount) }}
                        </td>
                        <td class="px-8 py-4 text-right font-bold text-rose-600">
                            Rp {{ number_format($loan->remaining_balance) }}
                        </td>
                        <td class="px-8 py-4">
                            <span class="px-2.5 py-1 rounded-lg {{ $loan->status == 'active' ? 'bg-blue-50 text-blue-600' : 'bg-emerald-50 text-emerald-600' }} text-[10px] font-bold uppercase">
                                {{ $loan->status == 'active' ? 'Berjalan' : 'Lunas' }}
                            </span>
                        </td>
                        <td class="px-8 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('loans.show', $loan) }}" class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-all" title="Detail / Angsuran">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path></svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-8 py-12 text-center text-slate-500">Belum ada data pinjaman.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($loans->hasPages())
        <div class="px-8 py-4 border-t border-slate-100 bg-slate-50/50">
            {{ $loans->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
