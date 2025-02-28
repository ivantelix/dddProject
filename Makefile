# Nombre del proyecto
PROJECT_NAME=dddProject

# Comandos de Docker Compose
DC=docker compose

# Iniciar el entorno
.PHONY: up
up:
	@echo "Levantando contenedores..."
	$(DC) up -d --build

# Detener los contenedores
.PHONY: down
down:
	@echo "Deteniendo contenedores..."
	$(DC) down

# Detener y eliminar volúmenes (para resetear la BD)
.PHONY: clean
down-volumes:
	@echo "Deteniendo contenedores y eliminando volúmenes..."
	$(DC) down -v

# Ver logs de la aplicación
.PHONY: logs
logs:
	@echo "Mostrando logs..."
	$(DC) logs -f

# Ingresar a la base de datos MySQL
.PHONY: db-shell
db-shell:
	@echo "Conectando a MySQL..."
	docker exec -it mysql_db mysql -uuser -ppassword dbname

# Ingresar al contenedor de PHP
.PHONY: php-shell
php-shell:
	@echo "Ingresando al contenedor PHP..."
	docker exec -it php_app bash

# Construir nuevamente los contenedores sin caché
.PHONY: rebuild
rebuild:
	@echo "Reconstruyendo contenedores sin caché..."
	$(DC) build --no-cache

# Ver estado de los contenedores
.PHONY: status
status:
	@echo "Estado de los contenedores:"
	$(DC) ps
