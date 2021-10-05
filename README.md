# PHP backend - разработчик

### Back-end
- [Lumen](https://lumen.laravel.com/)
- [PostgreSQL](https://www.postgresql.org/)
- [Docker](https://www.docker.com/)

## Running this app
#### Clone this repo anywhere you want and move into the directory:

```sh
git clone https://github.com/vtiurin/weather-api weather-api
cd weather-api
```

#### Copy a few example files because the real files are git ignored:

```sh
cp .env.example .env
```


#### Build everything:

```sh
docker-compose up --build
```

#### Setup the initial database:

```sh
# You can run this from a 2nd terminal.
docker exec weather_api_1 php artisan migrate:fresh --seed
```

### Использование
Поиск по городу:
http://localhost:8080/api/v1/search?city=
- [http://localhost:8080/api/v1/search?city=saint-petersburg](http://localhost:8080/api/v1/search?city=saint-petersburg)

Популярные запросы за все время: http://localhost:8080/api/v1/popular
- [http://localhost:8080/api/v1/popular](http://localhost:8080/api/v1/popular)

Фильтры:
- Количество [http://localhost:8080/api/v1/popular?limit=5](http://localhost:8080/api/v1/popular?limit=5)

- За последний день [http://localhost:8080/api/v1/popular?date_filter=day](http://localhost:8080/api/v1/popular?date_filter=day)
- За последний месяц [http://localhost:8080/api/v1/popular?date_filter=month](http://localhost:8080/api/v1/popular?date_filter=month)

### Добавление новых источников
Чтобы добавить новый источник данных нужно создать [класс-адаптер](https://refactoring.guru/ru/design-patterns/adapter), который реализует интерфейс *WeatherCheckerInterface*
. Затем добавить в метод *register()* класса *App\Providers\AppServiceProvider* необходимый bind и tag.
