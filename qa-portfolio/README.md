# Junior QA Portfolio — The Garrison

Manual test design, bug reports, smoke/regression checklists, and a small Playwright (TypeScript) smoke suite for **[The Garrison](https://github.com/BogdanNVal/The-Garrison)** — a PHP/MySQL restaurant web app (menu admin, auth, table reservations).

This folder is a **QA-owned portfolio**, not another product app. It shows how a junior software tester approaches a real system under test (SUT).

## What’s inside

| Path | Purpose |
|------|---------|
| [test-plan.md](test-plan.md) | Scope, environments, risks, test data |
| [test-cases/](test-cases/) | ~35 manual cases (AUTH, MENU_ADMIN, RESERVATIONS, SEARCH) |
| [bug-reports/](bug-reports/) | Defects found while exploring the SUT |
| [checklists/](checklists/) | Smoke + regression checklists |
| [automation/](automation/) | Playwright smoke tests (TypeScript) |

## System under test

- **App:** The Garrison (`../` in this repository)
- **Stack:** PHP 8.2, MySQL, Docker Compose
- **URL (local):** http://localhost:8080
- **Default admin:** `admin@garrison.com` / `admin123`

## How to run the SUT

From the repository root:

```bash
cp -n .env.example .env   # leave reCAPTCHA keys empty for local runs
docker compose up --build
```

- Site: http://localhost:8080  
- phpMyAdmin: http://localhost:8081 (root / toor)

> If containers cannot reach each other on your machine, see [docker/README.md](docker/README.md) for a host-network workaround used during this portfolio’s exploration.

## How to run Playwright smoke tests

```bash
cd qa-portfolio/automation
npm install
npx playwright install chromium
npm test
```

Requires the SUT at `http://localhost:8080` (override with `BASE_URL`).

## Skills demonstrated

- Test planning and risk-based scope
- Manual test case design (positive / negative / boundary)
- Bug reporting with severity, steps, expected vs actual
- Smoke vs regression checklists
- Light UI automation with Playwright + TypeScript
- Exploring auth, authorization, CRUD, and AJAX search

## CV blurb

> Junior QA portfolio for The Garrison (PHP/MySQL restaurant app): test plan, 35 manual test cases, defect reports from exploratory testing, smoke/regression checklists, and Playwright TypeScript smoke automation.
