<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Building;
use App\Models\Flat;
use App\Models\Architect;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        
        User::truncate();
        Architect::truncate();
        Flat::truncate();
        Building::truncate();

        User::factory(3)->create();

        $architect1 = Architect::factory()->create();
        $architect2 = Architect::factory()->create();
        $architect3 = Architect::factory()->create();
        $architect4 = Architect::factory()->create();

        $flat1 = Flat::factory()->create();
        $flat2 = Flat::factory()->create();
        $flat3 = Flat::factory()->create();
        $flat4 = Flat::factory()->create();


        Building::factory()->create([
            'architect_id' => $architect1->id,
            'flat_id' => $flat1->id
        ]);
        Building::factory()->create([
            'architect_id' => $architect2->id,
            'flat_id' => $flat2->id
        ]);
        Building::factory()->create([
            'architect_id' => $architect3->id,
            'flat_id' => $flat3->id
        ]);
        Building::factory()->create([
            'architect_id' => $architect4->id,
            'flat_id' => $flat4->id
        ]);
}
}