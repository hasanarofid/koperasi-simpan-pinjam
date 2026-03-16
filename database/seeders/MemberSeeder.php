<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Member Groups
        $group1 = \App\Models\MemberGroup::create(['name' => 'Wilayah Barat', 'description' => 'Anggota area barat']);
        $group2 = \App\Models\MemberGroup::create(['name' => 'Wilayah Timur', 'description' => 'Anggota area timur']);

        // Members
        $members = [
            ['name' => 'Budi Santoso', 'address' => 'Jl. Merdeka No. 1', 'phone' => '08123456789'],
            ['name' => 'Siti Aminah', 'address' => 'Jl. Mawar No. 12', 'phone' => '08123456780'],
            ['name' => 'Joko Widodo', 'address' => 'Jl. Istana No. 1', 'phone' => '08123456781'],
            ['name' => 'Ani Yudhoyono', 'address' => 'Jl. Cikeas No. 5', 'phone' => '08123456782'],
            ['name' => 'Prabowo Subianto', 'address' => 'Jl. Hambalang No. 8', 'phone' => '08123456783'],
        ];

        foreach ($members as $index => $m) {
            \App\Models\Member::create([
                'member_number' => 'KSP-' . str_pad($index + 1, 4, '0', STR_PAD_LEFT),
                'nik' => '320101' . str_pad($index + 1, 10, '0', STR_PAD_LEFT),
                'name' => $m['name'],
                'address' => $m['address'],
                'phone' => $m['phone'],
                'birth_date' => now()->subYears(rand(20, 50)),
                'registration_date' => now()->subMonths(rand(1, 12)),
                'status' => 'active',
            ]);
        }
    }
}
