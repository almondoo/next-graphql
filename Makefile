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
	docker-compose exec nginx ash
