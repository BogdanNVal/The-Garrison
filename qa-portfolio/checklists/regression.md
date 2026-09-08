# Regression checklist

Use after fixes or bigger changes. Case IDs are in `test-cases/`.

## Auth

| # | Check | Cases | Pass | Fail |
|---|-------|-------|------|------|
| 1 | Signup validation (empty fields, bad email, short pwd, mismatch) | AUTH-02–06 | ☐ | ☐ |
| 2 | Duplicate email blocked | AUTH-04 | ☐ | ☐ |
| 3 | Customer / admin land on the right page after login | AUTH-08–09 | ☐ | ☐ |
| 4 | Wrong password / unknown email messages | AUTH-11–12 | ☐ | ☐ |
| 5 | Customer can’t open admin panel | AUTH-13 | ☐ | ☐ |
| 6 | Logout actually logs you out | AUTH-15 | ☐ | ☐ |
| 7 | Remember me (customer) | AUTH-16 | ☐ | ☐ |

## Menu admin

| # | Check | Cases | Pass | Fail |
|---|-------|-------|------|------|
| 8 | Add valid item in a category | MENU-02, MENU-09 | ☐ | ☐ |
| 9 | Required fields + image type | MENU-03–06 | ☐ | ☐ |
| 10 | Price 0 / negative blocked | MENU-07–08, BUG-003 | ☐ | ☐ |
| 11 | Update works (with/without new image) | MENU-10–11 | ☐ | ☐ |
| 12 | Delete confirm + item gone | MENU-12–13, BUG-005 | ☐ | ☐ |
| 13 | Guest can’t add/update/delete | MENU-14 | ☐ | ☐ |
| 14 | Public menu has no hard-coded demo dishes | MENU-15, BUG-010 | ☐ | ☐ |

## Reservations

| # | Check | Cases | Pass | Fail |
|---|-------|-------|------|------|
| 15 | Happy path, name stored | RES-01, RES-10 | ☐ | ☐ |
| 16 | Party size 0 / 7 / 6 | RES-02–04 | ☐ | ☐ |
| 17 | Empty date blocked | RES-05 | ☐ | ☐ |
| 18 | Past dates blocked | RES-06, BUG-001 | ☐ | ☐ |
| 19 | Message when no table left | RES-08 | ☐ | ☐ |

## Search

| # | Check | Cases | Pass | Fail |
|---|-------|-------|------|------|
| 20 | Live search: hit, miss, clear | SRCH-02–04 | ☐ | ☐ |
| 21 | Guest blocked from search page | SRCH-06 | ☐ | ☐ |
| 22 | livesearch.php without login | SRCH-07, BUG-002 | ☐ | ☐ |
| 23 | Spelling on “rezervari” button | SRCH-09, BUG-006 | ☐ | ☐ |

## Other

| # | Check | Ref | Pass | Fail |
|---|-------|-----|------|------|
| 24 | Signup name not injectable | BUG-004 | ☐ | ☐ |
| 25 | Add form shows backend errors | BUG-007 | ☐ | ☐ |
| 26 | Fresh clone runs without missing includes / assets | BUG-008 | ☐ | ☐ |
| 27 | Menu upload works in Docker (writable `assets/img/menu`) | BUG-009, MENU-17 | ☐ | ☐ |

Signed: _____________  Date: _____________
