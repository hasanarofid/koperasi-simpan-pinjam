@extends('layouts.app')

@section('title', 'Jurnal Umum')

@section('content')
<div class="space-y-8 pb-12">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Jurnal Umum</h1>
            <p class="text-slate-500 mt-1">Catatan transaksi keuangan sistem akuntansi koperasi.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('journals.create') }}" class="inline-flex items-center px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-2xl shadow-lg shadow-indigo-100 transition-all active:scale-95">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Buat Entri Jurnal
            </a>
        </div>
    </div>

    <!-- Journals Table -->
    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50 text-slate-500 text-[10px] font-bold uppercase tracking-wider">
                        <th class="px-8 py-4">Tanggal / Ref</th>
                        <th class="px-8 py-4">Keterangan</th>
                        <th class="px-8 py-4">Rincian Akun</th>
                        <th class="px-8 py-4 text-right">Debit</th>
                        <th class="px-8 py-4 text-right">Kredit</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($journals as $journal)
                    <tr class="hover:bg-slate-50/30 transition-all">
                        <td class="px-8 py-6 align-top">
                            <div class="text-sm font-bold text-slate-700">{{ \Carbon\Carbon::parse($journal->transaction_date)->format('d/m/Y') }}</div>
                            <div class="text-[10px] text-slate-400 font-bold tracking-widest mt-1">{{ $journal->reference_number }}</div>
                        </td>
                        <td class="px-8 py-6 align-top">
                            <div class="text-sm text-slate-600 max-w-[200px]">{{ $journal->description }}</div>
                        </td>
                        <td class="px-0 py-0" colspan="3">
                            <table class="w-full">
                                <tbody class="divide-y divide-slate-50/50">
                                    @foreach($journal->items as $item)
                                    <tr>
                                        <td class="px-8 py-3 text-xs">
                                            <div class="flex items-center">
                                                <span class="font-mono text-slate-400 mr-2">[{{ $item->account->code }}]</span>
                                                <span class="{{ $item->type == 'credit' ? 'ml-6 italic' : 'font-semibold' }} text-slate-700">
                                                    {{ $item->account->name }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="px-8 py-3 text-right text-xs font-bold text-slate-900 w-32">
                                            {{ $item->type == 'debit' ? 'Rp '.number_format($item->amount) : '' }}
                                        </td>
                                        <td class="px-8 py-3 text-right text-xs font-bold text-slate-900 w-32">
                                            {{ $item->type == 'credit' ? 'Rp '.number_format($item->amount) : '' }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-12 text-center text-slate-400">Belum ada entri jurnal.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($journals->hasPages())
        <div class="px-8 py-4 border-t border-slate-100 bg-slate-50/50">
            {{ $journals->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
