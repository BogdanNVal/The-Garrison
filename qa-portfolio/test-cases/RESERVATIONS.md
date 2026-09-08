# Reservations

App: The Garrison (current main)

| ID | Title | Preconditions | Steps | Expected | Priority | Type |
|----|-------|---------------|-------|----------|----------|------|
| RES-01 | Create reservation happy path | Customer logged in; tables free | Party size 2; future date; submit | Success redirect to home; row in `rezervari` | High | Positive |
| RES-02 | Reject party size 0 or empty | Customer on form | nr_persoane ≤ 0 | “Alegeti un numar de persoane” | High | Negative |
| RES-03 | Reject party size above 6 | Customer on form | nr_persoane = 7 | “Numarul maxim de persoane este 6” | High | Boundary |
| RES-04 | Accept party size 6 | Customer; table for 6 free | nr_persoane = 6; future date | Reservation created | Med | Boundary |
| RES-05 | Reject empty date | Customer on form | Leave date empty | “Alegeti o data” | High | Negative |
| RES-06 | Reject past dates | Customer on form | Date = yesterday or `2020-01-01` | Validation error; **no DB insert** | High | Negative |
| RES-07 | Past calendar date blocked | Customer | Pick a date before today | Error, not saved; date input has `min=today` | Med | Boundary |
| RES-08 | No free table left | All tables that fit the party are booked for that date | Try another booking same size/date | Clear error that nothing is free | High | Negative |
| RES-09 | Picks a table big enough | Customer | Book for 3 people | Assigned table seats ≥ 3 | Med | Positive |
| RES-10 | Saves the logged-in name | Customer named “QA Tester” | Book successfully | Reservation name is QA Tester | Med | Positive |
| RES-11 | Guest sent to login | Logged out | Open /rezervare.php | Redirect to login | High | Negative |
| RES-12 | What happens if admin opens reservation page | Admin logged in | Open /rezervare.php | Clear behavior (form or message) — not silent bounce to admin | Low | UX |
| RES-13 | Reject non-integer party size | Customer | POST `nr_persoane=2.5` or `2abc` with future date | Validation error; **no DB insert** | High | Negative |
| RES-14 | Concurrent bookings same table/date | Two customers; one free fitting table | Parallel POSTs same date/size | At most one row per `(id_masa, data_rezervare)` | Med | Negative |
