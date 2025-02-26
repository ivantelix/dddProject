<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Dotenv\Dotenv;

require_once __DIR__ . '/../vendor/autoload.php';

// Cargar variables de entorno
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Configuración de Doctrine
$isDevMode = $_ENV['APP_ENV'] === 'development';

$config = Setup::createAnnotationMetadataConfiguration(
    [__DIR__ . '/../app/Domain'],
    $isDevMode
);

// Conexión usando variables de entorno
$conn = [
    'driver'   => $_ENV['DB_DRIVER'],
    'host'     => $_ENV['DB_HOST'],
    'port'     => $_ENV['DB_PORT'],
    'dbname'   => $_ENV['DB_NAME'],
    'user'     => $_ENV['DB_USER'],
    'password' => $_ENV['DB_PASSWORD'],
];

$entityManager = EntityManager::create($conn, $config);

return $entityManager;
