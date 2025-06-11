<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\MsUserSeeder;
use Database\Seeders\MsEmployeePositionSeeder;
use Database\Seeders\MsEmployeeSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Panggil seeder untuk tabel ms_user
        $this->call([
            MsUserSeeder::class,
            MsEmployeePositionSeeder::class,
            MsEmployeeSeeder::class,
        ]);

        // Jika masih ingin menggunakan factory bawaan Laravel untuk model User:
        // \App\Models\User::factory(10)->create();

        // Atau contoh create satu user dengan factory:
        // \App\Models\User::factory()->create([
        //     'name'  => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
