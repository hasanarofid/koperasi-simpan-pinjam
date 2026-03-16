@extends('layouts.app')

@section('title', 'Tambah Anggota')

@section('content')
<div class="max-w-3xl mx-auto space-y-8">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Tambah Anggota Baru</h1>
            <p class="text-slate-500 mt-1">Lengkapi formulir di bawah untuk mendaftarkan anggota baru.</p>
        </div>
        <a href="{{ route('members.index') }}" class="inline-flex items-center px-4 py-2 text-slate-600 hover:text-indigo-600 hover:bg-white rounded-xl transition-all font-medium">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden p-8">
        <form action="{{ route('members.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- No. Anggota -->
                <div class="space-y-2">
                    <label for="member_number" class="text-sm font-bold text-slate-700 uppercase tracking-wider">No. Anggota</label>
                    <input type="text" name="member_number" id="member_number" value="{{ old('member_number', 'KSP-' . date('Ymdv')) }}" 
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all text-slate-800 placeholder-slate-400" placeholder="KSP-XXXXXXXX">
                    @error('member_number') <p class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                </div>

                <!-- NIK -->
                <div class="space-y-2">
                    <label for="nik" class="text-sm font-bold text-slate-700 uppercase tracking-wider">NIK (KTP)</label>
                    <input type="text" name="nik" id="nik" value="{{ old('nik') }}" 
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all text-slate-800 placeholder-slate-400" placeholder="16 digit NIK">
                    @error('nik') <p class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                </div>

                <!-- Nama Lengkap -->
                <div class="md:col-span-2 space-y-2">
                    <label for="name" class="text-sm font-bold text-slate-700 uppercase tracking-wider">Nama Lengkap</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" 
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all text-slate-800 placeholder-slate-400" placeholder="Nama sesuai ID">
                    @error('name') <p class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                </div>

                <!-- No. Telepon -->
                <div class="space-y-2">
                    <label for="phone" class="text-sm font-bold text-slate-700 uppercase tracking-wider">No. Telepon</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}" 
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all text-slate-800 placeholder-slate-400" placeholder="08xxxxxxxxxx">
                    @error('phone') <p class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                </div>

                <!-- Tanggal Lahir -->
                <div class="space-y-2">
                    <label for="birth_date" class="text-sm font-bold text-slate-700 uppercase tracking-wider">Tanggal Lahir</label>
                    <input type="date" name="birth_date" id="birth_date" value="{{ old('birth_date') }}" 
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all text-slate-800">
                    @error('birth_date') <p class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                </div>

                <!-- Alamat -->
                <div class="md:col-span-2 space-y-2">
                    <label for="address" class="text-sm font-bold text-slate-700 uppercase tracking-wider">Alamat Lengkap</label>
                    <textarea name="address" id="address" rows="3" 
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all text-slate-800 placeholder-slate-400" placeholder="Alamat domisili saat ini">{{ old('address') }}</textarea>
                    @error('address') <p class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                </div>

                <!-- Tanggal Registrasi -->
                <div class="space-y-2">
                    <label for="registration_date" class="text-sm font-bold text-slate-700 uppercase tracking-wider">Tanggal Registrasi</label>
                    <input type="date" name="registration_date" id="registration_date" value="{{ old('registration_date', date('Y-m-d')) }}" 
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all text-slate-800">
                    @error('registration_date') <p class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                </div>

                <!-- Status -->
                <div class="space-y-2">
                    <label for="status" class="text-sm font-bold text-slate-700 uppercase tracking-wider">Status</label>
                    <select name="status" id="status" 
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all text-slate-800">
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Non-Aktif</option>
                    </select>
                    @error('status') <p class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-4">
                <button type="reset" class="px-6 py-3 text-slate-500 font-semibold hover:text-slate-700 transition-all">Reset</button>
                <button type="submit" class="px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-2xl shadow-lg shadow-indigo-100 transition-all active:scale-95"> Simpan Anggota </button>
            </div>
        </form>
    </div>
</div>
@endsection
