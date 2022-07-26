<?php

namespace  Modules\Users\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Users\Entities\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'      => 'Adryann',
            'email'     => 'adryann312@gmail.com',
            'password'  => bcrypt('12Ab@346'), // 12Ab@346
            'is_admin'  => true,
        ]);
        User::create([
            'name'      => 'Joohn',
            'email'     => 'jooohhn@example.com',
            'password'  => bcrypt('12Ab@346'), // 12Ab@346
            'is_admin'  => true,
        ]);
    }
}
