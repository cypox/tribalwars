#!/bin/bash
set -e

export DB_PASSWORD="${DB_PASSWORD:-123}"
export DB_NAME_MAIN="${DB_NAME_MAIN:-tribalwars_main}"
export DB_NAME_WORLD="${DB_NAME_WORLD:-tribalwars_world}"

mkdir -p /var/run/mysqld
chown -R mysql:mysql /var/run/mysqld /var/lib/mysql

if [ ! -d /var/lib/mysql/mysql ]; then
  mysqld --initialize-insecure --user=mysql
fi

mysqld_safe --user=mysql &

for i in $(seq 1 60); do
  if mysqladmin ping --silent >/dev/null 2>&1 || mysqladmin -uroot -p"$DB_PASSWORD" ping --silent >/dev/null 2>&1; then
    break
  fi
  sleep 1
done

mysql_exec() {
  if mysql -uroot -e "SELECT 1" >/dev/null 2>&1; then
    mysql -uroot "$@"
  else
    mysql -uroot -p"$DB_PASSWORD" "$@"
  fi
}

mysql_exec <<SQL
ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY '$DB_PASSWORD';
CREATE DATABASE IF NOT EXISTS \
  \`$DB_NAME_MAIN\` CHARACTER SET utf8 COLLATE utf8_unicode_ci;
CREATE DATABASE IF NOT EXISTS \
  \`$DB_NAME_WORLD\` CHARACTER SET utf8 COLLATE utf8_unicode_ci;
FLUSH PRIVILEGES;
SQL

main_tables=$(mysql -N -uroot -p"$DB_PASSWORD" -e "SELECT COUNT(*) FROM information_schema.tables WHERE table_schema='$DB_NAME_MAIN';")
world_tables=$(mysql -N -uroot -p"$DB_PASSWORD" -e "SELECT COUNT(*) FROM information_schema.tables WHERE table_schema='$DB_NAME_WORLD';")

if [ "$main_tables" = "0" ] && [ -f /opt/bootstrap/tribalwars_main.sql ]; then
  mysql -uroot -p"$DB_PASSWORD" "$DB_NAME_MAIN" < /opt/bootstrap/tribalwars_main.sql
fi

if [ "$world_tables" = "0" ] && [ -f /opt/bootstrap/tribalwars_world.sql ]; then
  mysql -uroot -p"$DB_PASSWORD" "$DB_NAME_WORLD" < /opt/bootstrap/tribalwars_world.sql
fi

for d in \
  /var/www/html/tribalwars/templates_c \
  /var/www/html/tribalwars/lang \
  /var/www/html/tribalwars/wereld1/templates_c \
  /var/www/html/tribalwars/wereld1/lang \
  /var/www/html/tribalwars/zapping_support/files \
  /var/www/html/tribalwars/zapping_support/uploads
 do
  if [ -d "$d" ]; then
    chmod -R 0777 "$d" || true
  fi
done

if [ -f /var/www/html/tribalwars/wereld1/daemons/event.php ]; then
  (
    while true; do
      php /var/www/html/tribalwars/wereld1/daemons/event.php >> /var/log/tribalwars-events.log 2>&1 || true
    done
  ) &
fi

exec apachectl -D FOREGROUND
