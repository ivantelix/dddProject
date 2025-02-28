<?php

namespace App\Infrastructure;

class DependencyContainer
{
    private static array $instances = [];

    public static function set(string $key, object $instance): void
    {
        self::$instances[$key] = $instance;
    }

    public static function get(string $key): ?object
    {
        return self::$instances[$key] ?? null;
    }
}