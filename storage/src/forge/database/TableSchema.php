<?php

namespace Bimp\Forge\Database;

use Exception;

class TableSchema {

    private ?string $sql = null;
    private string $table_name;
    private ?string $column = null;
    private array $columns = [];
    private array $pk = [];   // admite PK compuesta
    private array $fk = [];   // reservado para futuro
    private string $engine;
    private string $charset;
    private int $auto_inc = 1; // valor inicial del AUTO_INCREMENT de la tabla (opcional)
    private string $ph = '`%s`';

    public function __construct(string $table_name, ?string $engine = null, ?string $charset = null) {
        $this->table_name = strtolower(str_replace(' ', '_', $table_name));
        $this->engine  = $engine  ?? (defined('DB_ENGINE')  ? DB_ENGINE  : 'InnoDB');
        $this->charset = $charset ?? (defined('DB_CHARSET') ? DB_CHARSET : 'utf8mb4');
    }

    /**
     * Agrega una columna
     *
     * @param string $column_name
     * @param string $type (varchar, int, bigint, text, timestamp, datetime, boolean, decimal, etc.)
     * @param mixed  $value (tamaño/precisión si aplica, p.ej. 255 para varchar, ['10','2'] para decimal)
     * @param bool   $nullable
     * @param mixed  $default_value (null|'current_timestamp'|'current_timestamp_on_update'|valor escalar)
     * @param bool   $pk
     * @param bool   $auto_inc
     */
    public function addColumn(
        string $column_name,
        string $type,
        $value = null,
        bool $nullable = true,
        $default_value = null,
        bool $pk = false,
        bool $auto_inc = false
    ): void {
        $typeSql   = $this->validate_datatype($type, $value);
        $nullSql   = $nullable ? 'NULL' : 'NOT NULL';
        $defaultSql= $this->validate_default_value($default_value);

        $colSql = sprintf('%s %s %s %s',
            sprintf($this->ph, $column_name),
            $typeSql,
            $nullSql,
            $defaultSql
        );

        // Si el PK es de una única columna, puedes marcar inline.
        if ($pk === true) {
            $this->pk[] = $column_name;
            // Si sólo habrá PK simple, puedes marcar inline:
            // $colSql .= ' PRIMARY KEY';
        }

        if ($auto_inc === true) {
            // MySQL requiere entero (int/bigint) para AUTO_INCREMENT
            $lower = strtolower($type);
            if (!in_array($lower, ['int','bigint','mediumint','smallint','tinyint'], true)) {
                throw new Exception('AUTO_INCREMENT solo es válido para tipos enteros.');
            }
            $colSql .= ' AUTO_INCREMENT';
        }

        $this->columns[] = trim(preg_replace('/\s+/', ' ', $colSql));
    }

    /**
     * Validar tipo y armar SQL del tipo
     */
    private function validate_datatype(string $type, $value = null): string {
        $t = strtolower($type);

        switch ($t) {
            case 'varchar':
                $min = 1; $max = 255; $default = 255;
                if ($value === null) { $value = $default; }
                if (!is_int($value)) { throw new Exception("varchar requiere un entero (1-255)."); }
                $len = max($min, min($max, $value));
                return "VARCHAR($len)";

            case 'int':
                // Nota: INT(11) es “display width” (deprecated). Lo dejamos por compatibilidad.
                $len = (is_int($value) && $value > 0) ? $value : 11;
                return "INT($len)";

            case 'bigint':
                $len = (is_int($value) && $value > 0) ? $value : 20;
                return "BIGINT($len)";

            case 'boolean':
            case 'bool':
                return "TINYINT(1)";

            case 'text':
                return "TEXT";

            case 'timestamp':
                return "TIMESTAMP";

            case 'datetime':
                return "DATETIME";

            case 'decimal':
                // $value puede ser [precision, scale]
                $precision = 10; $scale = 2;
                if (is_array($value) && count($value) === 2) {
                    [$precision, $scale] = $value;
                }
                return sprintf('DECIMAL(%d,%d)', (int)$precision, (int)$scale);

            default:
                throw new Exception(sprintf('Tipo de dato no soportado: %s', $type));
        }
    }

    /**
     * Validar DEFAULT
     */
    private function validate_default_value($default_value): string {
        if ($default_value === false) {
            return ''; // sin DEFAULT
        }
        if ($default_value === null || strtolower((string)$default_value) === 'null') {
            return 'DEFAULT NULL';
        }

        $val = is_string($default_value) ? strtolower($default_value) : $default_value;

        if ($val === 'current_timestamp') {
            return 'DEFAULT CURRENT_TIMESTAMP';
        }
        if ($val === 'current_timestamp_on_update') {
            return 'DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP';
        }

        // Boolean → 0/1
        if (is_bool($default_value)) {
            return 'DEFAULT ' . ($default_value ? '1' : '0');
        }

        // Números sin comillas
        if (is_int($default_value) || is_float($default_value)) {
            return 'DEFAULT ' . $default_value;
        }

        // Cualquier otro valor → entre comillas
        return sprintf("DEFAULT '%s'", addslashes((string)$default_value));
    }

    /**
     * Getter genérico
     */
    public function get(string $property) {
        if (!property_exists($this, $property)) {
            throw new Exception(sprintf('La propiedad %s no existe', $property));
        }
        return $this->{$property};
    }

    /**
     * Setter genérico
     */
    public function set(string $property, $value) {
        if (!property_exists($this, $property)) {
            throw new Exception(sprintf('La propiedad %s no existe', $property));
        }
        $this->{$property} = $value;
        return $this->{$property};
    }

    /**
     * Construir SQL CREATE TABLE
     */
    private function build(): string {
        if (empty($this->columns)) {
            throw new Exception('No hay columnas para crear la tabla.');
        }

        $this->sql = sprintf('CREATE TABLE %s (', sprintf($this->ph, $this->table_name));

        // columnas separadas por coma
        $this->sql .= implode(', ', $this->columns);

        // PK compuesta (si hay más de una)
        if (count($this->pk) > 1) {
            $cols = array_map(fn($c) => sprintf($this->ph, $c), $this->pk);
            $this->sql .= ', PRIMARY KEY (' . implode(', ', $cols) . ')';
        } elseif (count($this->pk) === 1) {
            // Si deseas PK simple como constraint (en vez de inline):
            // $this->sql .= ', PRIMARY KEY (' . sprintf($this->ph, $this->pk[0]) . ')';
        }

        $this->sql .= ')';

        // Opciones de tabla
        $this->sql .= sprintf(' ENGINE=%s AUTO_INCREMENT=%d DEFAULT CHARSET=%s;',
            $this->engine,
            $this->auto_inc,
            $this->charset
        );

        return $this->sql;
    }

    /**
     * SQL completo CREATE TABLE
     */
    public function get_sql(): string { return $this->build(); }

    // Alias estilo PSR si prefieres camelCase
    public function getSql(): string { return $this->build(); }

    /**
     * Nombre de la tabla
     */
    public function getTableName(): string { return $this->table_name; }
}
