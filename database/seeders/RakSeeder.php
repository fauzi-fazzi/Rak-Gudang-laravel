<?php

namespace Database\Seeders;

use App\Models\Rak;
use Illuminate\Database\Seeder;

class RakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($rak = 'A'; $rak <= 'N'; $rak++) {
            Rak::create([
                'nama' => $rak,
            ]);
        }
    }
}
