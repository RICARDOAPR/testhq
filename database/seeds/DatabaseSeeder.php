<?php

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
        // $this->call(UsersTableSeeder::class);
        Storage::deleteDirectory('users');

        Storage::makeDirectory('users');

        factory(\App\Role::class,1)->create(['name' => 'admin']);
        factory(\App\Role::class,1)->create(['name' => 'user']);

        factory(\App\User::class,1)->create([
            'name' => 'admin',
            'email' => 'adminhq@gmail.com',
            'password' => bcrypt('secret'),
            'role_id' => \App\Role::ADMIN,
        ]);
    }
}
