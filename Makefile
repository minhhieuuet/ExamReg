ifndef u
u:=sotatek
endif

ifndef env
env:=dev
endif

OS:=$(shell uname)

docker-start:
	docker-compose up -d

lint-php:
	vendor/bin/phpcs --standard=phpcs.xml --colors -n

docker-restart:
	docker-compose down
	make docker-start
	make docker-init-db-full
	make docker-link-storage

docker-connect:
	docker exec -it app bash

init-app:
	cp .env.example .env
	composer install
	npm install
	php artisan key:generate
	php artisan passport:keys --force
	php artisan migrate
	php artisan db:seed
	php artisan storage:link

docker-init:
	git submodule update --init
	docker exec -it app make init-app

init-db-full:
	make autoload
	php artisan migrate:fresh
	php artisan db:seed
	php artisan passport:install --force
docker-init-db-full:
	docker exec -it app make init-db-full

docker-link-storage:
	docker exec -it app php artisan storage:link

init-db:
	make autoload
	php artisan migrate:fresh

start:
	php artisan serve

log-daily:
	tail -f "./storage/logs/laravel-$(shell date +"%Y-%m-%d").log"

log:
	tail -f storage/logs/laravel.log

test-js:
	npm test

test-php:
	vendor/bin/phpcs --standard=phpcs.xml && vendor/bin/phpmd app text phpmd.xml

build:
	docker exec -it app npm run dev

watch:
	docker exec -it app npm run watch-poll

autoload:
	composer dump-autoload

cache:
	php artisan cache:clear && php artisan view:clear && php artisan config:clear

docker-cache:
	docker exec app make cache

route:
	php artisan route:list
