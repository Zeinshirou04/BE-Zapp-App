<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    public function run(): void
    {
        Profile::firstOrCreate(['id' => 1], [
            'name'         => 'Farras Adhani Zayn',
            'job_title'    => 'Full Stack Web Developer',
            'bio'          => 'Fresh graduate from Universitas Dian Nuswantoro, specialising in Laravel and Next.js.',
            'display_mode' => 'avatar',
            'social_links' => [
                'github'    => 'https://github.com/Zeinshirou04',
                'linkedin'  => '',
                'instagram' => '',
            ],
        ]);
    }
}