@extends('layouts.app')

@section('title', 'Detail Simpanan')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center">
            <a href="{{ route('savings.index') }}" class="p-2 mr-4 text-slate-400 hover:text-indigo-600 hover:bg-white rounded-xl transition-all">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <div>
                <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Detail Rekening</h1>
                <p class="text-slate-500 mt-1">Kelola transaksi untuk rekening {{ $account->account_number }}.</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Account Info -->
        <div class="space-y-8">
            <div class="bg-indigo-600 rounded-3xl shadow-xl shadow-indigo-200 p-8 text-white relative overflow-hidden">
                <div class="relative z-10">
                    <div class="text-indigo-200 text-xs font-bold uppercase tracking-widest mb-1">Saldo Saat Ini</div>
                    <div class="text-4xl font-black mb-6">Rp {{ number_format($account->balance) }}</div>
                    
                    <div class="space-y-4">
                        <div>
                            <div class="text-indigo-200 text-[10px] font-bold uppercase tracking-widest">No. Rekening</div>
                            <div class="font-bold tracking-wider">{{ $account->account_number }}</div>
                        </div>
                        <div>
                            <div class="text-indigo-200 text-[10px] font-bold uppercase tracking-widest">Pemilik</div>
                            <div class="font-bold">{{ $account->member->name }}</div>
                        </div>
                        <div>
                            <div class="text-indigo-200 text-[10px] font-bold uppercase tracking-widest">Jenis Simpanan</div>
                            <div class="font-bold">{{ $account->savingType->name }}</div>
                        </div>
                    </div>
                </div>
                <!-- Decorative circles -->
                <div class="absolute -right-8 -bottom-8 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
                <div class="absolute -left-4 -top-4 w-24 h-24 bg-indigo-400/20 rounded-full blur-xl"></div>
            </div>

            <!-- Action Buttons -->
            <div class="grid grid-cols-2 gap-4">
                <button onclick="document.getElementById('deposit-modal').classList.remove('hidden')" class="flex flex-col items-center justify-center p-6 bg-white border border-slate-200 rounded-3xl hover:border-indigo-200 hover:bg-slate-50 transition-all group">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    </div>
                    <span class="text-sm font-bold text-slate-700">Setoran</span>
                </button>
                <button onclick="document.getElementById('withdraw-modal').classList.remove('hidden')" class="flex flex-col items-center justify-center p-6 bg-white border border-slate-200 rounded-3xl hover:border-indigo-200 hover:bg-slate-50 transition-all group">
                    <div class="w-12 h-12 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                    </div>
                    <span class="text-sm font-bold text-slate-700">Penarikan</span>
                </button>
            </div>
        </div>

        <!-- Transaction History -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-8 py-6 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                    <h3 class="text-lg font-bold text-slate-800">Riwayat Transaksi Terakhir</h3>
                    <div class="text-xs font-bold text-slate-400 uppercase tracking-widest">10 Transaksi Terbaru</div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-slate-500 text-[10px] font-bold uppercase tracking-wider border-b border-slate-50">
                                <th class="px-8 py-4">Tanggal / Ref</th>
                                <th class="px-8 py-4">Keterangan</th>
                                <th class="px-8 py-4 text-right">Nominal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($account->transactions as $tx)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-8 py-4">
                                    <div class="text-sm font-bold text-slate-700">{{ \Carbon\Carbon::parse($tx->transaction_date)->format('d/m/Y H:i') }}</div>
                                    <div class="text-[10px] text-slate-400 font-medium tracking-wider">{{ $tx->reference_number }}</div>
                                </td>
                                <td class="px-8 py-4">
                                    <div class="text-sm text-slate-600">{{ $tx->description }}</div>
                                </td>
                                <td class="px-8 py-4 text-right">
                                    <div class="text-sm font-black {{ $tx->type == 'deposit' ? 'text-emerald-600' : 'text-rose-600' }}">
                                        {{ $tx->type == 'deposit' ? '+' : '-' }} Rp {{ number_format($tx->amount) }}
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="px-8 py-12 text-center text-slate-400 italic">Belum ada riwayat transaksi.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Deposit Modal -->
    <div id="deposit-modal" class="hidden fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity" aria-hidden="true" onclick="this.parentElement.classList.add('hidden')"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-3xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form action="{{ route('savings.deposit', $account) }}" method="POST">
                    @csrf
                    <div class="bg-white px-8 pt-8 pb-6">
                        <h3 class="text-2xl font-bold text-slate-900 mb-2">Setoran Tunai</h3>
                        <p class="text-slate-500 text-sm mb-6">Masukkan nominal setoran untuk rekening ini.</p>
                        
                        <div class="space-y-4">
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-slate-400 uppercase tracking-widest">Nominal Setoran (Rp)</label>
                                <input type="number" name="amount" required min="1000" step="500" class="w-full px-4 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-2xl font-black text-emerald-600" placeholder="0">
                            </div>
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-slate-400 uppercase tracking-widest">Keterangan</label>
                                <input type="text" name="description" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-slate-700" placeholder="Opsional">
                            </div>
                        </div>
                    </div>
                    <div class="bg-slate-50 px-8 py-6 flex flex-row-reverse gap-3">
                        <button type="submit" class="px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-2xl shadow-lg shadow-indigo-100 transition-all">Proses Setoran</button>
                        <button type="button" onclick="document.getElementById('deposit-modal').classList.add('hidden')" class="px-6 py-3 text-slate-500 font-semibold">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Withdraw Modal -->
    <div id="withdraw-modal" class="hidden fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity" aria-hidden="true" onclick="this.parentElement.classList.add('hidden')"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-3xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form action="{{ route('savings.withdraw', $account) }}" method="POST">
                    @csrf
                    <div class="bg-white px-8 pt-8 pb-6">
                        <h3 class="text-2xl font-bold text-slate-900 mb-2">Penarikan Tunai</h3>
                        <p class="text-slate-500 text-sm mb-6">Masukkan nominal penarikan dari rekening ini.</p>
                        
                        <div class="space-y-4">
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-slate-400 uppercase tracking-widest">Nominal Penarikan (Rp)</label>
                                <input type="number" name="amount" required min="1000" step="500" class="w-full px-4 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-2xl font-black text-rose-600" placeholder="0">
                                <p class="text-[10px] text-slate-400 mt-1 italic">Saldo tersedia: Rp {{ number_format($account->balance) }}</p>
                            </div>
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-slate-400 uppercase tracking-widest">Keterangan</label>
                                <input type="text" name="description" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-slate-700" placeholder="Opsional">
                            </div>
                        </div>
                    </div>
                    <div class="bg-slate-50 px-8 py-6 flex flex-row-reverse gap-3">
                        <button type="submit" class="px-8 py-3 bg-rose-600 hover:bg-rose-700 text-white font-bold rounded-2xl shadow-lg shadow-rose-100 transition-all">Proses Penarikan</button>
                        <button type="button" onclick="document.getElementById('withdraw-modal').classList.add('hidden')" class="px-6 py-3 text-slate-500 font-semibold">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
