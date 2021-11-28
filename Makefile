make.DEFAULT_GLOBAL := help

init:
	make start
	make composer-install
	make database-create
	make database-migration-migrate
	make init-test

start:
	docker-compose up -d

stop:
	docker-compose down

database-create:
	docker-compose exec php bin/console doctrine:database:create

database-migration-migrate:
	docker-compose exec php bin/console doctrine:migration:migrate

migration-diff:
	docker-compose exec php bin/console doctrine:migration:diff

composer-install:
	docker-compose exec php composer install

init-test:
	docker-compose exec php bin/console doctrine:database:create --env=test
	docker-compose exec php bin/console doctrine:schema:update --env=test --force
	docker-compose exec php bin/console doctrine:fixtures:load --env=test

run-test:
	docker-compose exec php ./vendor/bin/phpunit