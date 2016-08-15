<?php
use App\Models\Customer;

use Illuminate\Database\Seeder;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::create([
            'email' => 'nmdad2_gebruiker@arteveldehs.be',
            'user_name' => 'nmdad2_gebruiker',
            'password' => Hash::make('nmdad2_wachtwoord'),
            'first_name' => 'NMDAD-II',
            'last_name' => 'Gebruiker',
        ]);

        // Faker
        // -----
        factory(Customer::class, DatabaseSeeder::AMOUNT['DEFAULT'])->create();
    }
}
