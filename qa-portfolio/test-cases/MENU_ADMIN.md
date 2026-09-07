# Test cases — Menu administration

SUT: The Garrison · Module: MENU_ADMIN

| ID | Title | Preconditions | Steps | Expected | Priority | Type |
|----|-------|---------------|-------|----------|----------|------|
| MENU-01 | Admin sees empty category message | Admin logged in; category has no items | Open `/secure.php`, select category | Message that no products exist yet | Med | Positive |
| MENU-02 | Add product with valid data | Admin logged in | `/add.php` — name, price > 0, description, category, jpg/png | Redirect to admin menu; item listed under category | High | Positive |
| MENU-03 | Add product requires name | Admin on add form | Leave name empty | “Adauga nume”; item not created | High | Negative |
| MENU-04 | Add product requires description | Admin on add form | Leave description empty | “Adauga Descriere”; item not created | High | Negative |
| MENU-05 | Add product requires image | Admin on add form | Omit file | “Adauga Imagine”; item not created | High | Negative |
| MENU-06 | Reject unsupported image extension | Admin on add form | Upload `.gif` or `.txt` | “Format incorect”; item not created | Med | Negative |
| MENU-07 | Reject zero price | Admin on add form | Price `0`, other fields valid | Validation error; **item must not be saved** | High | Boundary |
| MENU-08 | Reject negative price | Admin on add form | Price `-5`, other fields valid | Validation error; **item must not be saved** | High | Boundary |
| MENU-09 | Category preselected from query | Admin | Open `add.php?categorie=dinner` | Dinner selected in dropdown | Low | Positive |
| MENU-10 | Update product fields | Admin; product exists | Update name/price/description | Changes visible on admin menu | High | Positive |
| MENU-11 | Update keeps image if none uploaded | Admin; product exists | Submit update without new file | Existing image path retained | Med | Positive |
| MENU-12 | Delete confirmation page | Admin; product exists | Click Delete | Confirmation page shown | High | Positive |
| MENU-13 | Delete removes product | Admin on delete confirm | Submit confirm | Product gone from menu/DB | High | Positive |
| MENU-14 | Guest cannot add products | Logged out | Open `/add.php` | Redirect to public home/index | High | Negative |
| MENU-15 | Public menu shows only admin-added items | Products in DB | Open public menu section | Only real products; no hard-coded demo dishes | Med | Positive |
| MENU-16 | Admin error messages on add failure | Force DB/class error if possible | Submit add | User-visible error (not silent fail) | Med | Negative |
