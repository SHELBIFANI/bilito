<?php

use Database\Seeders\NameAirline;
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
        $this->call(NameAirline::class);
        $this->call(NameCity::class);
    }
}