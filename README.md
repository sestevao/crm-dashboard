# CRM Dashboard

A comprehensive Customer Relationship Management system built with Laravel, featuring a modern dashboard interface for managing company resources, projects, and team collaboration.

<p align="center">
  <img src="github/dashboard.png" alt="CRM Dashboard Screenshot" width="100%">
</p>

## Features

- **Project Management**
  - Create and manage projects
  - Task tracking with attachments
  - Time estimation and tracking
  - Backlog management
  - Team collaboration

- **Employee Management**
  - Employee profiles
  - Skill tracking
  - Role-based access control
  - Vacation management

- **Communication Tools**
  - Built-in messenger
  - Real-time notifications
  - Calendar events
  - Information portal

- **Document Management**
  - Role-based document access
  - Document categorization
  - File attachments

## Technologies

- **Backend:** Laravel 10.x
- **Frontend:** Tailwind CSS, JavaScript
- **Database:** MySQL/PostgreSQL
- **Authentication:** Laravel Breeze

## Requirements

- PHP >= 8.1
- Node.js >= 16.x
- Composer
- MySQL or PostgreSQL

## Installation

1. Clone the repository:
```bash
git clone https://github.com/yourusername/crm-dashboard.git
cd crm-dashboard
```

2. Install PHP dependencies:
```bash
composer install
```

3. Install NPM dependencies:
```bash
npm install
```

4. Create environment file:
```bash
cp .env.example .env
```

5. Generate application key:
```bash
php artisan key:generate
```

6. Configure your database in `.env` file:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

7. Run database migrations:
```bash
php artisan migrate
```

8. Build assets:
```bash
npm run build
```

9. Start the development server:
```bash
php artisan serve
```

Visit `http://localhost:8000` in your browser.

## Development

To start the development server with hot-reloading:

```bash
npm run dev
```

## Testing

Run the test suite:

```bash
php artisan test
```

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).