# The Garrison

Restaurant web app built as a school / portfolio project. Customers can browse the menu, create an account, and book a table. Admins get a separate login and a small panel to manage menu items (add, edit, delete, with image upload).

The front end uses the free [Yummy](https://bootstrapmade.com/yummy-bootstrap-restaurant-website-template/) template from BootstrapMade. The backend is custom PHP and MySQL. The footer still credits BootstrapMade, as required by their [free license](https://bootstrapmade.com/license/).

## Screenshots

![Home page](docs/screenshots/home.png)
![Login](docs/screenshots/login.png)
![Admin panel - menu](docs/screenshots/admin.png)
![Table reservation](docs/screenshots/rezervare.png)

## What it does

- Customer signup / login with PHP sessions and an optional “Remember me” cookie (token is hashed before storage)
- Separate admin login and admin-only pages
- Menu CRUD by category (starters, breakfast, lunch, dinner), including jpg/png/jpeg image checks
- Public menu is loaded from the database and grouped by category
- Table reservations that check availability for the party size and date (past dates are rejected)
- Admin live search over reservations (AJAX; requires an admin session)
- Optional reCAPTCHA v2 on the login form

## Stack

- PHP 8.2 on Apache, MySQL 8, phpMyAdmin, all started with Docker Compose
- `mysqli` prepared statements for queries
- Passwords hashed with `password_hash()` / checked with `password_verify()`
- Sessions plus SHA-256 hashed remember-me cookies
- reCAPTCHA keys come from env vars (`.env`), not from the source tree

## Running locally

1. Copy `.env.example` to `.env`.
2. Put real reCAPTCHA keys in `.env` if you want the captcha on, or leave the values empty for local work (verification is skipped when the secret is missing).
3. Start the stack:

```bash
docker compose up --build
```

Then open:

- App: http://localhost:8080
- phpMyAdmin: http://localhost:8081 (`root` / `toor`)

On first MySQL start, `db-init/schema.sql` creates the tables and a few sample starters so the public menu is not empty. The first HTTP hit also seeds a default admin if the `admins` table is empty:

- Email: `admin@garrison.com`
- Password: `admin123`

Change that password after you log in. Easiest path locally is phpMyAdmin with a new hash from PHP’s `password_hash()`.

If image uploads fail under Docker, make the upload folder writable on the host, for example:

```bash
chmod 777 src/assets/img/menu
```

## QA notes

Test plan, manual cases, bug reports, checklists, and Playwright smoke tests for the current main build are in [`qa-portfolio/`](qa-portfolio/README.md).

## Project layout

```
src/
  index.php, login.php, signup.php   public site and auth
  secure.php                         admin menu list
  add.php, update.php, delete.php    menu CRUD (admin)
  rezervare.php                      table booking
  search.php, livesearch.php         reservation search (admin)
  function.php                       session / remember-me helpers
  dbconnection.php                   DB connection + default admin seed
  components/                        page sections (Yummy-based)
  assets/clase/                      Mancare and Rezervare classes
  assets/{css,js,vendor,img}/        front-end assets
qa-portfolio/                        QA docs + Playwright smoke
db-init/schema.sql                   schema + seed data (auto-run)
docker-compose.yml, Dockerfile       containers
```

Menu rows use a `categorie` enum (`starters`, `breakfast`, `lunch`, `dinner`). The admin forms expose that as a select, and both the admin list and the public menu group items the same way.

## Notes

Prepared statements are used across the app, including the live search endpoint. Secrets stay in `.env` (gitignored) and are passed into the PHP container by Compose. After a fresh clone you should not need manual SQL setup beyond what Docker runs from `db-init/`.
