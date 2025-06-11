<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MsUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ms_user')->insert([
            'role_id'               => 1,
            'role_access_id'        => null,
            'employee_id'           => 1,
            'teacher_code'          => '123456',
            'code_type'             => null,
            'is_homeroomteacher'    => false,
            'is_super_user'         => true,
            'is_score_spiritual'    => false,
            'is_score_sosial'       => false,
            'ppdb_access'           => null,
            'email'                 => 'admin@example.com',
            'username'              => 'admin',
            'password'              => Hash::make('admin123'),
            'active_semester_id'    => null,
            'active_school_year_id' => null,
            'last_login'            => null,
            'remember_token'        => Str::random(60),
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);
    }
}
