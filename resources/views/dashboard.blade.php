@extends('layouts.app')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
        <div>
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Dashboard Overview</h1>
            <p class="text-slate-500 mt-1">Glimpse of your cooperative's performance today.</p>
        </div>
        <div class="flex items-center space-x-3">
            <button class="px-4 py-2 bg-white border border-slate-200 text-slate-700 rounded-xl text-sm font-semibold shadow-sm hover:bg-slate-50 transition-all">Download Report</button>
            <button class="px-4 py-2 bg-indigo-600 text-white rounded-xl text-sm font-semibold shadow-lg shadow-indigo-200 hover:bg-indigo-700 transition-all">+ New Transaction</button>
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
                <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-lg">+12%</span>
            </div>
            <div class="mt-4">
                <h3 class="text-slate-500 text-xs font-bold uppercase tracking-wider">Total Members</h3>
                <p class="text-2xl font-bold text-slate-900 mt-1">1,284</p>
            </div>
        </div>

        <!-- Savings Stat -->
        <div class="glass p-6 rounded-3xl shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div class="w-12 h-12 rounded-2xl bg-violet-50 flex items-center justify-center text-violet-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-lg">+4.5%</span>
            </div>
            <div class="mt-4">
                <h3 class="text-slate-500 text-xs font-bold uppercase tracking-wider">Total Savings</h3>
                <p class="text-2xl font-bold text-slate-900 mt-1">Rp 2.4B</p>
            </div>
        </div>

        <!-- Loans Stat -->
        <div class="glass p-6 rounded-3xl shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div class="w-12 h-12 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <span class="text-xs font-bold text-rose-600 bg-rose-50 px-2 py-1 rounded-lg">-2.1%</span>
            </div>
            <div class="mt-4">
                <h3 class="text-slate-500 text-xs font-bold uppercase tracking-wider">Active Loans</h3>
                <p class="text-2xl font-bold text-slate-900 mt-1">Rp 1.1B</p>
            </div>
        </div>

        <!-- Revenue Stat -->
        <div class="glass p-6 rounded-3xl shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div class="w-12 h-12 rounded-2xl bg-amber-50 flex items-center justify-center text-amber-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                </div>
                <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-lg">+8.2%</span>
            </div>
            <div class="mt-4">
                <h3 class="text-slate-500 text-xs font-bold uppercase tracking-wider">Gross Revenue</h3>
                <p class="text-2xl font-bold text-slate-900 mt-1">Rp 450M</p>
            </div>
        </div>
    </div>

    <!-- Charts / Recent Transactions Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Recent Members (2/3 width) -->
        <div class="lg:col-span-2 bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-8 py-6 border-b border-slate-100 flex items-center justify-between">
                <h3 class="text-lg font-bold text-slate-800">Recent Members</h3>
                <a href="#" class="text-sm font-semibold text-indigo-600 hover:text-indigo-700 transition-colors">View all</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50 text-slate-500 text-xs font-bold uppercase tracking-wider">
                            <th class="px-8 py-4">Member Name</th>
                            <th class="px-8 py-4">Join Date</th>
                            <th class="px-8 py-4">Status</th>
                            <th class="px-8 py-4 text-right">Balance</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 italic transition-all duration-300">
                        <tr class="hover:bg-slate-50/50">
                            <td class="px-8 py-4">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center text-xs font-bold">JD</div>
                                    <span class="ml-3 font-semibold text-slate-700">John Doe</span>
                                </div>
                            </td>
                            <td class="px-8 py-4 text-sm text-slate-500">Oct 12, 2025</td>
                            <td class="px-8 py-4">
                                <span class="px-2 py-1 rounded-lg bg-emerald-50 text-emerald-600 text-[10px] font-bold uppercase">Active</span>
                            </td>
                            <td class="px-8 py-4 text-sm font-bold text-slate-700 text-right">Rp 12,500,000</td>
                        </tr>
                        <!-- Repeat for a few rows -->
                         <tr class="hover:bg-slate-50/50">
                            <td class="px-8 py-4">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full bg-violet-100 text-violet-600 flex items-center justify-center text-xs font-bold">AS</div>
                                    <span class="ml-3 font-semibold text-slate-700">Alice Smith</span>
                                </div>
                            </td>
                            <td class="px-8 py-4 text-sm text-slate-500">Oct 11, 2025</td>
                            <td class="px-8 py-4">
                                <span class="px-2 py-1 rounded-lg bg-emerald-50 text-emerald-600 text-[10px] font-bold uppercase">Active</span>
                            </td>
                            <td class="px-8 py-4 text-sm font-bold text-slate-700 text-right">Rp 8,200,000</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- System Alerts (1/3 width) -->
        <div class="bg-indigo-600 rounded-3xl p-8 text-white shadow-xl shadow-indigo-100 overflow-hidden relative">
            <div class="relative z-10">
                <h3 class="text-xl font-bold mb-4">System Overview</h3>
                <p class="text-indigo-100 text-sm mb-8 leading-relaxed">Your system is healthy and running the latest version of KSP Modern. All backups are up to date.</p>
                
                <div class="space-y-4">
                    <div class="bg-white/10 rounded-2xl p-4 flex items-center space-x-4">
                        <div class="w-2 h-2 rounded-full bg-emerald-400"></div>
                        <span class="text-sm font-medium">Database Connected</span>
                    </div>
                    <div class="bg-white/10 rounded-2xl p-4 flex items-center space-x-4">
                        <div class="w-2 h-2 rounded-full bg-indigo-300"></div>
                        <span class="text-sm font-medium">PHP v8.3.12 (Modern)</span>
                    </div>
                </div>
            </div>
            <!-- Abstract background shape -->
            <div class="absolute -bottom-10 -right-10 w-48 h-48 bg-white/10 rounded-full blur-3xl"></div>
        </div>
    </div>
</div>
@endsection
