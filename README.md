The Garrison — Restaurant Web Application

A full-stack application for a fictional restaurant: menu presentation, table reservation system, separate authentication for customers and administrators, and an admin panel for managing the menu (add / edit / delete products with image upload).

## Screenshots

![Home page](docs/screenshots/home.png)
![Login](docs/screenshots/login.png)
![Admin panel - menu](docs/screenshots/admin.png)
![Table reservation](docs/screenshots/rezervare.png)


## Features

- **Authentication & registration** for customers, with PHP sessions and a "Remember me" option (persistent, hashed token, stored in a cookie).
- **Separate admin authentication**, with access to a dedicated panel.
- **Admin panel**: add, edit, and delete menu products, per category (Starters, Breakfast, Lunch, Dinner), with image upload and format validation (jpg/png/jpeg).
- The **public menu** displays only the products actually added by the admin, grouped by category — no demo content.
- **Reservation system**: automatically checks whether a table is available for the requested number of people and date before confirming the reservation.
- **Live search (AJAX)** of existing reservations, from the admin panel.
- **reCAPTCHA v2 protection** on the login form.

## Tech stack

- PHP 8.2 (Apache), MySQL, phpMyAdmin — orchestrated with Docker Compose
- mysqli with prepared statements for all database queries
- Passwords hashed with `password_hash()` / verified with `password_verify()` (for both customers and admins)
- PHP sessions + signed (SHA-256) cookies for "remember me"

## Running locally

Copy `.env.example` to `.env` and fill in the reCAPTCHA keys (get them for free from https://www.google.com/recaptcha/admin — or leave the fields empty for local development; reCAPTCHA verification is automatically disabled if they're not set).

Start the containers:

```
docker-compose up --build
```

Access:

- Site: http://localhost:8080
- phpMyAdmin: http://localhost:8081 (user `root`, password `toor`)

The database tables are created automatically on first startup (`db-init/schema.sql`, run by the MySQL container). A default admin account is created automatically the first time the site is accessed:

- Email: `admin@garrison.com`
- Password: `admin123`

It's recommended to change this password immediately after the first login (directly from phpMyAdmin, using PHP's `password_hash()` for the new value).

## Technical decisions worth noting

- All SQL queries use prepared statements to prevent SQL injection — including the live search form, which receives input directly from the user.
- Passwords are never stored in plain text; `password_hash()` is used with PHP's default algorithm (bcrypt), for both customers and administrators.
- Secret keys (reCAPTCHA) are not hard-coded in the source — they're read from environment variables, injected by Docker Compose from a local `.env` file, which is not committed to git.
- The database schema is versioned in the repo (`db-init/schema.sql`), so the project can be cloned and started from scratch without any manual database setup steps.

## Project structure

```
src/
  index.php, login.php, signup.php   -> public pages / authentication
  secure.php                          -> admin panel (menu listing)
  add.php, update.php, delete.php     -> menu CRUD (admin only)
  rezervare.php                       -> table reservation form
  search.php, livesearch.php          -> live reservation search (admin)
  function.php                        -> session / remember-me helpers
  dbconnection.php                    -> DB connection + default admin seed
  assets/clase/                       -> Mancare and Rezervare classes
db-init/schema.sql                    -> database schema (auto-run)
db-init/migration_add_categorie.sql   -> manual migration for existing databases
docker-compose.yml, Dockerfile        -> container orchestration
```

Menu products belong to one of the categories starters, breakfast, lunch, dinner (the `categorie` column in the `meniu` table). The add/edit forms in the admin panel include a category selector, and both the admin panel and the public menu display products correctly grouped by category.
