
## Project setup

### Requirements

- PHP 8.2 or newer
- Composer
- Node.js and npm

### Installation

Clone the repository, install the PHP and JavaScript dependencies, and create the local environment file:

```bash
composer install
cp .env.example .env
php artisan key:generate
npm install
```

The default `.env.example` configuration uses SQLite. Create the database file if it does not already exist:

```bash
touch database/database.sqlite
```

If you prefer MySQL or another supported database, update the `DB_*` values in `.env` before running the migrations.

### Migrations and data seeding

Run the database migrations to create the application tables:

```bash
php artisan migrate
```

Populate the database with the default administrator and sample products:

```bash
php artisan db:seed
```

To rebuild the database from scratch and seed it in one command, use:

```bash
php artisan migrate:fresh --seed
```

The default seeded administrator is `CEO@zeno-sphere.com` with the password `password123`. Change these credentials before using the application outside local development.

### Running the application

Start the Laravel and Vite development servers in separate terminals:

```bash
php artisan serve
npm run dev
```

Then open `http://localhost:8000`.

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of common tasks in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has extensive [documentation](https://laravel.com/docs) and a video tutorial library for modern PHP, unit testing, and JavaScript.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please review the [Laravel security policy](https://github.com/laravel/framework/security/policy).


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
