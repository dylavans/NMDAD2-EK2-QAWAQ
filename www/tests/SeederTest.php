<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SeederTest extends TestCase
{
    /**
     * @return void
     */
    public function testUsersTableSeeder()
    {
        // Arrange
//        $this->seed();

        // Act

        // Assert
        $this->seeInDatabase(CreateUsersTable::TABLE, [
            'email' => 'nmdad2_gebruiker@arteveldehs.be',
            'name' => 'nmdad2_gebruiker',
            'given_name' => 'NMDAD-II',
            'family_name' => 'Gebruiker',
        ]);
    }
}
