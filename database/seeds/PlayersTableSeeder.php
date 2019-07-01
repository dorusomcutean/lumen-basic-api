<?php

use Illuminate\Database\Seeder;

class PlayersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app('db')
            ->table('players')
            ->insert([
                'name' => 'Anthony Martial',
                'age' => 24,
                'nationality' => 'English',
                'club' => 'Manchester United',
                'gender' => 'Male',
            ]);

        app('db')
        ->table('players')
        ->insert([
            'name' => 'Marcus Rashford',
            'age' => 21,
            'nationality' => 'English',
            'club' => 'Manchester United',
            'gender' => 'Male',
        ]);
    }
}
