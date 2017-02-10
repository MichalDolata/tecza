<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'preB',
            'email' => 'preblue@gmail.com',
            'password' => bcrypt('test')
        ]);

        factory(App\News::class, 10)->create();

        factory(App\TeamMember::class, 20)->create();
    }
}
