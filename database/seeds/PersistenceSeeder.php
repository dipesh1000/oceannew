<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PersistenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('persistences')->insert([
            'user_id' => $this->call(UserSeeder::class),
            'code' => Str::random(24),
        ]);
    }
}
