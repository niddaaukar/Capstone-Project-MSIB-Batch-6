<?php

namespace Database\Seeders;

use App\Models\TypeMotorcycle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeMotocycleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $types = [
            [
                'id' => '1',
                'nama' => 'Matic',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '2',
                'nama' => 'Bebek',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '3',
                'nama' => 'Sport',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        TypeMotorcycle::insert($types);
    }
}
