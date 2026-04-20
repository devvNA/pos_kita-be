# Jago POS Backend

## Project Snapshot

The Jago POS Backend is a monolithic backend API built using Laravel 12 and PHP 8.3. It functions as the core system for a multi-tenant Point of Sale (POS) application, managing businesses, outlets, staff, inventory (products/stock), and orders. It uses Laravel Sanctum for API authentication.

## Root Setup Commands

- **Install dependencies**: `composer install`
- **Setup Environment**: `cp .env.example .env && php artisan key:generate`
- **Database setup**: `php artisan migrate --seed`
- **Run dev server**: `php artisan serve`

## Universal Conventions

- **Controllers**: Keep controllers strictly focused on Request validation and Response formatting.
- **Models**: Business logic should reside in Eloquent Models or Dedicated Services.
- **API Responses**: Always return structured JSON responses using Laravel's standard responses or resource collections.
- **Routing**: Define all API routes in `routes/api.php` and prefix them under middleware `auth:sanctum` where protection is required.

## Security & Secrets

- Never commit secrets or API keys. Always use `.env` patterns.
- Authentication tokens are handled via Laravel Sanctum; requests must include `Authorization: Bearer <token>` for protected endpoints.
- Validate all incoming requests strictly using FormRequests or inline Controller validation.

## JIT Index

### Core Application Structure

- **API Routes**: `routes/api.php`
- **Controllers**: `app/Http/Controllers/Api/`
- **Models**: `app/Models/`
- **Database Migrations**: `database/migrations/`

### Quick Find Commands

- Search for a specific API Controller action: `rg -n "public function functionName" app/Http/Controllers/Api`
- Find a specific Model structure: `rg -n "class ModelName" app/Models`
- Locate a route definition: `rg -n "Route::.*endpoint" routes/api.php`
- Find migrations for a table: `rg -l "Schema::create\('table_name'" database/migrations`

## Definition of Done

- All API routes return appropriate response codes (e.g., 200, 201, 401, 422, 404).
- Request validation is present and covers edge cases.
- New database tables have corresponding Models, Migrations, and foreign keys configured.
- Static analysis and tests pass successfully before submission.
