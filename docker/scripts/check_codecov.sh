DIR=$(cd "$(dirname "$0")" && pwd)
# shellcheck source=./conf/.configuration
. "$DIR/conf/.configuration"

echo "Exec CODECOV: "

docker-compose exec "$APP_NAME"-app php vendor/bin/codecept run --coverage --coverage-xml
docker-compose exec "$APP_NAME"-app  bash -c "bash <(curl -s https://codecov.io/bash)"

echo "OK"
