# API Boilerplate (Laravel)

A lightweight, ready-to-use Laravel API boilerplate tailored for quickly starting API projects.

This repository contains a minimal Laravel application pre-configured with:

-   Authentication scaffolding (auth routes and controllers).
-   API route organization under `routes/api/` (separate files for auth, user, admin).
-   `User` model and factories for testing/seeders.
-   Notifications for password reset flows.
-   Basic queue, cache and session configs.

This README explains how to clone, install, and run the project locally, and outlines the main available features and routes.

## Quick start — clone & run

1. Clone the repo:

```bash
git clone https://github.com/NeeRaj556/api_boilerplate.git
cd api_boiler_plate
```

2. Install PHP dependencies (Composer):

```bash
composer install
```

3. Install frontend dependencies (optional — required only if you plan to build assets):

```bash
npm install
npm run build # or `npm run dev` for development
```

4. Copy the environment file and set environment variables:

```bash
cp .env.example .env
# Edit .env: set DB_*, MAIL_*, APP_URL, etc.
php artisan key:generate
```

5. Run database migrations and seeders:

```bash
php artisan migrate --seed
```

6. Start the local development server:

```bash
php artisan serve
# The app will be available at http://127.0.0.1:8000
```

7. (Optional) Run the test suite:

```bash
vendor/bin/phpunit --colors=always
```

Notes:

-   This project follows standard Laravel conventions — if you use Docker, Sail, or another environment, adapt the commands accordingly.

## Built-in features

-   Organized API routes: see `routes/api.php` and the `routes/api/` directory which contains `auth.php`, `user.php`, and `admin.php`.
-   Authentication controllers under `app/Http/Controllers/` and `app/Models/User.php` as the primary user model.
-   Password reset flow wired with `app/Notifications/ResetPasswordNotification.php`.
-   Factory and seeder support in `database/factories` and `database/seeders`.
-   Basic queue, cache and session configuration files are included in `config/`.

## Important files & structure

-   `routes/` — API and web routing. See `routes/api/` for API endpoints.
-   `app/Models/User.php` — User model.
-   `app/Http/Controllers/` — Controllers for API auth, user and admin actions.
-   `database/migrations/` — Migrations to create required tables.
-   `database/factories/` and `database/seeders/` — Test data helpers.
-   `config/` — Application configuration; look at `jwt.php` and `sanctum.php` for auth options.

## API Overview

High-level API endpoints (adjust base URL to your `APP_URL` when running):

-   POST /api/auth/login — authenticate and obtain token
-   POST /api/auth/register — register new users
-   POST /api/auth/logout — invalidate token (requires auth)
-   GET /api/user/profile — get authenticated user profile

The exact route definitions live in `routes/api/auth.php`, `routes/api/user.php`, and `routes/api/admin.php`.

Tip: Use the `php artisan route:list --path=api` command to list all registered API routes.

## Environment & configuration

-   Database: configure `DB_CONNECTION`, `DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` in `.env`.
-   Queue: configure `QUEUE_CONNECTION` in `.env` (default is `sync` for development).
-   Mail: configure `MAIL_MAILER`, `MAIL_HOST`, `MAIL_PORT`, etc., to enable password reset emails.

## Testing

-   Basic PHPUnit setup is available. Run the test suite with:

```bash
vendor/bin/phpunit
```

-   Factories and seeders are available for common test scenarios.

## Troubleshooting

-   If migrations fail, check your DB connection settings and that the database exists.
-   If emails are not sent during password reset, verify mail settings in `.env` or use a mail catcher like MailHog.
-   If assets do not load, run `npm run build` (or `npm run dev`) and ensure `public/` contains compiled files.

## Next steps / optional improvements

-   Add an OpenAPI/Swagger spec or Postman collection for easier testing and documentation.
-   Add more unit & feature tests to cover auth flows and key endpoints.
-   Add CI configuration (GitHub Actions) to run tests automatically.

## Contributing

Contributions are welcome. Open issues or pull requests and include a clear description and tests where applicable.

## License

This project is open-source. Check `composer.json` for license information (MIT by default in this boilerplate).


