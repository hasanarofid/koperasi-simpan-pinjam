@extends('layouts.app')

@section('title', 'Profil Anggota')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center">
            <a href="{{ route('members.index') }}" class="p-2 mr-4 text-slate-400 hover:text-indigo-600 hover:bg-white rounded-xl transition-all">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <div>
                <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Profil Anggota</h1>
                <p class="text-slate-500 mt-1">Detail informasi keanggotaan {{ $member->name }}.</p>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('members.edit', $member) }}" class="inline-flex items-center px-5 py-2.5 bg-white border border-slate-200 text-slate-600 hover:text-indigo-600 hover:border-indigo-100 text-sm font-semibold rounded-2xl shadow-sm transition-all active:scale-95">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 00-2 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                Edit Profil
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Sidebar Info -->
        <div class="space-y-8">
            <!-- Profile Card -->
            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-8 text-center">
                <div class="w-24 h-24 mx-auto rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center text-3xl font-bold mb-4">
                    {{ substr($member->name, 0, 2) }}
                </div>
                <h2 class="text-xl font-bold text-slate-900">{{ $member->name }}</h2>
                <p class="text-indigo-600 font-semibold text-sm">{{ $member->member_number }}</p>
                <div class="mt-4 inline-block px-3 py-1 rounded-full {{ $member->status == 'active' ? 'bg-emerald-50 text-emerald-600' : 'bg-rose-50 text-rose-600' }} text-xs font-bold uppercase tracking-wider">
                    {{ $member->status == 'active' ? 'Aktif' : 'Non-Aktif' }}
                </div>
                
                <div class="mt-8 pt-8 border-t border-slate-100 flex justify-around text-center">
                    <div>
                        <div class="text-xs text-slate-400 font-bold uppercase tracking-wider">Bergabung</div>
                        <div class="text-sm font-bold text-slate-700 mt-1">{{ \Carbon\Carbon::parse($member->registration_date)->format('d M Y') }}</div>
                    </div>
                </div>
            </div>

            <!-- ID Info -->
            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-8">
                <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-6">Informasi Identitas</h3>
                <div class="space-y-4">
                    <div>
                        <div class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">NIK</div>
                        <div class="text-slate-700 font-medium">{{ $member->nik }}</div>
                    </div>
                    <div>
                        <div class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">Tanggal Lahir</div>
                        <div class="text-slate-700 font-medium">{{ \Carbon\Carbon::parse($member->birth_date)->format('d M Y') }}</div>
                    </div>
                    <div>
                        <div class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">No. Telepon</div>
                        <div class="text-slate-700 font-medium">{{ $member->phone }}</div>
                    </div>
                    <div>
                        <div class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">Alamat</div>
                        <div class="text-slate-700 font-medium text-sm leading-relaxed">{{ $member->address }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Savings Summary -->
            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-8 py-6 border-b border-slate-100 flex items-center justify-between">
                    <h3 class="text-lg font-bold text-slate-800">Daftar Rekening Simpanan</h3>
                    <div class="w-10 h-10 rounded-xl bg-violet-50 text-violet-600 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-slate-50 text-slate-500 text-[10px] font-bold uppercase tracking-wider">
                                <th class="px-8 py-4">No. Rekening</th>
                                <th class="px-8 py-4">Jenis Simpanan</th>
                                <th class="px-8 py-4 text-right">Saldo</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($member->savingAccounts as $account)
                            <tr>
                                <td class="px-8 py-4 font-bold text-indigo-600 hover:underline">
                                    <a href="{{ route('savings.show', $account) }}">{{ $account->account_number }}</a>
                                </td>
                                <td class="px-8 py-4 text-sm text-slate-600">{{ $account->savingType->name }}</td>
                                <td class="px-8 py-4 text-right font-bold text-slate-900">Rp {{ number_format($account->balance) }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="px-8 py-8 text-center text-slate-500 text-sm">Belum ada rekening simpanan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                        @if($member->savingAccounts->isNotEmpty())
                        <tfoot>
                            <tr class="bg-slate-50">
                                <td colspan="2" class="px-8 py-4 text-sm font-bold text-slate-500 uppercase">Total Saldo</td>
                                <td class="px-8 py-4 text-right font-bold text-indigo-600">Rp {{ number_format($member->savingAccounts->sum('balance')) }}</td>
                            </tr>
                        </tfoot>
                        @endif
                    </table>
                </div>
            </div>

            <!-- Loans Summary -->
            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-8 py-6 border-b border-slate-100 flex items-center justify-between">
                    <h3 class="text-lg font-bold text-slate-800">Riwayat Pinjaman Aktif</h3>
                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-slate-50 text-slate-500 text-[10px] font-bold uppercase tracking-wider">
                                <th class="px-8 py-4">No. Pinjaman</th>
                                <th class="px-8 py-4">Total Pinjaman</th>
                                <th class="px-8 py-4">Sisa Tagihan</th>
                                <th class="px-8 py-4 text-right">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($member->loans as $loan)
                            <tr>
                                <td class="px-8 py-4 font-bold text-indigo-600 hover:underline">
                                    <a href="{{ route('loans.show', $loan) }}">{{ $loan->loan_number }}</a>
                                </td>
                                <td class="px-8 py-4 text-sm text-slate-600 text-right">Rp {{ number_format($loan->principal_amount) }}</td>
                                <td class="px-8 py-4 text-sm font-bold text-rose-600 text-right">Rp {{ number_format($loan->remaining_balance) }}</td>
                                <td class="px-8 py-4 text-right text-xs">
                                    <span class="px-2 py-1 rounded-lg {{ $loan->status == 'active' ? 'bg-blue-50 text-blue-600' : 'bg-emerald-50 text-emerald-600' }} font-bold uppercase">
                                        {{ $loan->status == 'active' ? 'Berjalan' : 'Lunas' }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-8 py-8 text-center text-slate-500 text-sm">Tidak ada pinjaman aktif.</td>
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
