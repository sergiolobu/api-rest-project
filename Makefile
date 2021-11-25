make.DEFAULT_GLOBAL := help

init:
	make start
	make composer-install
	make database-create
	make database-migration-migrate

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
