<?php

use App\User;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
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
            $user =   User::where('email','admin@app.com')->first();
            $user->roles()->attach(1);
            $activation = Activation::completed($user);
            if(!$activation)
            {
                $activation = Activation::create($user);
                Activation::complete($user, $activation->code);
            }
        }
   
    }
}
