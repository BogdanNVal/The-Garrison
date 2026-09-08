# The Garrison — QA notes

I tested [The Garrison](https://github.com/BogdanNVal/The-Garrison) on the current `main` build — a restaurant web app (PHP + MySQL + Yummy front end): customer accounts, table reservations, admin menu management, and live search for reservations.

This folder is what I produced while testing it — plan, cases, bugs I found (including a second-pass deeper hunt), ones I re-checked after the project fixes on main, checklists, and a short Playwright smoke pack.

Open on current main: **BUG-009…018** (see `bug-reports/`). BUG-001…008 were retested and marked fixed.

## Folder layout

| Path | What it is |
|------|------------|
| [test-plan.md](test-plan.md) | What I covered / skipped |
| [test-cases/](test-cases/) | Manual cases by area |
| [bug-reports/](bug-reports/) | Bugs logged during testing |
| [checklists/](checklists/) | Smoke + regression |
| [automation/](automation/) | Playwright smoke (TypeScript) |

## App under test

- Local URL: http://localhost:8080
- Stack: PHP 8.2+, MySQL 8, Docker Compose (or host PHP + MySQL)
- Default admin: `admin@garrison.com` / `admin123`
- Front end: Yummy template assets are in the repo on current main

## Run the app

From the repo root:

```bash
cp .env.example .env
```

Leave the reCAPTCHA fields empty for local testing (otherwise login breaks).

```bash
docker compose up --build
```

- Site: http://localhost:8080  
- phpMyAdmin: http://localhost:8081 (root / toor)

If Compose networking misbehaves on your machine, see [docker/README.md](docker/README.md).

## Run the smoke tests

App must be up first.

```bash
cd qa-portfolio/automation
npm install
npx playwright install chromium
npm test
```

Optional: `BASE_URL=http://127.0.0.1:8080 npm test`
