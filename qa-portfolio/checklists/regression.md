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

## Reservations

| # | Check | Cases | Pass | Fail |
|---|-------|-------|------|------|
| 14 | Happy path, name stored | RES-01, RES-10 | ☐ | ☐ |
| 15 | Party size 0 / 7 / 6 | RES-02–04 | ☐ | ☐ |
| 16 | Empty date blocked | RES-05 | ☐ | ☐ |
| 17 | Past dates blocked | RES-06, BUG-001 | ☐ | ☐ |
| 18 | Message when no table left | RES-08 | ☐ | ☐ |

## Search

| # | Check | Cases | Pass | Fail |
|---|-------|-------|------|------|
| 19 | Live search: hit, miss, clear | SRCH-02–04 | ☐ | ☐ |
| 20 | Guest blocked from search page | SRCH-06 | ☐ | ☐ |
| 21 | livesearch.php without login | SRCH-07, BUG-002 | ☐ | ☐ |
| 22 | Spelling on “rezervari” button | SRCH-09, BUG-006 | ☐ | ☐ |

## Other

| # | Check | Ref | Pass | Fail |
|---|-------|-----|------|------|
| 23 | Signup name not injectable | BUG-004 | ☐ | ☐ |
| 24 | Add form shows backend errors | BUG-007 | ☐ | ☐ |
| 25 | Fresh clone runs without missing includes | BUG-008 | ☐ | ☐ |

Signed: _____________  Date: _____________
