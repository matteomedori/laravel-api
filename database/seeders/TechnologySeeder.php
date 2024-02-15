<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $technologies = ['Laravel', 'HTML', 'Vue', 'Bootstrap', 'Vite', 'PHP', 'Javascript'];
        Technology::truncate();
        foreach ($technologies as $technology) {
            $new_technology = new Technology();

            $new_technology->name = $technology;
            $new_technology->slug = Str::of($technology)->slug('-');

            $new_technology->save();
        }
    }
}
