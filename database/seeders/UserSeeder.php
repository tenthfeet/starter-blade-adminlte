<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Tenthfeet\Enums\Status;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'admin@email.com',
            'isd' => '91',
            'mobile_no' => '9999999999',
            'password' => 'password#321',
            'status' => Status::Active,
        ]);

        User::factory()->count(4)->create();
    }
}
