# Docker notes

Normal run from repo root:

```bash
docker compose up --build
```

PHP connects to MySQL as host `mysql_db` (or whatever you set in `DB_HOST`).

## If containers can’t talk to MySQL

On one setup the bridge network timed out on port 3306. What worked:

1. MySQL on the host: `127.0.0.1:3306`
2. PHP/Apache on host network, port 8080, `DB_HOST=127.0.0.1`

`ports.conf` and `000-default.conf` in this folder are for that Apache-on-8080 setup.

You probably won’t need this if `docker compose` works normally on your PC.

## If admin can’t add a menu image

On a host-mounted `src/` volume, `src/assets/img/menu/` may be owned by your user and not writable by Apache (`www-data`). Then Add product with a valid image stays on `add.php` with no useful UI error (BUG-009).

Quick local workaround:

```bash
chmod 777 src/assets/img/menu
```

Better long-term: set ownership/permissions in Docker so the web user can write that folder, and show a clear error when `move_uploaded_file()` fails (also tied to BUG-007).

