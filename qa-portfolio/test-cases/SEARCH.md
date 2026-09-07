# Test cases — Admin reservation search

SUT: The Garrison · Module: SEARCH

| ID | Title | Preconditions | Steps | Expected | Priority | Type |
|----|-------|---------------|-------|----------|----------|------|
| SRCH-01 | Admin opens search page | Admin logged in | Open `/search.php` | Search input visible | High | Positive |
| SRCH-02 | Live search returns matching names | Reservations exist; admin on search | Type prefix of reservation name | Results table with matching rows | High | Positive |
| SRCH-03 | Live search no matches | Admin on search | Type unmatched string | “NO DATA FOUND” (or equivalent) | Med | Negative |
| SRCH-04 | Clearing input clears results | Results showing | Clear search box | Results area empty | Med | Positive |
| SRCH-05 | Search is prefix-based (LIKE 'input%') | Names `Ana`, `Anca` | Type `An` | Both match; `Dana` does not | Med | Boundary |
| SRCH-06 | Guest cannot use search UI | Logged out | GET `/search.php` | Redirect away from admin search | High | Negative |
| SRCH-07 | `livesearch.php` requires authentication | Logged out | POST `input=a` to `/livesearch.php` | **401/redirect/empty — must not return reservation PII** | High | Negative |
| SRCH-08 | Results columns readable | Admin; matches exist | Inspect table | Id, name, party size, date, table id shown | Low | Positive |
| SRCH-09 | UI label spelling | Admin pages | Read “Verifica rezevari” control | Correct Romanian spelling “rezervari” | Low | UX |
