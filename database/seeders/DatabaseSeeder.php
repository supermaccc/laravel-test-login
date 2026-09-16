<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // สร้างบัญชี Admin สำหรับเข้าสู่ระบบทดสอบ
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'password' => 'password123',
        ]);

        // สร้างข้อมูลผู้ใช้งานตัวอย่างทั่วไป (Role: user)
        User::factory(9)->create([
            'role' => 'user',
        ]);
    }
}
