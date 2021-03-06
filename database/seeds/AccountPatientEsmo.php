<?php

use Illuminate\Database\Seeder;

class AccountPatientEsmo extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => '3',
            'username' => 'user_esmo',
            'firstname' => encrypt('Esmeralda'),
            'middlename' => encrypt(''),
            'lastname' => encrypt('Tijhoff'),
            'email' => 'esmo@testmail.com',
            'password' => Hash::make('@Insert12'),
            'created_at' => '2018-03-31 20:57:55',
            'updated_at' => '2018-03-31 20:57:55',
    	]);

        DB::table('role_user')->insert([
            'user_id' => '3',
            'role_id' => '1',
        ]);

    }
}
