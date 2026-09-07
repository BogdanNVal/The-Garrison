# Test cases — Reservations

SUT: The Garrison · Module: RESERVATIONS

| ID | Title | Preconditions | Steps | Expected | Priority | Type |
|----|-------|---------------|-------|----------|----------|------|
| RES-01 | Create reservation happy path | Customer logged in; tables free | Party size 2; future date; submit | Success redirect to home; row in `rezervari` | High | Positive |
| RES-02 | Reject party size 0 or empty | Customer on form | nr_persoane ≤ 0 | “Alegeti un numar de persoane” | High | Negative |
| RES-03 | Reject party size above 6 | Customer on form | nr_persoane = 7 | “Numarul maxim de persoane este 6” | High | Boundary |
| RES-04 | Accept party size 6 | Customer; table for 6 free | nr_persoane = 6; future date | Reservation created | Med | Boundary |
| RES-05 | Reject empty date | Customer on form | Leave date empty | “Alegeti o data” | High | Negative |
| RES-06 | Reject past dates | Customer on form | Date = yesterday or `2020-01-01` | Validation error; **no DB insert** | High | Negative |
| RES-07 | Reject today’s date in the past hours / past calendar day | Customer | Use past calendar date | Not accepted | Med | Boundary |
| RES-08 | When all suitable tables booked | Book all tables that fit size for a date | Another booking same size/date | Clear “no free tables” style error | High | Negative |
| RES-09 | Assigns table with capacity ≥ party size | Customer | Book 3 people | Assigned `mese.nr_persoane` ≥ 3 | Med | Positive |
| RES-10 | Reservation stores logged-in user name | Customer named “QA Tester” | Book successfully | `rezervari.nume` = session name | Med | Positive |
| RES-11 | Guest redirected from reservation page | Logged out | GET `/rezervare.php` | Redirect to login | High | Negative |
| RES-12 | Admin does not use customer reservation form as primary flow | Admin logged in | Note product behavior | Admin redirected/handled per app rules; document actual | Low | UX |
