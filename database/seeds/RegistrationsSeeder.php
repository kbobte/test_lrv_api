<?php

use Illuminate\Database\Seeder;
use App\Registration;

class RegistrationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Registration::class, 50)->create();
    }
}
