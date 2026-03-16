@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto space-y-8">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Buka Rekening Simpanan</h1>
            <p class="text-slate-500 mt-1">Pilih anggota dan jenis simpanan untuk membuka rekening baru.</p>
        </div>
        <a href="{{ route('savings.index') }}" class="inline-flex items-center px-4 py-2 text-slate-600 hover:text-indigo-600 hover:bg-white rounded-xl transition-all font-medium">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden p-8">
        <form action="{{ route('savings.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <div class="space-y-6">
                <!-- Anggota -->
                <div class="space-y-2">
                    <label for="member_id" class="text-sm font-bold text-slate-700 uppercase tracking-wider">Pilih Anggota</label>
                    <select name="member_id" id="member_id" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all text-slate-800">
                        <option value="">-- Pilih Anggota --</option>
                        @foreach($members as $member)
                        <option value="{{ $member->id }}" {{ old('member_id') == $member->id ? 'selected' : '' }}>
                            {{ $member->member_number }} - {{ $member->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('member_id') <p class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                </div>

                <!-- Jenis Simpanan -->
                <div class="space-y-2">
                    <label for="saving_type_id" class="text-sm font-bold text-slate-700 uppercase tracking-wider">Jenis Simpanan</label>
                    <select name="saving_type_id" id="saving_type_id" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all text-slate-800">
                        <option value="">-- Pilih Jenis Simpanan --</option>
                        @foreach($savingTypes as $type)
                        <option value="{{ $type->id }}" {{ old('saving_type_id') == $type->id ? 'selected' : '' }}>
                            {{ $type->name }} (Min. Saldo: Rp {{ number_format($type->minimum_balance) }})
                        </option>
                        @endforeach
                    </select>
                    @error('saving_type_id') <p class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                </div>

                <!-- No. Rekening -->
                <div class="space-y-2">
                    <label for="account_number" class="text-sm font-bold text-slate-700 uppercase tracking-wider">No. Rekening</label>
                    <input type="text" name="account_number" id="account_number" value="{{ old('account_number', 'SA-' . date('Ymdv')) }}" 
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all text-slate-800" placeholder="SA-XXXXXXXX">
                    @error('account_number') <p class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-4">
                <button type="reset" class="px-6 py-3 text-slate-500 font-semibold hover:text-slate-700 transition-all">Reset</button>
                <button type="submit" class="px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-2xl shadow-lg shadow-indigo-100 transition-all active:scale-95"> Buka Rekening </button>
            </div>
        </form>
    </div>
</div>
@endsection
