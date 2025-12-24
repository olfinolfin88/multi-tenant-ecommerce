# Multi-Tenant E-Commerce Platform

A robust multi-tenant e-commerce application using a database-per-tenant architecture. The project demonstrates strict data isolation, automated tenant onboarding via CLI, and a modern frontend built with Inertia.js.

## Key Features

- **Strict Data Isolation** — each tenant uses its own MySQL database; data from one tenant cannot leak to another.
- **Automated Onboarding CLI** — an Artisan command provisions stores, domains, databases, and runs migrations.
- **Full Shopping Cart** — add/remove items and manage quantities; cart data is persisted in the database.
- **Modern UI/UX** — Tailwind CSS, Heroicons, and SweetAlert2 for interactive notifications.
- **Automated Tests** — includes `TenantIsolationTest` to verify tenant data separation.

## Tech Stack

- Backend: Laravel 12
- Frontend: Vue 3 (Composition API) + Inertia.js
- Database: MySQL (multi-database architecture)
- Styling: Tailwind CSS
- Icons: Heroicons
- Testing: PHPUnit

## Installation

1. Clone the repository

```bash
git clone https://github.com/your-username/your-repo-name.git
cd your-repo-name
```

2. Install dependencies

```bash
# PHP dependencies
composer install

# JS dependencies (use legacy flag for Vite 7 compatibility)
npm install --legacy-peer-deps
```

3. Environment setup

```bash
cp .env.example .env
php artisan key:generate
```

Configure database in `.env`. Create a central database (for example `ecommerce_central`). Tenant databases will be created automatically by the provisioning command.

Example `.env` database section:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ecommerce_central
DB_USERNAME=root
DB_PASSWORD=
```

4. Run central migrations

```bash
php artisan migrate
```

## Create a New Store (Tenant)

Use the included Artisan command to provision a tenant (creates tenant record, domain, database and runs migrations):

```bash
# Syntax
php artisan tenant:create {store_name}

# Example
php artisan tenant:create store1
```

Expected output (example):

- Creating store: store1 ...
- Tenant & Domain created successfully.
- Running database migrations for store1...
- Database migrated.
- SUCCESS! Store 'store1' is ready.
- URL: http://store1.localhost:8000

You can run this multiple times to create other stores (e.g., `store2`, `appleshop`).

## Run the Application

Start the Laravel server:

```bash
php artisan serve
```

Start the frontend (Vite):

```bash
npm run dev
```

Open the tenant subdomains in your browser (ensure local DNS resolves subdomains to `127.0.0.1`):

- http://store1.localhost:8000
- http://store2.localhost:8000

## Testing (Verify Tenant Isolation)

Run the test that proves tenant data separation:

```bash
php artisan test --filter=TenantIsolationTest
```

The test will:

- create two temporary tenants
- insert data into Tenant A
- switch to Tenant B and assert Tenant A's data is not visible
- insert data into Tenant B
- switch back to Tenant A and ensure data integrity

## Author
M.Olfin Ulum
Fullstack Developer 
