# Tribal Wars Docker Setup

This workspace uses a **single Docker container** for the LAN game server.

It includes:

- Apache
- PHP 8.3
- MySQL 8.0
- the Tribal Wars webapp
- the database snapshot files used for redeploys

---

## Repo layout

- [tribalwars](tribalwars) → PHP webapp
- [database](database) → current SQL snapshots for redeploy
- [docker](docker) → container startup/config files
- [Dockerfile](Dockerfile), [docker-compose.yml](docker-compose.yml), [README.md](README.md) → root tooling

---

## 1. Start the LAN server

```bash
docker-compose up --build -d
```

Open in browser:

- http://localhost:8080
- http://localhost:8080/wereld1

If you want other PCs on your LAN to connect, use your machine IP:

```bash
hostname -I
```

Then open:

```text
http://YOUR_LAN_IP:8080
```

---

## 2. Stop the server

```bash
docker-compose down
```

---

## 3. Reset and redeploy from the saved database snapshot

This is the command to fully recreate the LAN server from the SQL files in [database](database).

```bash
docker-compose down -v
docker-compose up --build -d
```

---

## 4. Inspect the running server

Check status:

```bash
docker-compose ps
```

Follow logs:

```bash
docker-compose logs -f
docker-compose logs -f app
```

Open a shell in the container:

```bash
docker-compose exec app bash
```

Open MySQL inside the same container:

```bash
docker-compose exec app mysql -uroot -p123
```

Inspect imported DBs:

```bash
docker-compose exec app mysql -uroot -p123 -e "SHOW DATABASES;"
docker-compose exec app mysql -uroot -p123 -e "USE tribalwars_main; SHOW TABLES;"
docker-compose exec app mysql -uroot -p123 -e "USE tribalwars_world; SHOW TABLES;"
```

---

## 5. Re-dump the CURRENT Docker database into the database folder

Use this after you have modified the running game and want to save a new redeployable snapshot.

```bash
docker-compose exec -T app sh -lc 'mysqldump -uroot -p"$DB_PASSWORD" --skip-lock-tables --default-character-set=utf8mb4 --routines --triggers --set-gtid-purged=OFF "$DB_NAME_MAIN"' > database/tribalwars_main.sql

docker-compose exec -T app sh -lc 'mysqldump -uroot -p"$DB_PASSWORD" --skip-lock-tables --default-character-set=utf8mb4 --routines --triggers --set-gtid-purged=OFF "$DB_NAME_WORLD"' > database/tribalwars_world.sql
```

This saves the **live Docker state** into the snapshot files used for future redeploys.

---

## 6. Typical workflow for a LAN game

### Initial deploy

```bash
docker-compose up --build -d
```

### Play / configure / modify the server
- edit PHP files in [tribalwars](tribalwars)
- changes apply on next container rebuild or restart

### Save the current running world as a fresh backup snapshot

```bash
docker-compose exec -T app sh -lc 'mysqldump -uroot -p"$DB_PASSWORD" --skip-lock-tables --default-character-set=utf8mb4 --routines --triggers --set-gtid-purged=OFF "$DB_NAME_MAIN"' > database/tribalwars_main.sql

docker-compose exec -T app sh -lc 'mysqldump -uroot -p"$DB_PASSWORD" --skip-lock-tables --default-character-set=utf8mb4 --routines --triggers --set-gtid-purged=OFF "$DB_NAME_WORLD"' > database/tribalwars_world.sql
```

### Redeploy later from that saved state

```bash
docker-compose down -v
docker-compose up --build -d
```

---

## 7. Create a full backup copy of the deployment files

If you want an extra copy after changes, archive the webapp + database snapshot + docker files:

```bash
tar -czf tribalwars-lan-backup.tar.gz tribalwars database docker Dockerfile docker-compose.yml README.md
```

Restore later by extracting and running:

```bash
docker-compose down -v
docker-compose up --build -d
```

---

## 8. Useful checks

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

---

## Default credentials

- MySQL host inside the container: `127.0.0.1`
- MySQL user: `root`
- MySQL password: `123`
- Main DB: `tribalwars_main`
- World DB: `tribalwars_world`
