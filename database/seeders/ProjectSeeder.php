<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\ProjectTimeline;
use App\Models\ProjectContributor;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $zayn        = User::where('email', 'zayn@zapp.web.id')->first();
        $contributor = User::where('email', 'contributor@zapp.web.id')->first();

        // ------------------------------------------------------------------ //
        // Project 1 — Stunting Monitoring System (Government · IoT)
        // ------------------------------------------------------------------ //
        $stunting = Project::create([
            'title'          => 'Stunting Monitoring System',
            'slug'           => 'stunting-monitoring-system',
            'type'           => 'web',
            'brief'          => 'A government-backed IoT-integrated web application built for the City of Semarang to monitor child stunting rates across districts. Features real-time sensor data ingestion, district-level dashboards, and automated reporting for health officers.',
            'stack'          => ['Laravel', 'MySQL', 'IoT', 'Tailwind CSS', 'Chart.js'],
            'cover_image_url'    => 'images/default-project-cover-image.png',
            'earning'        => 0,
            'is_maintained'  => true,
            'started_at'     => '2024-01-15',
            'ended_at'       => '2024-06-30',
        ]);

        ProjectImage::insert([
            ['project_id' => $stunting->id, 'path' => 'projects/stunting/dashboard.png',  'caption' => 'District overview dashboard',     'sort_order' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['project_id' => $stunting->id, 'path' => 'projects/stunting/map-view.png',   'caption' => 'Interactive district map',         'sort_order' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['project_id' => $stunting->id, 'path' => 'projects/stunting/report.png',     'caption' => 'Automated monthly report export',  'sort_order' => 3, 'created_at' => now(), 'updated_at' => now()],
        ]);

        ProjectTimeline::insert([
            ['project_id' => $stunting->id, 'title' => 'Project Kickoff',          'description' => 'Initial requirement gathering with Semarang City Health Department.',            'occurred_at' => '2024-01-15', 'created_at' => now(), 'updated_at' => now()],
            ['project_id' => $stunting->id, 'title' => 'IoT Integration Complete',  'description' => 'Sensor data pipeline connected to the Laravel backend via MQTT broker.',        'occurred_at' => '2024-03-10', 'created_at' => now(), 'updated_at' => now()],
            ['project_id' => $stunting->id, 'title' => 'UAT & Handover',            'description' => 'User acceptance testing passed. System handed over to the health department.',  'occurred_at' => '2024-06-30', 'created_at' => now(), 'updated_at' => now()],
        ]);

        ProjectContributor::insert([
            ['project_id' => $stunting->id, 'user_id' => $zayn->id,        'name' => 'Zayn',        'role' => 'Full Stack Developer', 'created_at' => now(), 'updated_at' => now()],
            ['project_id' => $stunting->id, 'user_id' => $contributor->id, 'name' => 'Contributor',  'role' => 'Backend Developer',    'created_at' => now(), 'updated_at' => now()],
        ]);

        // ------------------------------------------------------------------ //
        // Project 2 — Legacy PHP to Laravel REST API Migration
        // ------------------------------------------------------------------ //
        $migration = Project::create([
            'title'          => 'Legacy PHP to Laravel REST API Migration',
            'slug'           => 'legacy-php-laravel-api-migration',
            'type'           => 'api',
            'brief'          => 'Migrated a legacy Native PHP application into a structured Laravel REST API for a local government office. Refactored spaghetti procedural code into clean MVC architecture, added Sanctum token authentication, and documented all endpoints.',
            'stack'          => ['Laravel', 'Sanctum', 'MySQL', 'PHP'],
            'cover_image_url'    => 'images/default-project-cover-image.png',
            'earning'        => 0,
            'is_maintained'  => false,
            'started_at'     => '2024-07-01',
            'ended_at'       => '2024-09-15',
        ]);

        ProjectImage::insert([
            ['project_id' => $migration->id, 'path' => 'projects/api-migration/before.png',  'caption' => 'Legacy codebase structure',      'sort_order' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['project_id' => $migration->id, 'path' => 'projects/api-migration/after.png',   'caption' => 'Refactored Laravel API structure', 'sort_order' => 2, 'created_at' => now(), 'updated_at' => now()],
        ]);

        ProjectTimeline::insert([
            ['project_id' => $migration->id, 'title' => 'Codebase Audit',       'description' => 'Audited the existing Native PHP codebase, documented all endpoints and business logic.',  'occurred_at' => '2024-07-01', 'created_at' => now(), 'updated_at' => now()],
            ['project_id' => $migration->id, 'title' => 'Migration Complete',   'description' => 'All endpoints migrated to Laravel. Sanctum auth layer added.',                           'occurred_at' => '2024-08-20', 'created_at' => now(), 'updated_at' => now()],
            ['project_id' => $migration->id, 'title' => 'Documentation & QA',  'description' => 'Full API documentation written and QA testing completed.',                               'occurred_at' => '2024-09-15', 'created_at' => now(), 'updated_at' => now()],
        ]);

        ProjectContributor::insert([
            ['project_id' => $migration->id, 'user_id' => $zayn->id, 'name' => 'Zayn', 'role' => 'Full Stack Developer', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // ------------------------------------------------------------------ //
        // Project 3 — LLM Voice Interaction Robot
        // ------------------------------------------------------------------ //
        $robot = Project::create([
            'title'          => 'LLM-Powered Voice Interaction Robot',
            'slug'           => 'llm-voice-interaction-robot',
            'type'           => 'other',
            'brief'          => 'An AI-powered voice interaction robot built in Python for a government technology showcase. Integrates a large language model backend with speech-to-text and text-to-speech pipelines, enabling natural voice conversations with visitors at the event.',
            'stack'          => ['Python', 'LLM', 'Speech-to-Text', 'Text-to-Speech', 'FastAPI'],
            'cover_image_url'    => 'images/default-project-cover-image.png',
            'earning'        => 0,
            'is_maintained'  => false,
            'started_at'     => '2024-10-01',
            'ended_at'       => '2024-11-30',
        ]);

        ProjectImage::insert([
            ['project_id' => $robot->id, 'path' => 'projects/voice-robot/robot.png',    'caption' => 'Robot at the showcase event',      'sort_order' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['project_id' => $robot->id, 'path' => 'projects/voice-robot/pipeline.png', 'caption' => 'Voice pipeline architecture diagram', 'sort_order' => 2, 'created_at' => now(), 'updated_at' => now()],
        ]);

        ProjectTimeline::insert([
            ['project_id' => $robot->id, 'title' => 'Pipeline Design',      'description' => 'Designed the STT → LLM → TTS pipeline architecture.',                              'occurred_at' => '2024-10-01', 'created_at' => now(), 'updated_at' => now()],
            ['project_id' => $robot->id, 'title' => 'Integration Complete',  'description' => 'Voice pipeline fully integrated with the LLM backend and robot hardware.',        'occurred_at' => '2024-11-10', 'created_at' => now(), 'updated_at' => now()],
            ['project_id' => $robot->id, 'title' => 'Live Showcase',         'description' => 'Robot demonstrated live at the government technology event in Semarang.',         'occurred_at' => '2024-11-30', 'created_at' => now(), 'updated_at' => now()],
        ]);

        ProjectContributor::insert([
            ['project_id' => $robot->id, 'user_id' => $zayn->id, 'name' => 'Zayn', 'role' => 'AI & Backend Developer', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
