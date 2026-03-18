# GEMINI.md - puntuaTuProfe

## Project Overview

**puntuaTuProfe** is a web application designed as a "Rate My Professor" platform for students. It enables users to search for teachers, view their statistics, and share academic experiences through a detailed rating and review system.

### Key Features (Implemented)
- **Public Teacher Directory**: Searchable list of teachers with quality metrics accessible to everyone.
- **Teacher Profiles**: Detailed views including average quality, difficulty, punctuality, organization, and attendance percentages.
- **Advanced Review System**: 
    - Ratings (1-5) for Quality, Difficulty, Punctuality, and Organization.
    - Attendance tracking (Does the teacher take attendance?).
    - Teacher Role selection (Theory, Practice, or General).
    - Detailed comments linked to specific subjects.
- **OAuth Integration**: One-click login/registration with Google restricted to `@ucc.edu.ar` institutional emails.
- **Review Helpfulness**: Community voting system (Helpful/Not Helpful) for peer reviews.
- **Course Integration**: Reviews are linked to specific subjects for better context.
- **Admin Dashboard**: Full CRUD management for teachers and courses.
- **Spanish Localization**: Core interface and data presentation in Spanish.

---

## Technologies & Architecture

- **Backend**: PHP 8.3+, Laravel 13 (Standard MVC architecture).
- **Frontend**: Blade Templating Engine, Vite, Tailwind CSS 4.
- **Database**: **MySQL** (Production-ready).
- **Authentication**: Laravel Socialite (OAuth Google).
- **Service Layer**: Business logic encapsulated in `App\Services` (`TeacherService`, `ReviewService`) for cleaner controllers.
- **Development Tools**: Composer (PHP) and NPM (Frontend).

---

## Building and Running

### Prerequisites
- PHP 8.3+
- Composer
- Node.js & NPM
- MySQL Server

### Setup
1. `composer install`
2. `copy .env.example .env`
3. Configure your database credentials and OAuth keys in `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_DATABASE=puntuatuprofe
   DB_USERNAME=root
   DB_PASSWORD=your_password
   
   GOOGLE_CLIENT_ID=your_id
   GOOGLE_CLIENT_SECRET=your_secret
   GOOGLE_REDIRECT_URI="${APP_URL}/auth/google/callback"
   ```
4. `php artisan key:generate`
5. Create the database: `CREATE DATABASE puntuatuprofe;`
6. `php artisan migrate`
7. `npm install`
8. `npm run build`

### Development
Start the full development environment:
```bash
composer run dev
```

### Testing
Run the test suite:
```bash
composer run test
```

---

## Development Conventions & Best Practices

- **Service Layer**: Keep controllers lean. All complex logic (stats calculation, search filtering) must reside in Services.
- **Eloquent Scopes**: Use scopes in Models (e.g., `scopeSearch`, `scopeWithAvgQuality`) for reusable query logic.
- **Form Requests**: All validation must be handled in `App\Http\Requests`.
- **Blade Components**: Utilize `resources/views/components` for repetitive UI elements like teacher cards or buttons.
- **Environment Safety**: Never commit `.env` files. Ensure `.env.example` is kept up to date.
- **Tailwind 4**: Use modern Tailwind 4 syntax and directives.
- **Security**: 
    - Middleware protection for Admin routes.
    - Rate limiting for login and review submissions.
    - **OAuth Enforcement**: Focus on Institutional Email validation (e.g., `@ucc.edu.ar`).

---

## Git Workflow (Mandatory)

To ensure stability and a clean history, all development must follow this workflow:

1.  **Feature Branches**: Every new feature, bug fix, or modification must be developed in its own dedicated branch (e.g., `feature/oauth-integration`, `fix/attendance-logic`).
2.  **Testing & Validation**: Before merging, the feature must be manually verified and pass all automated tests (`composer run test`).
3.  **Merge Policy**: Branches should only be merged into `master` (or the main branch) once the implementation is complete, idiomatically correct, and verified.
4.  **No Direct Commits**: Avoid making direct commits to the main branch for complex features.

---

## Roadmap & Notes
- The project is currently in an active development phase.
- **Goal**: Provide a transparent and useful tool for the student community.
- **Focus**: Data integrity and meaningful user-generated content.
