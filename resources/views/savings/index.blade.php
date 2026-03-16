@extends('layouts.app')

@section('title', 'Data Simpanan')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Data Simpanan</h1>
            <p class="text-slate-500 mt-1">Kelola rekening simpanan anggota koperasi.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('savings.create') }}" class="inline-flex items-center px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-2xl shadow-lg shadow-indigo-100 transition-all active:scale-95">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Buka Rekening Baru
            </a>
        </div>
    </div>

    <!-- Savings Table -->
    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50 text-slate-500 text-xs font-bold uppercase tracking-wider">
                        <th class="px-8 py-4">No. Rekening</th>
                        <th class="px-8 py-4">Nama Anggota</th>
                        <th class="px-8 py-4">Jenis Simpanan</th>
                        <th class="px-8 py-4 text-right">Saldo Saat Ini</th>
                        <th class="px-8 py-4">Status</th>
                        <th class="px-8 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 transition-all duration-300">
                    @forelse($accounts as $account)
                    <tr class="hover:bg-slate-50/50">
                        <td class="px-8 py-4">
                            <span class="font-bold text-slate-800 tracking-wider">{{ $account->account_number }}</span>
                        </td>
                        <td class="px-8 py-4">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full bg-slate-100 text-slate-600 flex items-center justify-center text-xs font-bold">
                                    {{ substr($account->member->name, 0, 2) }}
                                </div>
                                <span class="ml-3 font-semibold text-slate-700">{{ $account->member->name }}</span>
                            </div>
                        </td>
                        <td class="px-8 py-4 text-sm text-slate-600">
                            {{ $account->savingType->name }}
                        </td>
                        <td class="px-8 py-4 text-right font-bold text-indigo-600">
                            Rp {{ number_format($account->balance) }}
                        </td>
                        <td class="px-8 py-4">
                            <span class="px-2.5 py-1 rounded-lg {{ $account->status == 'active' ? 'bg-emerald-50 text-emerald-600' : 'bg-rose-50 text-rose-600' }} text-[10px] font-bold uppercase">
                                {{ $account->status == 'active' ? 'Aktif' : 'Tutup' }}
                            </span>
                        </td>
                        <td class="px-8 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('savings.show', $account) }}" class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-all" title="Transaksi / Detail">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-8 py-12 text-center text-slate-500">Belum ada data rekening simpanan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($accounts->hasPages())
        <div class="px-8 py-4 border-t border-slate-100 bg-slate-50/50">
            {{ $accounts->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
