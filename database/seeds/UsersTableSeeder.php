<?php

use Illuminate\Database\Seeder;
use \App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create(['name' => 'Admin', 'email' => 'admin@example.com', 'password' => bcrypt('12345678'), 'created_at' => '2019-05-28 04:45:27', 'updated_at' => '2019-05-28 04:45:27']);
        $user->assignRole('admin');
        $user->images()->create(['url' => 'https://via.placeholder.com/150/000000/FFFFFF/?text=iPlex']);
        $user->images()->create(['url' => 'https://via.placeholder.com/150/000000/FFFFFF/?text=Admin']);
        $user = User::create(['name' => 'User', 'email' => 'user@example.com', 'password' => bcrypt('12345678'), 'created_at' => '2019-05-28 04:45:27', 'updated_at' => '2019-05-28 04:45:27']);
        $user->images()->create(['url' => 'https://via.placeholder.com/150/000000/FFFFFF/?text=User']);
    }
}
