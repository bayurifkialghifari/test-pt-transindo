<?php

namespace Database\Seeders;

use App\Models\Hotel;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
        ]);

        $user->assignRole('admin');

        $merchant = User::create([
            'name' => 'Merchant',
            'email' => 'merchant@merchant.com',
            'password' => bcrypt('password'),
        ]);

        $merchant->assignRole('merchant');

        $customer = User::create([
            'name' => 'Customer',
            'email' => 'customer@customer.com',
            'password' => bcrypt('password'),
        ]);

        $customer->assignRole('customer');
    }
}
