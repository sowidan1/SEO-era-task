# SEO ERA Task

A robust, feature-rich Laravel-based RESTful API for comprehensive authentication and post management, integrated with a Filament admin panel for seamless dashboard functionality.

## Table of Contents
- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
- [Configuration](#configuration)
- [Admin Panel](#admin-panel)
- [Bonus Features](#bonus-features)
- [Output](#output)
- [Contributing](#contributing)

## Features

### Core Functionality
- **User Authentication**: Register and login using email, username, password, and Egyptian mobile number, secured with JWT (JSON Web Tokens).
- **Post Management**: Authenticated users can create posts with a required title, description (limited to 2 KB), and contact phone number (validated as an Egyptian mobile number).
- **Post Listing**: Users can view a paginated list of posts created by other users, displaying title and description (truncated to 512 characters), sorted by most recent first.
- **Admin Panel**: A Filament-based control panel for CRUD operations on users and posts.
- **Database Management**: Uses Laravel migrations and seeders for database setup and initial data population.
- **ORM Relationships**: Leverages Laravel Eloquent ORM for relationships between users and posts.
- **Logging**: Integrates Laravel Telescope for logging all actions and errors.

### Bonus Features
- **SOLID Principles and Design Patterns**: Implements separation of concerns using service classes (`AuthService`, `PostService`) and dependency injection, adhering to SOLID principles.
- **Mobile Number Login**: Supports login via Egyptian mobile number and password.
- **Daily Reports**: Generates a daily report at midnight for new posts and users, sent via email to the admin.

## Requirements
- **PHP**: 8.1 or higher
- **Composer**: 2.0 or higher
- **MySQL**: 8.0 or higher
- **Laravel**: 12.x
- **Node.js**: For Filament admin panel assets
- **Mail Server**: SMTP server for sending daily reports

## Installation

### 1. Clone the Repository
```bash
git clone https://github.com/sowidan1/SEO-era-task.git
cd SEO-era-task
```

### 2. Install Dependencies
Install PHP dependencies via Composer:
```bash
composer install
```
Install Node.js dependencies for Filament:
```bash
npm install && npm run build
```

### 3. Environment Setup
Copy the example environment file and generate an application key:
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Database Migration
Run migrations to set up the database schema:
```bash
php artisan migrate
```
Optionally, seed the database with initial data:
```bash
php artisan db:seed
```

### 5. Install Laravel Telescope
Laravel Telescope is pre-installed for logging actions and errors.
```bash
artisan make:filament-user
```
### Access it at:
```
http://your-domain/telescope
```
Ensure Telescope is configured in the `.env` file:
```env
TELESCOPE_ENABLED=true
```

## Configuration

### Environment Variables
Edit the `.env` file with the following settings:

#### Database Configuration
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=seo_era_task
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

#### JWT Configuration
```env
JWT_SECRET=your_jwt_secret
```
Generate the JWT secret:
```bash
php artisan jwt:secret
```

#### Queue Configuration
For processing daily reports:
```env
QUEUE_CONNECTION=database
```

#### Mail Configuration
For sending daily reports to the admin:
```env
MAIL_MAILER=smtp
MAIL_HOST=your_smtp_host
MAIL_PORT=587
MAIL_USERNAME=your_email@domain.com
MAIL_PASSWORD=your_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your_email@domain.com
MAIL_FROM_NAME="${APP_NAME}"
```

### Background Tasks
Start the queue worker to process daily reports:
```bash
php artisan queue:work
```

## Admin Panel
The admin panel is built using **Filament**, providing a user-friendly interface for managing users and posts:
- **Access**: `http://your-domain/admin`
- **Features**:
  - CRUD operations for users (create, read, update, delete).
  - CRUD operations for posts, including viewing and editing title, description, and contact phone.
- **Authentication**
```bash
    artisan make:filament-user
```

## Bonus Features
- **SOLID Principles**: Uses service classes (`AuthService`, `PostService`) and dependency injection for clean, maintainable code.
- **Mobile Number Login**: Supports login with Egyptian mobile numbers.
- **Daily Reports**: A scheduled command generates a daily report of new users and posts, emailed to the admin at midnight.

## Output
1. **Code Repository**: The code is hosted on GitHub: [https://github.com/sowidan1/SEO-era-task](https://github.com/sowidan1/SEO-era-task).
2. **Postman Collection**: Included in the repository as `postman_collection.json`.
3. **Database Dump**: A full database dump (`seo_era_task.sql`) is included in the repository for reference.
4. **README**: This file provides detailed setup and deployment instructions.

## Contributing
Developed with ❤️ by [Osama Sowidan](https://github.com/sowidan1) - Software Engineer.

For contributions, please fork the repository, create a feature branch, and submit a pull request. Ensure all tests pass and follow the coding standards.
