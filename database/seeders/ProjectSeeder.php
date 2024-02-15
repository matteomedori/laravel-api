<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {

        Project::truncate();
        for ($i = 0; $i < 20; $i++) {

            $type = Type::inRandomOrder()->first();

            $newproject = new Project();
            $newproject->title = $faker->sentence(3);
            $newproject->description = $faker->text(500);
            $newproject->slug = Str::of($newproject->title)->slug('-');
            $newproject->languages = $faker->randomElement(['HTML, CSS e JS', 'PHP']);
            $newproject->frameworks = $faker->randomElement(['Laravel', 'React', 'Vue', 'Angular', 'Bootstrap']);
            $newproject->type_id = $type->id;
            $newproject->save();
        }
    }
}
