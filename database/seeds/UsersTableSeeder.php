<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        factory(User::class, 50)->create();
        User::whereId(12)->update([
            'name' => 'Tom Jerry',
            'email' => 'laravel-a8419c@inbox.mailtrap.io',
        ]);
        User::whereId(22)->update([
            'name' => 'Admin1',
            'email' => 'admin1@fels.com',
            'role' => 'admin',
        ]);
        User::whereId(32)->update([
            'name' => 'Admin2',
            'email' => 'admin2@fels.com',
            'role' => 'admin',
        ]);
    }
}
