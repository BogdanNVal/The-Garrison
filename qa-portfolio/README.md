# The Garrison — QA notes

I tested [The Garrison](https://github.com/BogdanNVal/The-Garrison), a small restaurant web app (PHP + MySQL): customer accounts, table reservations, admin menu management, and live search for reservations.

This folder is what I produced while testing it — plan, cases, bugs I found, checklists, and a short Playwright smoke pack.

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
- Stack: PHP 8.2, MySQL, Docker Compose
- Default admin: `admin@garrison.com` / `admin123`

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
