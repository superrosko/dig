DIR=$(cd "$(dirname "$0")" && pwd)
# shellcheck source=./conf/.configuration
. "$DIR/conf/.configuration"

echo "Update composer: "

docker-compose exec "$APP_NAME"-app composer update
docker-compose exec "$APP_NAME"-app sh -c 'cd ./examples && composer update'