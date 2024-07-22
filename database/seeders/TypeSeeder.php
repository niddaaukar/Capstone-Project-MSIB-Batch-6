<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
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
                'nama' => 'MPV',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '2',
                'nama' => 'SUV',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '3',
                'nama' => 'Hatchback',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '4',
                'nama' => 'Sedan',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        Type::insert($types);

    }
}
