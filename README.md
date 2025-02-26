// README.md
# PHP DDD Project

## Requisitos
- Docker
- Docker Compose

## Configuración

1. Clona el repositorio:
   ```bash
   git clone <repo_url>
   cd project-root
   ```

2. Construye los contenedores:
   ```bash
   docker-compose up --build
   ```

3. Accede a la aplicación:
   ```
   http://localhost:8000
   ```

## Probar el registro de usuario

Usa `curl` para enviar una solicitud de registro:

```bash
curl -X POST http://localhost:8000 -H "Content-Type: application/json" -d '{
  "name": "John Doe",
  "email": "john@example.com",
  "password": "StrongPass1!"
}'
```

## Ejecutar Pruebas

```bash
docker-compose exec app vendor/bin/phpunit
```