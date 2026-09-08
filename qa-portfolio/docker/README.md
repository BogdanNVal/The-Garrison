# Docker notes

Normal run from repo root:

```bash
docker compose up --build
```

PHP connects to MySQL as host `mysql_db` (or whatever you set in `DB_HOST`).

## If containers can’t talk to MySQL

On some setups the Compose bridge network times out on port 3306 (DNS resolves, TCP never connects). What worked:

1. MySQL on the host: `127.0.0.1:3306`, database `test`, user `root` / `toor`
2. Import `db-init/schema.sql`
3. PHP from `src/` with:

```bash
cd src
DB_HOST=127.0.0.1 DB_USER=root DB_PASSWORD=toor DB_NAME=test \
  php -S 127.0.0.1:8080
```

`ports.conf` and `000-default.conf` in this folder are for an Apache-on-8080 host-network setup if you prefer that over the PHP built-in server.

You probably won’t need this if `docker compose` works normally on your PC.
