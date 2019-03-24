USER = "$(shell id -u):$(shell id -g)"

app:
	docker-compose up

app-build:
	docker-compose build

app-bash:
	docker-compose run --user=$(USER) app bash

app-setup: development-setup-env app-build
	docker-compose run --user=$(USER) app composer install
	docker-compose run --user=$(USER) app npm ci
	docker-compose run app php artisan migrate
	docker-compose run --user=$(USER) app php artisan key:generate
