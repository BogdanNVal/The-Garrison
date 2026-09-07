# Smoke checklist — The Garrison

Run after every deploy / before demos. Target: ~10 minutes.

Environment: _________________ Build/commit: _________________

| # | Check | Pass | Fail | Notes |
|---|-------|------|------|-------|
| 1 | Home / login page loads (HTTP 200) | ☐ | ☐ | |
| 2 | Sign up new customer | ☐ | ☐ | |
| 3 | Log in as customer → lands on home | ☐ | ☐ | |
| 4 | Customer can open reservation form | ☐ | ☐ | |
| 5 | Create reservation (future date, size 2–6) | ☐ | ☐ | |
| 6 | Log out → reservation URL redirects to login | ☐ | ☐ | |
| 7 | Log in as admin → `/secure.php` | ☐ | ☐ | |
| 8 | Add menu item (valid price + image) | ☐ | ☐ | |
| 9 | Admin search page loads | ☐ | ☐ | |
| 10 | Playwright smoke suite green (`npm test`) | ☐ | ☐ | |

**Sign-off:** _________________ Date: _________
