# Technical Overview: Jago POS Backend

## Project Snapshot

The **Jago POS Backend** is a monolithic API application built with **Laravel 12** and **PHP 8.3**. It serves as the backend for a multi-tenant Point of Sale (POS) and inventory management system. It uses **Laravel Sanctum** for secure, token-based authentication (stateful and stateless) and exposes endpoints for managing core POS entities like businesses, outlets, staff, products, stocks, and orders.

---

## Core Components

- **Authentication & Authorization (`AuthController`, `Sanctum`)**: Manages user registration, login, logout, and token provisioning. Includes role/manager logic.
- **Multi-Tenant / Business Organization (`Business`, `Outlet`, `Staff`)**: The system supports multiple business entities. A Business can have multiple Outlets, and Staff members/Managers are assigned to specific businesses/outlets.
- **Inventory Management (`Product`, `Category`, `Stock`, `StockHistory`)**: Handles the creation and management of products and categories. Stocks are tracked per branch/outlet, and `StockHistory` keeps an audit trail of stock movements.
- **Point of Sale / Orders (`Order`, `OrderItem`, `OrderTax`, `OrderDiscount`)**: Manages the core transaction flow. It stores the main order details, nested items purchased, applied taxes, and discounts.
- **Peripheral & Settings Management (`Printer`, `BusinessSetting`)**: Stores configurations for specific businesses and hardware mappings (e.g., thermal printers associated with an outlet).
- **Reporting (`SalesSummary`, `SalesTransaction`, `SalesReportController`)**: Handles aggregating sales data to provide daily reports and transaction summaries.

---

## Component Interactions

- **Data Flow**:
    - The entry point for all mobile/web client requests is the API routes defined in `routes/api.php`.
    - Typical request flow: `Route` -> `Middleware (auth:sanctum)` -> `Api/Controller` -> `Eloquent Model` -> `Database`.
- **API Interfaces**:
    - The backend communicates entirely over JSON-based REST APIs.
    - Form data (including multipart/form-data for file/image uploads, e.g., in `ProductController@updateProductWithImage`) is accepted and processed within controllers.
- **Database Abstraction**: Uses Laravel's built-in Eloquent ORM. Relationships are defined natively within `app/Models/` (e.g., an `Order` has many `OrderItem`s). Relationships guarantee data integrity between the Business, Outlet, and their respective operational scopes.

---

## Deployment Architecture

- **Environment**: PHP ^8.3, typically backed by MySQL or PostgreSQL in production (though defaults to SQLite during development based on current Laravel 12 defaults).
- **Build & Run**: Uses standard `composer` dependency management. Development environments run via `php artisan serve` or using Vite (`npm run dev`) if frontend scaffolding exists.
- **Infrastructure**: Designed to run easily on a standard VPS or containerized environments (e.g., using Laravel Sail/Docker).

---

## Runtime Behavior

- **Initialization**: Bootstraps via `public/index.php`, loading environment variables (`.env`) and Laravel service providers.
- **Request Lifecycle**: Middleware groups handle CORS and Sanctum stateful checks before requests hit the Controllers.
- **Error Handling & Response**: Standard Laravel Exception Handler guarantees consistent JSON error outputs for API endpoints (e.g., validation errors return 422, unauthenticated returns 401).
