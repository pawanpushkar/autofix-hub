# AutoFix Hub

A Laravel web app for submitting vehicle repair requests and managing repair quotes.

## Features

- Customer registration and login
- Repair requests with vehicle details and damage photos
- Repairer account for reviewing requests and creating quotes
- Quote acceptance and repair status tracking
- Role-based access to customer and repairer actions

## Built with

- PHP and Laravel
- Blade, HTML, and CSS
- SQLite

## Run locally

1. Install PHP, Composer, and Node.js.
2. Run `composer install`.
3. Copy `.env.example` to `.env`.
4. Run `php artisan key:generate`.
5. Run `php artisan migrate`.
6. Run `php artisan storage:link`.
7. Start the app with `php artisan serve`.
