<?php

namespace Database\Seeders;

ini_set('memory_limit', '4G'); // Increase memory limit to 4GB

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $primes = json_decode(file_get_contents(base_path('primes.json')), true);

        foreach ($primes as $prime) {
            DB::table('primes')->insert([
                'number' => $prime,
            ]);
        }
    }
}