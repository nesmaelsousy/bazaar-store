#!/bin/bash
set -e

/usr/local/bin/docker-entrypoint.sh mysqld &
MYSQL_PID=$!

echo "⏳ Waiting for MySQL to be ready..."

until mysql -u root -p"${MYSQL_ROOT_PASSWORD}" -e "SELECT 1" &>/dev/null || \
      mysql -u root --password="" -e "SELECT 1" &>/dev/null; do
  sleep 2
done

echo "✅ MySQL is ready — applying privileges..."

mysql -u root -p"${MYSQL_ROOT_PASSWORD}" -e "CREATE DATABASE IF NOT EXISTS \`${MYSQL_DATABASE}\`; CREATE USER IF NOT EXISTS 'root'@'%' IDENTIFIED BY '${MYSQL_ROOT_PASSWORD}'; GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' WITH GRANT OPTION; FLUSH PRIVILEGES;" 2>/dev/null || \
mysql -u root --password="" -e "ALTER USER 'root'@'localhost' IDENTIFIED BY '${MYSQL_ROOT_PASSWORD}'; CREATE DATABASE IF NOT EXISTS \`${MYSQL_DATABASE}\`; CREATE USER IF NOT EXISTS 'root'@'%' IDENTIFIED BY '${MYSQL_ROOT_PASSWORD}'; GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' WITH GRANT OPTION; FLUSH PRIVILEGES;"

echo "✅ Done!"

wait $MYSQL_PID
