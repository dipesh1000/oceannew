<?php

use App\User;
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
            'user_id' => User::where('email','admin@app.com')->first()->id,
            'code' => Str::random(24),
        ]);
    }
}
