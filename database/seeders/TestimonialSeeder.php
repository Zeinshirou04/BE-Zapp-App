<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'client_name'  => 'Budi Santoso',
                'client_photo' => 'images/default-client-photo.png',
                'quote'        => 'Zayn delivered our government monitoring system well ahead of schedule. The IoT integration was seamless and the codebase is clean enough that our internal team can maintain it without issues. Highly recommended for serious projects.',
            ],
            [
                'client_name'  => 'Siti Rahayu',
                'client_photo' => 'images/default-client-photo.png',
                'quote'        => 'We needed our legacy system migrated to a proper API without disrupting ongoing operations. Zayn handled the whole migration professionally — thorough documentation, zero downtime, and the new structure is so much easier to work with.',
            ],
            [
                'client_name'  => 'Ahmad Fauzi',
                'client_photo' => 'images/default-client-photo.png',
                'quote'        => 'Fast response, clean code, and transparent communication throughout the project. The admin dashboard Zayn built for us cut our internal operations time in half. Will definitely work together again.',
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}
