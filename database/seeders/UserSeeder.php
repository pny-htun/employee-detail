<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        DB::table('users')->insert(array(
            array(
                "name" => 'admin',
                "email" => 'admin123@gmail.com',
                "phone" => '09422450550',
                "password" => '$2y$10$5auDRloDAaE4V3zC9Y061Owwp.gnJXqehTK2JKHnz9tkESd.zzZmG', # 12345
                "email_verified_at"  => null,
                "remember_token"  => null,
                "deleted_at"  => null,
                "created_at" => Carbon::now()->format('Y-m-d H:m:s'),
                "updated_at" => Carbon::now()->format('Y-m-d H:m:s')
            )
        ));
    }
}
