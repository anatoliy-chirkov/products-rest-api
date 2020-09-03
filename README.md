# REST API Каталог товаров
PHP 7.3 Slim framework

### Запуск
1. Установить [Docker](https://docs.docker.com/get-docker/) и [Docker-compose](https://docs.docker.com/compose/install/)
2. Скопировать .env.example в .env, можно изменить внешний порт "EXTERNAL_PORT" и название проекта, оно же является именем БД: "COMPOSE_PROJECT_NAME"
3. Выполнить команду, в корне проекта
```
docker-compose up -d
```
4. Если проект запускается первый раз, зайти в контейнер и завершить установку
```
docker exec -ti php bash
```
```
composer install
./vendor/bin/phpmig migrate
```

### Остановка
Выполнить команду, в корне проекта
```
docker-compose down
```
