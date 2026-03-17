# GEMINI.md

## Project Overview

**puntuaTuProfe** is a web application designed to be a "Rate My Professor" style site. It is built using the **Laravel 13** framework, focusing on providing a platform for students to rate and review their teachers.

### Key Features (Planned)
- Teacher profiles and search.
- Rating system (quality, difficulty, etc.).
- Student reviews and comments.
- Course and department categorization.

---

## Technologies & Architecture

- **Backend:** PHP 8.3+, Laravel 13 (Standard MVC architecture).
- **Frontend:** Blade Templating Engine, Vite, Tailwind CSS 4.
- **Database:** SQLite (default for local development, as seen in `database/database.sqlite`).
- **Development Tools:** Composer for PHP dependencies, NPM for frontend dependencies.

---

## Building and Running

### Prerequisites
- PHP 8.3+
- Composer
- Node.js & NPM
- PHP Extensions: `fileinfo`, `pdo_sqlite` (recommended).

### Setup
Run the following command to set up the environment, install dependencies, and run migrations:
```bash
composer run setup
```
Alternatively, follow these manual steps:
1. `composer install`
2. `copy .env.example .env` (if not already present)
3. `php artisan key:generate`
4. `touch database/database.sqlite` (if not present)
5. `php artisan migrate`
6. `npm install`
7. `npm run build`

### Development
Start the development environment (starts server, queue, logs, and Vite):
```bash
composer run dev
```
Or separately:
- **Server:** `php artisan serve`
- **Vite:** `npm run dev`

### Testing
Run the test suite:
```bash
composer run test
```

---

## Development Conventions

- **Models:** Located in `app/Models`. Use Eloquent for database interactions.
- **Controllers:** Located in `app/Http/Controllers`.
- **Routes:**
  - Web routes: `routes/web.php`
  - API routes: `routes/api.php` (if needed)
  - Console routes: `routes/console.php`
- **Views:** Blade templates located in `resources/views`.
- **Migrations:** Located in `database/migrations`. Use `php artisan make:migration` to create new ones.
- **Tests:** Located in `tests/`. Use `php artisan test` or `phpunit`.
- **Assets:** Managed by Vite in `resources/js` and `resources/css`. Tailwind CSS 4 is pre-configured.

---

## Project-Specific Notes
- The project is in its initial scaffolding phase.
- Goal: Implement features similar to "Rate My Professor".
- Primary focus: User-generated ratings and reviews for educational staff.
