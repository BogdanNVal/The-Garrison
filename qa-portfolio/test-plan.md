# Test plan — The Garrison

| | |
|--|--|
| App | The Garrison (restaurant site) |
| Build | Current `main` (Yummy UI + project fixes) |
| Base URL | http://localhost:8080 |
| Tester | Bogdan |

## Goal

Check the main flows work on the current main build: signup/login, admin menu CRUD, reservations, admin reservation search. Re-verify bugs that were open on an older build, and log anything still broken.

## In scope

- Customer signup / login / logout / remember me
- Admin login and admin panel access
- Customer vs admin access (who can open what)
- Add / update / delete menu items, categories, image upload (jpg/png/jpeg)
- Reservation validation and table assignment
- Admin live search (AJAX)
- Basic checks that guests can’t open protected pages
- Regression of previously reported issues (past dates, livesearch auth, price validation, signup XSS, delete session, typo, missing components)

## Out of scope

- Load / performance
- Full security audit (I still logged obvious auth / XSS holes)
- Full browser matrix (automation is Chromium only)
- Pixel-perfect UI polish
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
| Seed menu | 3 starters | From `db-init/schema.sql` on first MySQL start |

Keep reCAPTCHA keys empty in `.env` locally, or login will fail the captcha check.

## Entry / exit

**Start when:** app is up (Compose or local PHP), login page loads, DB is there.

**Done when:** plan + cases are written, bugs are filed (open + verified-fixed), checklists exist, and `npm test` passes against local.

## Risks I watched

| Risk | Why it matters | What I did |
|------|----------------|------------|
| Older clones were missing UI includes | Hard to even open pages | Confirmed `src/components/` + assets are on current main (BUG-008 fixed) |
| Docker DB connection issues on some setups | Can’t test anything | Documented workaround under `docker/` |
| Same remember-me cookie for admin and user | Wrong role after reopen | Covered in auth cases; filed BUG-015 |
| Default admin password | Bad if env is shared | Noted in README; change it if you deploy |
| Fixes on main may regress | Old bugs coming back | Retested BUG-001…008 against this build |
| Upload / price edge cases | Bad data in menu | Second pass → BUG-011…014 |
| Reservation concurrency | Double-book same table/date | Tried parallel POSTs; **not reproduced** on this build (no unique constraint still — RES-14) |
| Best-fit table assignment | Wasting large tables | Not reproduced on default `mese` PK order |

## Second pass (deeper hunt)

Confirmed open on current main: BUG-009, BUG-010, BUG-011…018.  
Attempted but not filed: reservation race under parallel curl; table “waste” assignment (seed order picks small tables first).

## Tools

Browser, curl for a few direct POSTs, Playwright, phpMyAdmin / mysql CLI when I needed to confirm DB rows.
