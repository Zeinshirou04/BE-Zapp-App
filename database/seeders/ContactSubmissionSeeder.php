<?php

namespace Database\Seeders;

use App\Models\ContactSubmission;
use App\Models\ContactAttachment;
use Illuminate\Database\Seeder;

class ContactSubmissionSeeder extends Seeder
{
    public function run(): void
    {
        // Submission 1 — with attachment
        $submission = ContactSubmission::create([
            'from_name'  => 'Rizky Pratama',
            'from_email' => 'rizky@example.com',
            'from_phone' => '081234567890',
            'subject'    => 'Request for SaaS Development Quote',
            'content'    => 'Hi, I run a small coffee shop chain with 3 branches in Semarang. I need a system to manage stock, daily sales, and employee shifts across all branches. Can you provide a quote? I have attached a rough requirement document.',
            'status'     => 'unread',
        ]);

        ContactAttachment::create([
            'submission_id' => $submission->id,
            'path'          => 'contact-attachments/requirements-rizky.pdf',
            'original_name' => 'requirements.pdf',
            'mime_type'     => 'application/pdf',
            'size_bytes'    => 204800,
        ]);

        // Submission 2 — no attachment, already read
        ContactSubmission::create([
            'from_name'  => 'Dewi Lestari',
            'from_email' => 'dewi@example.com',
            'from_phone' => '081234567890',
            'subject'    => 'Website Maintenance Inquiry',
            'content'    => 'Hello, I have an existing Laravel website that has not been updated in over a year. I am worried about security and some features are broken. Are you available for monthly maintenance? Please let me know your rates.',
            'status'     => 'read',
        ]);

        // Submission 3 — replied
        ContactSubmission::create([
            'from_name'  => 'Hendra Wijaya',
            'from_email' => 'hendra@example.com',
            'from_phone' => '087654321090',
            'subject'    => 'REST API for Mobile App',
            'content'    => 'We are building a mobile app for our construction company to track field worker attendance and project progress. We need a REST API backend. How long would this take and what is the cost?',
            'status'     => 'replied',
        ]);
    }
}
