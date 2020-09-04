# REST API Каталог товаров
PHP 7.3 Slim framework

## Установка проекта

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

## API

### Categories

#### GET /categories
```
Parameters: parent_id (int, optional), products_min_remnant (int, optional, default 0), visible (bool, optional)

Success Response:
  Code: 200
  Body: {
    "status_code": 200,
    "data": {
      "items": [
        {
          "id": 1,
          "name": "Example category",
          "parent_id": null,
          "visible": true,
          "children_count": 0
        }
      ],
      "total": 0,
      "per_page": 15,
      "page": 1,
      "last_page": 1
    },
  }
```

#### POST /categories
```
Body JSON: name (string), parent_id (int, optional, default null), visible (bool, optional, default true)

Success Response:
  Code: 201
  Body: {
    "status_code": 201,
    "data": {
      "id": 1,
      "name": "Example category",
      "parent_id": null,
      "visible": true
    },
  }
```

#### PUT /categories/:id
```
Replaceable URL values: id (int)
Body JSON: name (string), parent_id (int), visible (bool)

Success Response:
  Code: 200
  Body: {
    "status_code": 200,
    "data": {
      "id": 1,
      "name": "Example category",
      "parent_id": null,
      "visible": true
    },
  }
```

#### DELETE /categories/:id
```
Replaceable URL values: id (int)
Parameters: delete_children (bool, optional, default true), delete_products (bool, optional, default true)

Success Response:
  Code: 204
  Body: null
```

### Products

#### GET /products
```
Parameters: name (string, optional), categories_ids (array of int, optional), min_remnant (int, optional, default 0)

Success Response:
  Code: 200
  Body: {
    "status_code": 200,
    "data": {
      "items": [
        {
          "id": 1,
          "name": "Example product",
          "categories": [
            {
                "id": 1,
                "name": "Example category",
                "parent_id": null,
                "visible": true,
            }
          ],
          "price": 10.00,
          "remnant": 1
        }
      ],
      "total": 0,
      "per_page": 15,
      "page": 1,
      "last_page": 1
    },
  }
```

#### POST /products
```
Body JSON: name (string), categories_ids (array of int), price (float), remnant (int, optional, default 0)

Success Response:
  Code: 201
  Body: {
    "status_code": 201,
    "data": {
      "id": 1,
      "name": "Example product",
      "categories": [
        {
            "id": 1,
            "name": "Example category",
            "parent_id": null,
            "visible": true,
        }
      ],
      "price": 10.00,
      "remnant": 1
    },
  }
```

#### PUT /products/:id
```
Replaceable URL values: id (int)
Body JSON: name (string), categories_ids (array of int), price (float), remnant (int)

Success Response:
  Code: 200
  Body: {
    "status_code": 200,
    "data": {
      "id": 1,
      "name": "Example product",
      "categories": [
        {
          "id": 1,
          "name": "Example category",
          "parent_id": null,
          "visible": true,
        }
      ],
      "price": 10.00,
      "remnant": 1
    },
  }
```

#### DELETE /products/:id
```
Replaceable URL values: id (int)

Success Response:
  Code: 204
  Body: null
```
