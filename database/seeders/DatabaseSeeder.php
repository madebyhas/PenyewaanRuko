<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin;
use App\Models\Penyewa;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $super = Admin::create([
            'nama_admin' => 'Super Admin',
            'username' => 'supadmin',
            'password' => bcrypt('super123'),
            'telp' => '081352460700',
        ]);
        
        // $user = Penyewa::create([
        //     'name' => 'User',
        //     'username' => 'user',
        //     'password' => bcrypt('user123'),
        // ]);
    }
}
