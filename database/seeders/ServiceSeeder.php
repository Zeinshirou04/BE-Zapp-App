<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'name'        => 'REST API Development',
                'type'        => 'api',
                'description' => 'Production-ready REST API built with Laravel. Includes Sanctum authentication, role-based access control, API Resource responses, and full endpoint documentation. Ideal for businesses that need a reliable backend for their mobile app or web frontend.',
                'includes'    => [
                    'Laravel REST API',
                    'Sanctum token authentication',
                    'Spatie role & permission setup',
                    'API Resource layer',
                    'Postman collection & documentation',
                    'Deployment to your server',
                ],
                'price'       => 1500000.00,
                'duration'    => '7-14 days',
                'is_active'   => true,
            ],
            [
                'name'        => 'SaaS Application Development',
                'type'        => 'saas',
                'description' => 'Full-stack SaaS application built with Laravel and Next.js. Covers multi-tenant architecture, subscription management, admin panel via Filament, and a polished frontend. Perfect for businesses looking to launch a digital product.',
                'includes'    => [
                    'Laravel backend API',
                    'Next.js frontend (TypeScript)',
                    'Filament admin panel',
                    'Multi-tenancy setup',
                    'Midtrans billing integration',
                    'Deployment & CI setup',
                ],
                'price'       => 5000000.00,
                'duration'    => '30-60 days',
                'is_active'   => true,
            ],
            [
                'name'        => 'Admin Dashboard',
                'type'        => 'dashboard',
                'description' => 'A clean, functional admin dashboard built with Filament on top of your existing Laravel application. Manage your data, users, and business operations from a single interface without writing a single line of frontend code.',
                'includes'    => [
                    'Filament v3 admin panel',
                    'Custom resources & pages',
                    'Role-based access control',
                    'Charts & analytics widgets',
                    'Export to CSV/Excel',
                ],
                'price'       => 1000000.00,
                'duration'    => '5-10 days',
                'is_active'   => true,
            ],
            [
                'name'        => 'Website Maintenance & Support',
                'type'        => 'maintenance',
                'description' => 'Ongoing maintenance for your existing Laravel or Next.js application. Covers bug fixes, dependency updates, performance monitoring, and minor feature additions. Available on a monthly retainer basis.',
                'includes'    => [
                    'Bug fixes & patches',
                    'Dependency & security updates',
                    'Performance monitoring',
                    'Up to 10 hours of minor feature work per month',
                    'Priority response within 24 hours',
                ],
                'price'       => 500000.00,
                'duration'    => 'Monthly retainer',
                'is_active'   => true,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
