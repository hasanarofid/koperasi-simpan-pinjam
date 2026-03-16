@extends('layouts.app')

@section('title', 'Bagan Akun')

@section('content')
<div class="space-y-8 pb-12">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Bagan Akun (COA)</h1>
            <p class="text-slate-500 mt-1">Kelola daftar akun akuntansi untuk pencatatan keuangan.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="#" class="inline-flex items-center px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-2xl shadow-lg shadow-indigo-100 transition-all active:scale-95">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Tambah Akun Baru
            </a>
        </div>
    </div>

    <!-- COA Table -->
    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50 text-slate-500 text-xs font-bold uppercase tracking-wider">
                        <th class="px-8 py-4">Kode Akun</th>
                        <th class="px-8 py-4">Nama Akun</th>
                        <th class="px-8 py-4">Tipe</th>
                        <th class="px-8 py-4 text-center">Header</th>
                        <th class="px-8 py-4 text-right">Saldo Normal</th>
                        <th class="px-8 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($accounts as $account)
                    <tr class="hover:bg-slate-50/50 transition-all {{ $account->is_header ? 'bg-slate-50/30' : '' }}">
                        <td class="px-8 py-4">
                            <span class="font-mono font-bold text-slate-600 tracking-tighter">{{ $account->code }}</span>
                        </td>
                        <td class="px-8 py-4">
                            <div class="font-bold {{ $account->is_header ? 'text-slate-900' : 'text-slate-700 ml-4' }}">
                                {{ $account->name }}
                            </div>
                        </td>
                        <td class="px-8 py-4">
                            <span class="text-xs font-medium text-slate-500 uppercase tracking-widest">{{ $account->type }}</span>
                        </td>
                        <td class="px-8 py-4 text-center">
                            @if($account->is_header)
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-black bg-slate-100 text-slate-400">HEADER</span>
                            @else
                            <span class="text-slate-300">-</span>
                            @endif
                        </td>
                        <td class="px-8 py-4 text-right">
                            <span class="text-xs font-bold {{ $account->normal_balance == 'debit' ? 'text-blue-600' : 'text-rose-600' }} uppercase tracking-widest">
                                {{ $account->normal_balance }}
                            </span>
                        </td>
                        <td class="px-8 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="#" class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-white rounded-xl transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-8 py-12 text-center text-slate-400">Belum ada data bagan akun.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
