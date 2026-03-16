@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-8 pb-12">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Pengajuan Pinjaman</h1>
            <p class="text-slate-500 mt-1">Lengkapi data untuk memproses pinjaman anggota baru.</p>
        </div>
        <a href="{{ route('loans.index') }}" class="inline-flex items-center px-4 py-2 text-slate-600 hover:text-indigo-600 hover:bg-white rounded-xl transition-all font-medium">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden p-8">
        <form action="{{ route('loans.store') }}" method="POST" id="loanForm" class="space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Left Column -->
                <div class="space-y-6">
                    <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest border-b border-slate-50 pb-2">Data Pemohon</h3>
                    
                    <div class="space-y-2">
                        <label for="member_id" class="text-sm font-bold text-slate-700 uppercase tracking-wider">Pilih Anggota</label>
                        <select name="member_id" id="member_id" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 transition-all text-slate-800">
                            <option value="">-- Cari Anggota --</option>
                            @foreach($members as $member)
                            <option value="{{ $member->id }}" {{ old('member_id') == $member->id ? 'selected' : '' }}>
                                {{ $member->member_number }} - {{ $member->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('member_id') <p class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="loan_scheme_id" class="text-sm font-bold text-slate-700 uppercase tracking-wider">Skema Pinjaman</label>
                        <select name="loan_scheme_id" id="loan_scheme_id" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 transition-all text-slate-800">
                            <option value="">-- Pilih Skema --</option>
                            @foreach($loanSchemes as $scheme)
                            <option value="{{ $scheme->id }}" 
                                data-interest="{{ $scheme->interest_rate }}" 
                                data-min="{{ $scheme->min_amount }}" 
                                data-max="{{ $scheme->max_amount }}"
                                {{ old('loan_scheme_id') == $scheme->id ? 'selected' : '' }}>
                                {{ $scheme->name }} ({{ $scheme->interest_rate }}% / bln)
                            </option>
                            @endforeach
                        </select>
                        @error('loan_scheme_id') <p class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="purpose" class="text-sm font-bold text-slate-700 uppercase tracking-wider">Tujuan Pinjaman</label>
                        <textarea name="purpose" id="purpose" rows="2" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 transition-all text-slate-800" placeholder="Contoh: Renovasi Rumah, Modal Usaha">{{ old('purpose') }}</textarea>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                    <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest border-b border-slate-50 pb-2">Rincian Finansial</h3>
                    
                    <div class="space-y-2">
                        <label for="amount" class="text-sm font-bold text-slate-700 uppercase tracking-wider">Jumlah Pinjaman (Rp)</label>
                        <input type="number" name="principal_amount" id="amount" value="{{ old('principal_amount') }}" 
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 transition-all text-slate-800 font-bold text-lg" placeholder="0">
                        @error('principal_amount') <p class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="duration" class="text-sm font-bold text-slate-700 uppercase tracking-wider">Tenor (Bulan)</label>
                        <input type="number" name="duration_months" id="duration" value="{{ old('duration_months', 12) }}" 
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 transition-all text-slate-800 font-bold" placeholder="Jumlah bulan">
                        @error('duration_months') <p class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                    </div>

                    <!-- Calculator Display -->
                    <div class="bg-indigo-50 rounded-2xl p-6 border border-indigo-100">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-xs font-bold text-indigo-400 uppercase tracking-wider">Estimasi Angsuran</span>
                            <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                        </div>
                        <div class="text-3xl font-black text-indigo-600" id="estimatedInstallment">Rp 0</div>
                        <p class="text-[10px] text-indigo-400 mt-2 italic">*Estimasi termasuk bunga flat per bulan.</p>
                    </div>
                </div>
            </div>

            <div class="pt-8 border-t border-slate-100 flex items-center justify-end gap-4">
                <button type="reset" class="px-6 py-3 text-slate-500 font-semibold hover:text-slate-700 transition-all">Reset</button>
                <button type="submit" class="px-10 py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-2xl shadow-xl shadow-indigo-100 transition-all active:scale-95 flex items-center">
                    Cairkan Pinjaman
                    <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    const amountInput = document.getElementById('amount');
    const durationInput = document.getElementById('duration');
    const schemeSelect = document.getElementById('loan_scheme_id');
    const display = document.getElementById('estimatedInstallment');

    function calculate() {
        const amount = parseFloat(amountInput.value) || 0;
        const duration = parseInt(durationInput.value) || 0;
        const interestRate = parseFloat(schemeSelect.options[schemeSelect.selectedIndex]?.dataset.interest) || 0;

        if (amount > 0 && duration > 0) {
            const principalPerMonth = amount / duration;
            const interestPerMonth = (amount * interestRate) / 100;
            const totalPerMonth = principalPerMonth + interestPerMonth;
            
            display.innerText = 'Rp ' + totalPerMonth.toLocaleString('id-ID', { maximumFractionDigits: 0 });
        } else {
            display.innerText = 'Rp 0';
        }
    }

    amountInput.addEventListener('input', calculate);
    durationInput.addEventListener('input', calculate);
    schemeSelect.addEventListener('change', calculate);
</script>
@endsection
