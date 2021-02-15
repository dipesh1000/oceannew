<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
     
        $role = DB::table('roles')->insert([
            'slug' => 'admin',
            'name' => 'admin',
            'permissions' => json_encode(['full.permission' => true])
        ]);
        if($role)
        {
            User::where('email','admin@app.com')->first()->roles()->attach(1);
        }
   
    }
}
