# Test plan — The Garrison

| | |
|--|--|
| App | The Garrison (restaurant site) |
| Build | Local Docker |
| Base URL | http://localhost:8080 |
| Tester | Bogdan |

## Goal

Check the main flows work: signup/login, admin menu CRUD, reservations, admin reservation search. Log anything broken I hit along the way.

## In scope

- Customer signup / login / logout / remember me
- Admin login and admin panel access
- Customer vs admin access (who can open what)
- Add / update / delete menu items, categories, image upload (jpg/png/jpeg)
- Reservation validation and table assignment
- Admin live search (AJAX)
- Basic checks that guests can’t open protected pages

## Out of scope

- Load / performance
- Full security audit (I still logged obvious auth holes)
- Full browser matrix (automation is Chromium only)
- Pixel-perfect UI polish (assets were restored on this branch; still logged leftover demo menu content as BUG-010)
- Payments / emails (not in the app)

## How I tested

- Manual cases in `test-cases/`
- Exploratory passes → `bug-reports/`
- Smoke checklist + Playwright for a quick green/red signal
- Regression checklist after bigger changes

## Test data

| Role | Account | Notes |
|------|---------|-------|
| Admin | `admin@garrison.com` / `admin123` | Created automatically if admins table is empty |
| Customer | Sign up a new one each run | e.g. `qa.tester@example.com` / `test123` |
| Tables | 2, 2, 4, 4, 6 seats | From `db-init/schema.sql` |

Keep reCAPTCHA keys empty in `.env` locally, or login will fail the captcha check.

## Entry / exit

**Start when:** containers are up, login page loads, DB is there.

**Done when:** plan + cases are written, bugs are filed, checklists exist, and `npm test` passes against local.

## Risks I watched

| Risk | Why it matters | What I did |
|------|----------------|------------|
| Repo was missing some UI includes / assets | Hard to even open pages | Logged as BUG-008; components + front-end assets restored on this branch |
| Docker DB connection issues on some setups | Can’t test anything | Documented workaround under `docker/` |
| Upload folder not writable in Docker | Admin “add dish” looks broken / smoke fails | Logged as BUG-009; chmod note in `docker/README.md` |
| Same remember-me cookie for admin and user | Wrong role after reopen | Covered in auth cases |
| Default admin password | Bad if env is shared | Noted in README; change it if you deploy |
| Template demo dishes left in public menu | README claim vs real UI | Logged as BUG-010 (MENU-15) |

## Tools

Browser, curl for a few direct POSTs, Playwright, phpMyAdmin / mysql CLI when I needed to confirm DB rows.
