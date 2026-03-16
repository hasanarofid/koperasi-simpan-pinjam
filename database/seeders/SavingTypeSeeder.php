<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SavingTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\SavingType::create([
            'name' => 'Simpanan Pokok',
            'code' => 'POKOK',
            'minimum_balance' => 100000,
            'is_mandatory' => true,
        ]);

        \App\Models\SavingType::create([
            'name' => 'Simpanan Wajib',
            'code' => 'WAJIB',
            'minimum_balance' => 50000,
            'is_mandatory' => true,
        ]);

        \App\Models\SavingType::create([
            'name' => 'Simpanan Sukarela',
            'code' => 'SUKARELA',
            'minimum_balance' => 0,
            'interest_rate' => 0.5,
            'is_mandatory' => false,
        ]);
    }
}
