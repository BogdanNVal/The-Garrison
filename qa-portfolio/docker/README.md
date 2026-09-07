# Local Docker notes (QA exploration)

Normal path for most machines:

```bash
# repo root
docker compose up --build
```

PHP talks to MySQL via hostname `mysql_db` (`DB_HOST` env, default in `src/dbconnection.php`).

## Workaround used in this Cloud Agent environment

Bridge networking between Compose containers timed out on TCP/3306. Exploration used:

1. MySQL published on host `127.0.0.1:3306`
2. PHP/Apache with `--network host`, Apache on port **8080**, `DB_HOST=127.0.0.1`

Helper configs in this folder (`ports.conf`, `000-default.conf`) bind Apache to 8080 under host networking.

You should not need this if `docker compose` networking works on your laptop.
