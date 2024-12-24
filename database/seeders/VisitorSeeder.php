<?php

namespace Database\Seeders;

use App\Models\Visitor;
use Illuminate\Database\Seeder;

class VisitorSeeder extends Seeder
{
    public function run()
    {
        Visitor::factory()->count(50)->create(); // Membuat 50 data dummy
    }
}
