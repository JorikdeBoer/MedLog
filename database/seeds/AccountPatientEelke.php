<?php

use Illuminate\Database\Seeder;

class AccountPatientEelke extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => '1',
            'username' => 'user_eelke',
            'firstname' => encrypt('Eelke'),
            'middlename' => encrypt('van'),
            'lastname' => encrypt('Dijk'),
            'email' => 'evandijk89@gmail.com',
            'password' => Hash::make('@Insert12'),
            'created_at' => '2018-03-31 20:57:55',
            'updated_at' => '2018-03-31 20:57:55',
    	]);
        DB::table('diaries')->insert([
            'user_id' => '1',
        ]);

        DB::table('role_user')->insert([
            'user_id' => '1',
            'role_id' => '2',
        ]);

    }
}
