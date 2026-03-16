@extends('layouts.app')

@section('title', 'Jenis Simpanan')

@section('content')
<div class="space-y-8 pb-12">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Jenis Simpanan</h1>
            <p class="text-slate-500 mt-1">Konfigurasi berbagai produk simpanan yang ditawarkan koperasi.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="#" class="inline-flex items-center px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-2xl shadow-lg shadow-indigo-100 transition-all active:scale-95">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Tambah Jenis Simpanan
            </a>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden text-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50 text-slate-500 text-[10px] font-black uppercase tracking-wider">
                        <th class="px-8 py-4">Nama Produk</th>
                        <th class="px-8 py-4 text-center">Bunga / thn</th>
                        <th class="px-8 py-4 text-right">Min. Setoran</th>
                        <th class="px-8 py-4 text-right">Min. Saldo</th>
                        <th class="px-8 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($types as $type)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-8 py-4">
                            <div class="font-bold text-slate-900">{{ $type->name }}</div>
                            <div class="text-[10px] text-slate-400 font-medium lowercase italic">{{ str_replace('_', ' ', $type->code) }}</div>
                        </td>
                        <td class="px-8 py-4 text-center">
                            <span class="px-2 py-1 rounded-lg bg-indigo-50 text-indigo-600 font-bold">{{ $type->interest_rate }}%</span>
                        </td>
                        <td class="px-8 py-4 text-right font-medium text-slate-600">
                            Rp {{ number_format($type->minimum_deposit) }}
                        </td>
                        <td class="px-8 py-4 text-right font-medium text-slate-600">
                            Rp {{ number_format($type->minimum_balance) }}
                        </td>
                        <td class="px-8 py-4 text-right">
                            <a href="#" class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-white rounded-xl transition-all inline-block">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-12 text-center text-slate-400">Belum ada data jenis simpanan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
