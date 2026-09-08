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
| 8 | Signup name escaped on validation fail | AUTH-19, BUG-004 | ☐ | ☐ |

## Menu admin

| # | Check | Cases | Pass | Fail |
|---|-------|-------|------|------|
| 9 | Add valid item in a category | MENU-02, MENU-09 | ☐ | ☐ |
| 10 | Required fields + image type | MENU-03–06 | ☐ | ☐ |
| 11 | Price 0 / negative blocked | MENU-07–08, BUG-003 | ☐ | ☐ |
| 12 | Update works (with/without new image) | MENU-10–11 | ☐ | ☐ |
| 13 | Delete confirm + item gone | MENU-12–13, BUG-005 | ☐ | ☐ |
| 14 | Guest can’t add/update/delete | MENU-14 | ☐ | ☐ |
| 15 | Add form re-display escapes HTML | MENU-17, BUG-009 | ☐ | ☐ |

## Reservations

| # | Check | Cases | Pass | Fail |
|---|-------|-------|------|------|
| 16 | Happy path, name stored | RES-01, RES-10 | ☐ | ☐ |
| 17 | Party size 0 / 7 / 6 | RES-02–04 | ☐ | ☐ |
| 18 | Empty date blocked | RES-05 | ☐ | ☐ |
| 19 | Past dates blocked | RES-06, BUG-001 | ☐ | ☐ |
| 20 | Message when no table left | RES-08 | ☐ | ☐ |

## Search

| # | Check | Cases | Pass | Fail |
|---|-------|-------|------|------|
| 21 | Live search: hit, miss, clear | SRCH-02–04 | ☐ | ☐ |
| 22 | Guest blocked from search page | SRCH-06 | ☐ | ☐ |
| 23 | livesearch.php without login | SRCH-07, BUG-002 | ☐ | ☐ |
| 24 | Spelling on “rezervari” button | SRCH-09, BUG-006 | ☐ | ☐ |
| 25 | Spelling on “persoane” column | SRCH-10, BUG-010 | ☐ | ☐ |

## Other

| # | Check | Ref | Pass | Fail |
|---|-------|-----|------|------|
| 26 | Add form shows backend errors | BUG-007 | ☐ | ☐ |
| 27 | Fresh clone runs without missing includes | BUG-008 | ☐ | ☐ |

Signed: _____________  Date: _____________
