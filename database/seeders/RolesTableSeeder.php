<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        Role::firstOrCreate(['name' => 'Lender', 'code' => 'lender']);
        Role::firstOrCreate(['name' => 'Borrower', 'code' => 'borrower']);
    }
}
