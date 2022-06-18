<?php

namespace Database\Seeders;

use App\Models\Party;
use Illuminate\Database\Seeder;

class PartySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
{
    Party::create([
        'party_name' => 'APC',
    ]);
    Party::create([
        'party_name' => 'PDP',
    ]);
}
}
