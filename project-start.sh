cd ./
docker-compose up -d
docker exec php_app a2enmod rewrite
docker exec php_app service apache2 reload
