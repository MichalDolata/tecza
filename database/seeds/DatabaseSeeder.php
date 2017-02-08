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
            'email' => str_random(10).'@gmail.com',
            'password' => bcrypt('test')
        ]);

        App\News::truncate();
        factory(App\News::class, 10)->create();
    }
}
