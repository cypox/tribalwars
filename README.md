# Tribal Wars Docker Setup

This workspace now uses a **single Docker image / single container** that includes:

- Apache web server
- PHP 8.3
- MySQL 8.0
- the game code
- the imported SQL snapshot files

## Start the server

```bash
docker-compose up --build -d
```

Open:

- http://localhost:8080
- http://localhost:8080/wereld1

## Stop the server

```bash
docker-compose down
```

## Reset and re-import the databases

```bash
docker-compose down -v
docker-compose up --build -d
```

## Check container status

```bash
docker-compose ps
```

## View logs

```bash
docker-compose logs -f
docker-compose logs -f app
```

## Open a shell inside the single container

```bash
docker-compose exec app bash
```

## Open MySQL inside the same container

```bash
docker-compose exec app mysql -uroot -p123
```

## Inspect the imported databases

```bash
docker-compose exec app mysql -uroot -p123 -e "SHOW DATABASES;"
docker-compose exec app mysql -uroot -p123 -e "USE tribalwars_main; SHOW TABLES;"
docker-compose exec app mysql -uroot -p123 -e "USE tribalwars_world; SHOW TABLES;"
```

## Repo layout

- tribalwars → the PHP webapp
- database → the current SQL snapshots
- docker → Apache/MySQL startup files
- Dockerfile, README.md, docker-compose.yml → root tooling

## Re-dump your live WSL databases into the database folder

```bash
mysqldump -uroot -p123 --skip-lock-tables --default-character-set=utf8mb4 --routines --triggers --set-gtid-purged=OFF tribalwars_main > database/tribalwars_main.sql
mysqldump -uroot -p123 --skip-lock-tables --default-character-set=utf8mb4 --routines --triggers --set-gtid-purged=OFF tribalwars_world > database/tribalwars_world.sql
```

Then reload the container:

```bash
docker-compose down -v
docker-compose up --build -d
```

## Useful checks

Homepage headers:

```bash
curl -I http://localhost:8080/
```

In-game page check:

```bash
curl -I http://localhost:8080/wereld1/game.php
```

Current running containers:

```bash
docker ps
```

Clean unused Docker images:

```bash
docker image prune -af
docker builder prune -af
```

## Default credentials

- MySQL host inside the container: `127.0.0.1`
- MySQL user: `root`
- MySQL password: `123`
- Main DB: `tribalwars_main`
- World DB: `tribalwars_world`
- MySQL is accessed from the host via `docker-compose exec app mysql ...` and is not published on a host port by default.
