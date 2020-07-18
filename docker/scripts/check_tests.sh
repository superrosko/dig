DIR=$(cd "$(dirname "$0")" && pwd)
# shellcheck source=./conf/.configuration
. "$DIR/conf/.configuration"

echo "Exec TESTS: "

docker-compose exec "$APP_NAME"-app php vendor/bin/codecept run

echo "OK"
