@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
        <div>
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Ringkasan Dashboard</h1>
            <p class="text-slate-500 mt-1">Sekilas tentang kinerja koperasi Anda hari ini.</p>
        </div>
        <div class="flex items-center space-x-3">
            <button class="px-4 py-2 bg-white border border-slate-200 text-slate-700 rounded-xl text-sm font-semibold shadow-sm hover:bg-slate-50 transition-all">Unduh Laporan</button>
            <button class="px-4 py-2 bg-indigo-600 text-white rounded-xl text-sm font-semibold shadow-lg shadow-indigo-200 hover:bg-indigo-700 transition-all">+ Transaksi Baru</button>
        </div>
    </div>
 
    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Members Stat -->
        <div class="glass p-6 rounded-3xl shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div class="w-12 h-12 rounded-2xl bg-indigo-50 flex items-center justify-center text-indigo-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-lg">+0%</span>
            </div>
            <div class="mt-4">
                <h3 class="text-slate-500 text-xs font-bold uppercase tracking-wider">Total Anggota</h3>
                <p class="text-2xl font-bold text-slate-900 mt-1">{{ number_format($stats['total_members']) }}</p>
            </div>
        </div>
 
        <!-- Savings Stat -->
        <div class="glass p-6 rounded-3xl shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div class="w-12 h-12 rounded-2xl bg-violet-50 flex items-center justify-center text-violet-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-lg">+0%</span>
            </div>
            <div class="mt-4">
                <h3 class="text-slate-500 text-xs font-bold uppercase tracking-wider">Total Simpanan</h3>
                <p class="text-2xl font-bold text-slate-900 mt-1">Rp {{ number_format($stats['total_savings'] / 1000000, 1) }}Jt</p>
            </div>
        </div>
 
        <!-- Loans Stat -->
        <div class="glass p-6 rounded-3xl shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div class="w-12 h-12 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <span class="text-xs font-bold text-rose-600 bg-rose-50 px-2 py-1 rounded-lg">+0%</span>
            </div>
            <div class="mt-4">
                <h3 class="text-slate-500 text-xs font-bold uppercase tracking-wider">Pinjaman Aktif</h3>
                <p class="text-2xl font-bold text-slate-900 mt-1">Rp {{ number_format($stats['active_loans'] / 1000000, 1) }}Jt</p>
            </div>
        </div>
 
        <!-- Revenue Stat -->
        <div class="glass p-6 rounded-3xl shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div class="w-12 h-12 rounded-2xl bg-amber-50 flex items-center justify-center text-amber-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                </div>
                <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-lg">+0%</span>
            </div>
            <div class="mt-4">
                <h3 class="text-slate-500 text-xs font-bold uppercase tracking-wider">Pendapatan Kotor</h3>
                <p class="text-2xl font-bold text-slate-900 mt-1">Rp {{ number_format($stats['gross_revenue'] / 1000, 1) }}Rb</p>
            </div>
        </div>
    </div>
 
    <!-- Charts / Recent Transactions Section -->
    <div class="grid grid-cols-1 gap-8">
        <!-- Recent Members -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-8 py-6 border-b border-slate-100 flex items-center justify-between">
                <h3 class="text-lg font-bold text-slate-800">Anggota Terbaru</h3>
                <a href="#" class="text-sm font-semibold text-indigo-600 hover:text-indigo-700 transition-colors">Lihat semua</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50 text-slate-500 text-xs font-bold uppercase tracking-wider">
                            <th class="px-8 py-4">Nama Anggota</th>
                            <th class="px-8 py-4">Tanggal Bergabung</th>
                            <th class="px-8 py-4">Status</th>
                            <th class="px-8 py-4 text-right">Saldo Simpanan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 transition-all duration-300">
                        @foreach($recent_members as $member)
                        <tr class="hover:bg-slate-50/50">
                            <td class="px-8 py-4">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center text-xs font-bold">
                                        {{ substr($member->name, 0, 2) }}
                                    </div>
                                    <span class="ml-3 font-semibold text-slate-700">{{ $member->name }}</span>
                                </div>
                            </td>
                            <td class="px-8 py-4 text-sm text-slate-500">{{ $member->registration_date }}</td>
                            <td class="px-8 py-4">
                                <span class="px-2 py-1 rounded-lg bg-emerald-50 text-emerald-600 text-[10px] font-bold uppercase">{{ $member->status == 'active' ? 'Aktif' : 'Non-Aktif' }}</span>
                            </td>
                            <td class="px-8 py-4 text-sm font-bold text-slate-700 text-right">Rp {{ number_format($member->savingAccounts()->sum('balance')) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
