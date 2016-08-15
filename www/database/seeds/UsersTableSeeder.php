<?php

use App\User;
use Illuminate\Database\Seeder;

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
            'email' => 'nmdad2_gebruiker@arteveldehs.be',
            'name' => 'nmdad2_gebruiker',
            'password' => Hash::make('nmdad2_wachtwoord'),
            'given_name' => 'NMDAD-II',
            'family_name' => 'Gebruiker',
        ]);

        // Faker
        // -----
        factory(User::class, DatabaseSeeder::AMOUNT['DEFAULT'])->create();
    }
}
