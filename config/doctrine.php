<?php

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Dotenv\Dotenv;

require_once __DIR__ . '/../vendor/autoload.php';

// Cargar variables de entorno
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Configuración de Doctrine
$isDevMode = $_ENV['APP_ENV'] === 'development';

$config = ORMSetup::createAttributeMetadataConfiguration(
    paths: [__DIR__ . '/../app/Domain'],
    isDevMode: $isDevMode,
);

// Conexión usando variables de entorno
$conn_params = [
    'driver'   => $_ENV['DB_DRIVER'],
    'host'     => $_ENV['DB_HOST'],
    'port'     => $_ENV['DB_PORT'],
    'dbname'   => $_ENV['DB_NAME'],
    'user'     => $_ENV['DB_USER'],
    'password' => $_ENV['DB_PASSWORD'],
];

$connection = DriverManager::getConnection($conn_params, $config);
$entityManager = new EntityManager($connection, $config);
return $entityManager;
