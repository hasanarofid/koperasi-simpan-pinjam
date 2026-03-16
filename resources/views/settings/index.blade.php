@extends('layouts.app')

@section('title', 'Pengaturan')

@section('content')
<div class="space-y-8 pb-12">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Pengaturan Koperasi</h1>
            <p class="text-slate-500 mt-1">Kelola informasi dasar dan konfigurasi sistem koperasi Anda.</p>
        </div>
    </div>

    <!-- Settings Form -->
    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
        <form action="{{ route('settings.update') }}" method="POST" class="divide-y divide-slate-100">
            @csrf
            
            <!-- Basic Info -->
            <div class="p-8 space-y-6">
                <h3 class="text-lg font-bold text-slate-800 flex items-center">
                    <svg class="w-5 h-5 mr-3 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    Informasi Dasar
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Nama Koperasi</label>
                        <input type="text" name="coop_name" value="{{ $settings['coop_name'] ?? 'KSP Modern' }}" class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-4 py-3 text-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all outline-none" placeholder="Masukkan nama koperasi">
                    </div>
                    <div>
                        <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Email Kontak</label>
                        <input type="email" name="coop_email" value="{{ $settings['coop_email'] ?? 'kontak@kspmodern.com' }}" class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-4 py-3 text-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all outline-none" placeholder="email@contoh.com">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Alamat Lengkap</label>
                        <textarea name="coop_address" rows="3" class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-4 py-3 text-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all outline-none" placeholder="Alamat lengkap koperasi">{{ $settings['coop_address'] ?? '' }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Financial Config -->
            <div class="p-8 space-y-6">
                <h3 class="text-lg font-bold text-slate-800 flex items-center">
                    <svg class="w-5 h-5 mr-3 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Konfigurasi Keuangan
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Simpanan Pokok (Wajib di Awal)</label>
                        <div class="relative">
                            <span class="absolute left-4 top-3.5 text-slate-400 text-sm font-bold">Rp</span>
                            <input type="number" name="initial_saving_capital" value="{{ $settings['initial_saving_capital'] ?? '100000' }}" class="w-full bg-slate-50 border border-slate-100 rounded-2xl pl-12 pr-4 py-3 text-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all outline-none">
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Biaya Administrasi Pinjaman (%)</label>
                        <div class="relative">
                            <input type="number" step="0.1" name="loan_admin_fee_percent" value="{{ $settings['loan_admin_fee_percent'] ?? '1' }}" class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-4 py-3 text-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all outline-none">
                            <span class="absolute right-4 top-3.5 text-slate-400 text-sm font-bold">%</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Area -->
            <div class="p-8 bg-slate-50/50 flex justify-end">
                <button type="submit" class="inline-flex items-center px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-2xl shadow-lg shadow-indigo-100 transition-all active:scale-95">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
