# Laravel User & Group Management System

## About
This is a Laravel-based User and Group Management System built using Blade templates. The project demonstrates CRUD operations, many-to-many relationships between users and groups, and soft delete & restore functionality.

## Features
- User CRUD Operations
- Group CRUD Operations
- Many-to-Many Relationship (Users ↔ Groups)
- Soft Delete Functionality
- Restore Deleted Records
- Blade-Based User Interface

## Tech Stack
- Laravel
- PHP
- MySQL
- Blade Templates
- Bootstrap

## Installation

```bash
git clone <repository-url>
cd project-folder
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve