<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Chart of Accounts (Akun Perkiraan)
        $accounts = [
            ['code' => '1000', 'name' => 'Aktiva', 'type' => 'asset'],
            ['code' => '1100', 'name' => 'Kas', 'type' => 'asset'],
            ['code' => '1200', 'name' => 'Bank', 'type' => 'asset'],
            ['code' => '1300', 'name' => 'Piutang Anggota', 'type' => 'asset'],
            ['code' => '2000', 'name' => 'Kewajiban', 'type' => 'liability'],
            ['code' => '2100', 'name' => 'Simpanan Pokok', 'type' => 'liability'],
            ['code' => '2200', 'name' => 'Simpanan Wajib', 'type' => 'liability'],
            ['code' => '2300', 'name' => 'Simpanan Sukarela', 'type' => 'liability'],
            ['code' => '3000', 'name' => 'Ekuitas', 'type' => 'equity'],
            ['code' => '4000', 'name' => 'Pendapatan', 'type' => 'revenue'],
            ['code' => '5000', 'name' => 'Beban', 'type' => 'expense'],
        ];

        foreach ($accounts as $acc) {
            \App\Models\ChartOfAccount::create($acc);
        }

        // Saving Types
        \App\Models\SavingType::create(['name' => 'Simpanan Pokok', 'code' => 'SP', 'interest_rate' => 0, 'minimum_balance' => 100000]);
        \App\Models\SavingType::create(['name' => 'Simpanan Wajib', 'code' => 'SW', 'interest_rate' => 0, 'minimum_balance' => 50000]);
        \App\Models\SavingType::create(['name' => 'Simpanan Sukarela', 'code' => 'SS', 'interest_rate' => 1.5, 'minimum_balance' => 0]);

        // Loan Schemes
        \App\Models\LoanScheme::create([
            'name' => 'Pinjaman Flat 1%',
            'min_amount' => 1000000,
            'max_amount' => 50000000,
            'interest_rate' => 1.0,
            'interest_type' => 'flat',
            'min_duration' => 6,
            'max_duration' => 24,
        ]);
        
        \App\Models\LoanScheme::create([
            'name' => 'Pinjaman Efektif 1.5%',
            'min_amount' => 5000000,
            'max_amount' => 100000000,
            'interest_rate' => 1.5,
            'interest_type' => 'effective',
            'min_duration' => 12,
            'max_duration' => 60,
        ]);
    }
}
