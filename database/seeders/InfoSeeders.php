<?php

namespace Database\Seeders;

use App\Models\SystemInfo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InfoSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // database/seeders/SystemInfoSeeder.php
        SystemInfo::create([
                'meta_field' => 'name',
                'meta_value' => 'Sistema de Laboratorio Clínico',
        ]);
        SystemInfo::create([
                'meta_field' => 'cover',
                'meta_value' => 'uploads/cover-1690914540.png',
            ]);
        SystemInfo::create([
                'meta_field' => 'short_name',
                'meta_value' => 'SIS-LABORATORIO',
        ]);
        SystemInfo::create([
            'meta_field' => 'user_avatar',
            'meta_value' => 'uploads/user_avatar.jpg',
        ]);
        SystemInfo::create([
            'meta_field' => 'logo',
            'meta_value' => 'uploads/logo-1689027717.png',
        ]);
    }
}
