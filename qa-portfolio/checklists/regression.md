# Regression checklist — The Garrison

Use after bug fixes or larger changes. Map failures back to `test-cases/` IDs.

## Auth

| # | Check | Case IDs | Pass | Fail |
|---|-------|----------|------|------|
| 1 | Signup validation (empty, email, short pwd, mismatch) | AUTH-02–06 | ☐ | ☐ |
| 2 | Duplicate email rejected | AUTH-04 | ☐ | ☐ |
| 3 | Customer vs admin login redirects | AUTH-08–09 | ☐ | ☐ |
| 4 | Wrong password / unknown email messages | AUTH-11–12 | ☐ | ☐ |
| 5 | Role separation (customer ↛ admin) | AUTH-13 | ☐ | ☐ |
| 6 | Logout clears access | AUTH-15 | ☐ | ☐ |
| 7 | Remember-me customer path | AUTH-16 | ☐ | ☐ |

## Menu admin

| # | Check | Case IDs | Pass | Fail |
|---|-------|----------|------|------|
| 8 | Add valid product per category | MENU-02, MENU-09 | ☐ | ☐ |
| 9 | Required fields + image extension | MENU-03–06 | ☐ | ☐ |
| 10 | Zero/negative price **blocked** | MENU-07–08 / BUG-003 | ☐ | ☐ |
| 11 | Update keeps or replaces image | MENU-10–11 | ☐ | ☐ |
| 12 | Delete confirmation + removal | MENU-12–13 / BUG-005 | ☐ | ☐ |
| 13 | Guest blocked from add/update/delete | MENU-14 | ☐ | ☐ |

## Reservations

| # | Check | Case IDs | Pass | Fail |
|---|-------|----------|------|------|
| 14 | Happy path + name stored | RES-01, RES-10 | ☐ | ☐ |
| 15 | Party size bounds (0, 7, 6) | RES-02–04 | ☐ | ☐ |
| 16 | Empty date rejected | RES-05 | ☐ | ☐ |
| 17 | Past dates **rejected** | RES-06 / BUG-001 | ☐ | ☐ |
| 18 | No free table message | RES-08 | ☐ | ☐ |

## Search

| # | Check | Case IDs | Pass | Fail |
|---|-------|----------|------|------|
| 19 | Admin live search hit / miss / clear | SRCH-02–04 | ☐ | ☐ |
| 20 | Guest blocked from `/search.php` | SRCH-06 | ☐ | ☐ |
| 21 | `livesearch.php` unauthorized | SRCH-07 / BUG-002 | ☐ | ☐ |
| 22 | Label spelling “rezervari” | SRCH-09 / BUG-006 | ☐ | ☐ |

## Security / quality

| # | Check | Bug | Pass | Fail |
|---|-------|-----|------|------|
| 23 | Signup name escaped (no XSS) | BUG-004 | ☐ | ☐ |
| 24 | Add form shows class errors (`$err_msg`) | BUG-007 | ☐ | ☐ |
| 25 | Clone runs without missing includes | BUG-008 | ☐ | ☐ |

**Sign-off:** _________________ Date: _________
