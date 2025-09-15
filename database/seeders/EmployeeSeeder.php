<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee; // ✅ Tambahkan ini

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Employee::create([
            'nama_lengkap' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'nomor_telepon' => '081234567890',
            'tanggal_lahir' => '1995-05-10',
            'alamat' => 'Jl. Merdeka No. 1',
            'tanggal_masuk' => '2024-01-01',
            'status' => 'aktif',
        ]);
    }
}

