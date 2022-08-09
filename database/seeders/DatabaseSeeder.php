<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Mahasiswa::factory(20)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        MataKuliah::factory()->createMany(
            [
                [
                    'nama_matakuliah' => 'Business Intelegence',
                    'sks' => 3,
                ],
                [
                    'nama_matakuliah' => 'Pemograman Internet Intermediate',
                    'sks' =>4,
                ],
                [
                    'nama_matakuliah' => ' UI & UX Design ',
                    'sks' =>2,
                ],
                [
                    'nama_matakuliah' => ' TOEFL Preparation',
                    'sks' => 2,
                ],
                [
                    'nama_matakuliah' => ' E-Commerce',
                    'sks' => 3,
                ],
                [
                    'nama_matakuliah' => ' Analisa Sistem Berorientasi Obyek',
                    'sks' => 3,
                ],
                [
                    'nama_matakuliah' => ' RPL : Aglie Scrum Introduction',
                    'sks' => 3,
                ],
            ]
        );
    }

};
