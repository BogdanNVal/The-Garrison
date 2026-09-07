# Test Plan — The Garrison

| Field | Value |
|-------|--------|
| Project | The Garrison — restaurant web application |
| Author | Junior QA portfolio |
| SUT version | Repository `main` / local Docker build |
| Environments | Local Docker Compose (`http://localhost:8080`) |

## 1. Objective

Verify that core user and admin flows work correctly: authentication, menu management, table reservations, and admin reservation search. Produce evidence (cases, bugs, automation) suitable for a junior software tester portfolio.

## 2. In scope

- Customer signup, login, logout, remember-me (customer path)
- Admin login and access to admin panel
- Role separation (customer vs admin)
- Admin menu CRUD (add / update / delete) and categories
- Image upload validation (extension jpg/png/jpeg)
- Reservation form validation and table assignment
- Admin live search of reservations (AJAX)
- Basic authorization on protected pages

## 3. Out of scope

- Performance / load testing
- Full security penetration testing (beyond obvious authz findings)
- Mobile device lab / cross-browser matrix (smoke uses Chromium only)
- Visual polish of third-party template assets
- Payment / email notifications (not implemented)

## 4. Test types

| Type | Approach |
|------|----------|
| Smoke | Checklist + Playwright suite |
| Functional | Manual cases in `test-cases/` |
| Negative / boundary | Party size, prices, dates, empty fields |
| Exploratory | Free exploration → `bug-reports/` |
| Regression | Broader checklist after fixes |

## 5. Test data

| Role | Credentials | Notes |
|------|-------------|-------|
| Admin | `admin@garrison.com` / `admin123` | Seeded when `admins` table is empty |
| Customer | Create via Sign up (e.g. `qa.tester@example.com` / `test123`) | Unique email per run |
| Tables | Seeded: 2, 2, 4, 4, 6 seats | From `db-init/schema.sql` |

reCAPTCHA keys empty in `.env` → verification skipped (documented app behavior).

## 6. Entry / exit criteria

**Entry:** `docker compose up` healthy; home/login reachable; DB schema applied.

**Exit (portfolio):** test plan + ≥30 cases + ≥5 real bugs + smoke/regression checklists + Playwright smoke green against local SUT.

## 7. Risks

| Risk | Impact | Mitigation |
|------|--------|------------|
| Missing frontend template files in repo | UI incomplete | Stubbed minimal components for local QA; logged as defect |
| Docker inter-container networking | Cannot reach MySQL | Host-network / published-port workaround |
| Shared `remember_token` cookie for admin & user | Wrong role restored | Covered in AUTH cases / bug notes |
| Default admin password | Security risk in shared envs | Documented; change after first login |

## 8. Tools

- Manual: browser + curl for API-like POST checks
- Automation: Playwright (TypeScript)
- DB inspection: phpMyAdmin / `mysql` CLI
