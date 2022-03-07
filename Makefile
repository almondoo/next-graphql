#-----------------------------------------------------------
# 初期セットアップ
#-----------------------------------------------------------
start-up:
	@make build
	@make up
	docker-compose exec node npm install
	docker-compose exec node npm run dev

#-----------------------------------------------------------
# 個々のコマンド
#-----------------------------------------------------------
build:
	docker-compose build

up:
	docker-compose up -d

down:
	docker-compose down

ps:
	docker-compose ps

backend:
	docker-compose exec backend ash

node:
	docker-compose exec node ash

mysql:
	docker-compose exec mysql bash

nginx:
	docker-compose exec nginx bash

npm-install:
	@make npm-install-for-container
	@make npm-install-for-host

composer-install:
	@make composer-install-for-container
	@make composer-install-for-host

composer-install-for-container:
	docker-compose exec backend composer install

	# Makefileでは変数展開が実行前に行われてしまうので $$(pwd) のように $$ 2個付ける
	# :/code -w /code このcodeの部分dockerのマウントさせるディクレトリを指定している
composer-install-for-host:
	docker-compose run --rm -v $$(pwd)/laravel:/code -w /code backend composer install

dump-autoload:
	docker-compose run --rm -v $$(pwd)/laravel:/code -w /code backend composer dump-autoload

all-clear:
	docker-compose run --rm -v $$(pwd)/laravel:/code -w /code backend make all-clear


npm-install-for-container:
	docker-compose exec node npm install

	# Makefileでは変数展開が実行前に行われてしまうので $$(pwd) のように $$ 2個付ける
	# :/code -w /code このcodeの部分dockerのマウントさせるディクレトリを指定している
npm-install-for-host:
	docker-compose run --rm -v $$(pwd)/next:/code -w /code node npm install
