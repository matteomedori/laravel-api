<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $types = ['Frontend', 'Backend', 'Full-stack'];
        Type::truncate();
        foreach ($types as $type) {
            $new_type = new Type();

            $new_type->name = $type;
            $new_type->slug = Str::of($type)->slug('-');

            $new_type->save();
        }
    }
}
