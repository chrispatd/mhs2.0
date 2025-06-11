<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class MsEmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ms_employee')->insert([
            'employee_id'         => 1,
            'position_id'         => 1,
            'name'                => 'admin',
            'teacher_code'        => '123456',
            'email'               => 'admin@example.com',
            'gender'              => 'Male',
            'religion_id'         => 1,
            'status'              => 'Active',
            'phone'               => '08123456789',
            'address'             => 'Admin Address',
            'profile_picture'     => 'default-avatar.png',
            'profile_cover'       => 'default-cover.jpg',
            'signature_picture'   => null,
            'signature_margin_top'    => null,
            'signature_margin_left'   => null,
            'description'         => null,
            'is_active'           => true,
            'created_at'          => Carbon::now(),
            'updated_at'          => Carbon::now(),
        ]);
    }
}
