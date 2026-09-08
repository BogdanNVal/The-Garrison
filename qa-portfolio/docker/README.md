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
