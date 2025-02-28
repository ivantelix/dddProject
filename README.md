# Proyecto DDD con Docker y Makefile

## Pasos iniciales

1. Clonar el repositorio:
   ```sh
   git clone git@github.com:ivantelix/dddProject.git
   ```

2. Ir al directorio raíz del proyecto:
   ```sh
   cd nombre-del-proyecto
   ```

3. Renombrar el archivo `.env.example` a `.env`:
   ```sh
   cp .env.example .env
   ```

4. Configurar las variables de entorno en el archivo `.env`:
   ```ini
   DB_DRIVER=pdo_mysql
   DB_HOST=localhost
   DB_PORT=3307
   DB_NAME=ddd_db
   DB_USER=admin
   DB_PASSWORD=admin
   ```

5. Instalar las dependencias con Composer:
   ```sh
   composer install
   ```

6. Levantar los contenedores con Makefile:
   ```sh
   make up
   ```

---

## Comandos disponibles en el Makefile

Este Makefile te permite:

- **Levantar los contenedores** con:
  ```sh
  make up
  ```

- **Detener los contenedores** con:
  ```sh
  make down
  ```

- **Reiniciar la base de datos** (elimina volúmenes y datos) con:
  ```sh
  make down-volumes
  ```

- **Ver logs de los contenedores** con:
  ```sh
  make logs
  ```

- **Ingresar a MySQL dentro del contenedor** con:
  ```sh
  make db-shell
  ```

- **Acceder al contenedor PHP** con:
  ```sh
  make php-shell
  ```

- **Reconstruir los contenedores sin caché** con:
  ```sh
  make rebuild
  ```

- **Ver el estado de los contenedores** con:
  ```sh
  make status
  ```

---

¡Listo! Ahora puedes empezar a trabajar en tu proyecto. 🚀
