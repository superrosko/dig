DIR=$(cd "$(dirname "$0")" && pwd)
# shellcheck source=./conf/.configuration
. "$DIR/conf/.configuration"

echo "Install composer: "

docker-compose exec "$APP_NAME"-app composer install
docker-compose exec "$APP_NAME"-app sh -c 'cd ./examples && composer install'
