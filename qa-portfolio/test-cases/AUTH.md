# Auth & roles

App: The Garrison

| ID | Title | Preconditions | Steps | Expected | Priority | Type |
|----|-------|---------------|-------|----------|----------|------|
| AUTH-01 | Customer signup with valid data | Not logged in; email unused | 1. Open `/signup.php` 2. Enter name, valid email, password ≥6, matching confirm 3. Submit | Success message; user can log in | High | Positive |
| AUTH-02 | Signup rejects empty name | On signup page | Submit with empty name | “Name is mandatory”; no account created | High | Negative |
| AUTH-03 | Signup rejects invalid email format | On signup page | Enter `not-an-email`, valid other fields | “Invalid Email format” | High | Negative |
| AUTH-04 | Signup rejects duplicate email | User already registered | Sign up again with same email | “Email already registered” | High | Negative |
| AUTH-05 | Signup rejects short password | On signup page | Password length 5 | “Password must be atleast 6 characters” | Med | Boundary |
| AUTH-06 | Signup rejects mismatched passwords | On signup page | pwd ≠ conf_pwd | “Passwords do not match” | High | Negative |
| AUTH-07 | Show password toggles fields | On signup page | Check “Show Password” | Password fields become visible text | Low | Positive |
| AUTH-08 | Customer login success | Valid customer exists | Login with customer email/password | Redirect to `index.php`; session established | High | Positive |
| AUTH-09 | Admin login success | Default admin seeded | Login `admin@garrison.com` / `admin123` | Redirect to `secure.php` | High | Positive |
| AUTH-10 | Login empty fields | On login page | Submit empty email and password | Field errors: email/password mandatory | High | Negative |
| AUTH-11 | Login wrong password | Known account | Correct email, wrong password | “Incorrect Password” | High | Negative |
| AUTH-12 | Login unknown email | On login page | Unregistered email | “Email id not registered” | Med | Negative |
| AUTH-13 | Customer cannot open admin panel | Logged in as customer | Open `/secure.php` | Redirect away (not admin UI) | High | Negative |
| AUTH-14 | Guest cannot open reservation page | Logged out | Open `/rezervare.php` | Redirect to `login.php` | High | Negative |
| AUTH-15 | Logout clears session | Logged in | Open `/logout.php` | Redirect to login; protected pages require login again | High | Positive |
| AUTH-16 | Remember me (customer) | Valid customer | Login with Remember Me; close browser; open site again | Still logged in as that customer | Med | Positive |
| AUTH-17 | Admin wins if email exists in both tables | Same email in admins and users (if you can set that up) | Log in with that email | Goes to admin panel | Low | Boundary |
| AUTH-18 | Failed login keeps the email filled in | On login page | Fail login with a typed email | Email still in the field (easier to retry) | Low | UX |
