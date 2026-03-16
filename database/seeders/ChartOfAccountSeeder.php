<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChartOfAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $coa = [
            // Assets
            ['code' => '100', 'name' => 'ASET', 'type' => 'asset'],
            ['code' => '110', 'name' => 'KAS', 'type' => 'asset', 'parent_code' => '100'],
            ['code' => '120', 'name' => 'PIUTANG PINJAMAN', 'type' => 'asset', 'parent_code' => '100'],
            
            // Liabilities
            ['code' => '200', 'name' => 'KEWAJIBAN', 'type' => 'liability'],
            ['code' => '210', 'name' => 'SIMPANAN POKOK', 'type' => 'liability', 'parent_code' => '200'],
            ['code' => '220', 'name' => 'SIMPANAN WAJIB', 'type' => 'liability', 'parent_code' => '200'],
            ['code' => '230', 'name' => 'SIMPANAN SUKARELA', 'type' => 'liability', 'parent_code' => '200'],
            
            // Equity
            ['code' => '300', 'name' => 'EKUITAS', 'type' => 'equity'],
            ['code' => '310', 'name' => 'MODAL AWAL', 'type' => 'equity', 'parent_code' => '300'],
            ['code' => '400', 'name' => 'PENDAPATAN', 'type' => 'revenue'],
            ['code' => '410', 'name' => 'PENDAPATAN BUNGA', 'type' => 'revenue', 'parent_code' => '400'],
            ['code' => '500', 'name' => 'BEBAN', 'type' => 'expense'],
            ['code' => '510', 'name' => 'BEBAN BUNGA SIMPANAN', 'type' => 'expense', 'parent_code' => '500'],
        ];

        foreach ($coa as $item) {
            $parent = null;
            if (isset($item['parent_code'])) {
                $parent = \App\Models\ChartOfAccount::where('code', $item['parent_code'])->first();
            }

            \App\Models\ChartOfAccount::create([
                'code' => $item['code'],
                'name' => $item['name'],
                'type' => $item['type'],
                'parent_id' => $parent ? $parent->id : null,
            ]);
        }
    }
}
