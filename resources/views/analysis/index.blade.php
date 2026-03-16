@extends('layouts.app')

@section('title', 'Grafik & Analisis')

@section('content')
<div class="space-y-10 pb-16">
    <!-- Header -->
    <div class="relative overflow-hidden bg-indigo-600 rounded-[40px] p-8 md:p-12 text-white shadow-2xl shadow-indigo-200">
        <div class="relative z-10">
            <h1 class="text-4xl md:text-5xl font-black italic uppercase -skew-x-12 tracking-tighter mb-4 animate-fade-in-up">Wawasan Sistem</h1>
            <p class="text-indigo-100 text-lg max-w-2xl font-medium">Analisis mendalam mengenai performa keuangan dan pertumbuhan anggota koperasi Anda secara realtime.</p>
        </div>
        <!-- Decorative blobs -->
        <div class="absolute -top-12 -right-12 w-64 h-64 bg-indigo-500 rounded-full blur-3xl opacity-50"></div>
        <div class="absolute -bottom-12 -left-12 w-48 h-48 bg-purple-500 rounded-full blur-3xl opacity-30"></div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm hover:translate-y-[-4px] transition-all duration-300">
            <div class="w-12 h-12 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600 mb-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <div class="text-[10px] font-black uppercase tracking-wider text-slate-400 mb-1">Total Anggota</div>
            <div class="text-3xl font-bold text-slate-900 tracking-tight">{{ number_format($stats['total_members']) }}</div>
            <div class="mt-2 flex items-center text-emerald-500 text-xs font-bold">
                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V7.414l-4.293 4.293a1 1 0 01-1.414 0L5 6.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0L10 8.586 14.586 4H12z" clip-rule="evenodd"></path></svg>
                +12% Bulan ini
            </div>
        </div>
        
        <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm hover:translate-y-[-4px] transition-all duration-300">
            <div class="w-12 h-12 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600 mb-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div class="text-[10px] font-black uppercase tracking-wider text-slate-400 mb-1">Total Simpanan</div>
            <div class="text-3xl font-bold text-slate-900 tracking-tight">Rp {{ number_format($stats['total_savings'] / 1000000, 1) }}M</div>
            <div class="mt-2 text-slate-500 text-xs font-medium">Likuiditas koperasi sangat baik</div>
        </div>

        <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm hover:translate-y-[-4px] transition-all duration-300">
            <div class="w-12 h-12 bg-rose-50 rounded-2xl flex items-center justify-center text-rose-600 mb-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 11l3-3m0 0l3 3m-3-3v8m0-13a9 9 0 110 18 9 9 0 010-18z"></path></svg>
            </div>
            <div class="text-[10px] font-black uppercase tracking-wider text-slate-400 mb-1">Pinjaman Aktif</div>
            <div class="text-3xl font-bold text-slate-900 tracking-tight">Rp {{ number_format($stats['total_loans'] / 1000000, 1) }}M</div>
            <div class="mt-2 text-slate-500 text-xs font-medium">Total risiko terukur</div>
        </div>

        <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm hover:translate-y-[-4px] transition-all duration-300">
            <div class="w-12 h-12 bg-amber-50 rounded-2xl flex items-center justify-center text-amber-600 mb-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
            </div>
            <div class="text-[10px] font-black uppercase tracking-wider text-slate-400 mb-1">Pendapatan Bunga</div>
            <div class="text-3xl font-bold text-slate-900 tracking-tight">Rp {{ number_format($stats['total_income'] / 1000, 0) }}rb</div>
            <div class="mt-2 text-slate-500 text-xs font-medium">Berdasarkan angsuran bulan ini</div>
        </div>
    </div>

    <!-- Charts Placeholder -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="bg-white p-8 rounded-[40px] border border-slate-200 shadow-sm overflow-hidden h-96 flex flex-col items-center justify-center text-center relative group italic">
            <div class="absolute inset-0 bg-gradient-to-br from-indigo-50/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
            <div class="relative z-10">
                <div class="flex items-end gap-2 mb-8 h-32">
                    <div class="w-8 bg-indigo-200 rounded-lg animate-pulse h-1/4"></div>
                    <div class="w-8 bg-indigo-300 rounded-lg animate-pulse" style="height: 45%"></div>
                    <div class="w-8 bg-indigo-400 rounded-lg animate-pulse" style="height: 60%"></div>
                    <div class="w-8 bg-indigo-500 rounded-lg animate-pulse" style="height: 85%"></div>
                    <div class="w-8 bg-indigo-600 rounded-lg animate-pulse h-full"></div>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">Tren Simpanan & Pinjaman</h3>
                <p class="text-slate-400 text-sm max-w-xs">Grafik interaktif akan tersedia di versi produksi (Integrasi Chart.js).</p>
            </div>
        </div>

        <div class="bg-white rounded-[40px] border border-slate-200 shadow-sm overflow-hidden flex flex-col italic">
            <div class="p-8 border-b border-slate-100 flex items-center justify-between">
                <h3 class="text-xl font-bold text-slate-900 tracking-tight">Pinjaman Terbaru</h3>
                <a href="{{ route('loans.index') }}" class="text-indigo-600 text-sm font-bold hover:underline italic">Lihat Semua</a>
            </div>
            <div class="flex-1">
                @forelse($stats['recent_loans'] as $loan)
                <div class="p-6 border-b border-slate-50 flex items-center justify-between hover:bg-slate-50/50 transition-colors">
                    <div class="flex items-center gap-4 text-sm font-semibold italic uppercase tracking-tighter">
                        <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center font-bold text-slate-400 uppercase tracking-tighter">
                            {{ substr($loan->member->name, 0, 1) }}
                        </div>
                        <div>
                            <div class="font-bold text-slate-900italic uppercase tracking-tighter">{{ $loan->member->name }}</div>
                            <div class="text-xs text-slate-400 font-mediumitalic uppercase tracking-tighter italic uppercase tracking-tighter italic uppercase tracking-tighter">{{ $loan->loan_number }}</div>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="font-bold text-slate-900 italic uppercase italic uppercase tracking-tighter">Rp {{ number_format($loan->amount) }}</div>
                        <div class="text-[10px] font-black uppercase tracking-wider text-emerald-500">{{ $loan->status }}</div>
                    </div>
                </div>
                @empty
                <div class="p-12 text-center text-slate-400 italic font-black uppercase tracking-wider italic">Belum ada data pinjaman.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
