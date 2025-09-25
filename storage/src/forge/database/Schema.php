<?php

namespace Bimp\Forge\Database;

use Bimp\Forge\Database\Database;

use \Exception;

class Schema
{
    /**
     * Ejecuta SQL de esquema (CREATE/DROP/ALTER/INSERT/UPDATE/DELETE).
     * Devuelve true si el SQL se ejecutó correctamente.
     *
     * @param string $sql
     * @param array  $params  Parámetros nombrados/posicionales si aplica
     * @return bool
     * @throws Exception Si Database::query lanza error
     */
    public static function exec(string $sql, array $params = []): bool
    {
        // Database::query ya maneja transacciones y distingue SELECT/NO SELECT
        $result = Database::query($sql, $params);

        // Para comandos DDL/DML no-SELECT, tu Database::query devuelve true
        // Para INSERT devuelve el lastInsertId; lo normal en migraciones es DDL
        if ($result === true || is_int($result) || is_string($result)) {
            return true;
        }

        // Si llegase a devolver array (raro para DDL), lo consideramos OK
        if (is_array($result)) {
            return true;
        }

        // Cualquier otro caso lo tratamos como fallo
        return false;
    }

    /**
     * Ejecuta un SELECT y retorna los resultados como array asociativo.
     *
     * @param string $sql
     * @param array  $params
     * @return array
     * @throws Exception
     */
    public static function query(string $sql, array $params = []): array
    {
        $result = Database::query($sql, $params);

        // Tu Database::query retorna false si no hay filas
        if ($result === false) {
            return [];
        }

        if (!is_array($result)) {
            // Si no es array, no es un SELECT válido
            return [];
        }

        return $result;
    }
}
