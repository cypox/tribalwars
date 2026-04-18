# Tribal Wars Docker

This repo includes a **single-container** Docker setup with:

- Apache
- PHP 8.3
- MySQL 8.0
- the game source
- the bundled SQL dumps

## Run

```bash
docker-compose up --build -d
```

Open:

- http://localhost:8080
- http://localhost:8080/wereld1

## Stop

```bash
docker-compose down
```

## Reset DB and re-import dumps

```bash
docker-compose down -v
docker-compose up --build -d
```

## Inspect

```bash
docker-compose ps
docker-compose logs -f
docker-compose exec app bash
docker-compose exec app mysql -uroot -p123
```

## Refresh the SQL dumps from your live WSL MySQL

```bash
mysqldump -uroot -p123 --skip-lock-tables --default-character-set=utf8mb4 --routines --triggers --set-gtid-purged=OFF tribalwars_main > tribalwars_main.sql
mysqldump -uroot -p123 --skip-lock-tables --default-character-set=utf8mb4 --routines --triggers --set-gtid-purged=OFF tribalwars_world > tribalwars_world.sql
```
