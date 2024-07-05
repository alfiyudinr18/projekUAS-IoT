<?php

namespace Database\Seeders;

use App\Models\DHT11;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DHT11Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DHT11::create([
            'jarak' => 0,
            'status' => 0,
        ]);
    }
}
