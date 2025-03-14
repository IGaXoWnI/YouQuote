<?php

namespace Database\Seeders;

use App\Models\Citation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Citation::create([
            'content' => 'La vie est un mystère quil faut vivre, et non un problème à résoudre.',
            'author' => 'Gandhi'
        ]);

        Citation::create([
            'content' => 'Le succès nest pas final léchec nest pas fatal  cest le courage de continuer qui compte.',
            'author' => 'Winston Churchill'
        ]);
    }
}
