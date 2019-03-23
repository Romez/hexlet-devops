USER = "$(shell id -u):$(shell id -g)"

app:
	docker-compose up

app-build:
	docker-compose build

app-bash:
	docker-compose run app bash

app-setup: app-build
	docker-compose run app npm ci && docker-compose run app npm run prod
