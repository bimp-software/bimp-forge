<?php

namespace Bimp\Forge\Database;

use Bimp\Forge\Database\Database;

class Query extends Database{

    protected $table;
    protected $pdo;
    protected $defaultColumns = '*';
    protected $where = [];
    protected $joins = [];
    protected $orderBy = [];
    protected $groupBy = [];
    protected $having = [];
    protected $limit = '';
    protected $distinct = false;
    protected $selectColumns = [];
    protected $bindings = [];

    /**
     * Constructor de la clase 
     * Inicializa la conexion y asignacion de la tabla
     * @param string $table Nombre de la tbala a consultar
     */
    function __construct($table){
        parent::__construct();
        $this->table = $table;
        $this->pdo = $this->connect();
    }

    /**
     * Metodo para definir las columnas a seleccionar
     * @param string|array $columns Columnas a seleccionar
     * @return $this    
     */
    public function select($columns){
        $this->selectColumns = is_array($columns) ? $columns : explode(', ', $columns);
        return $this;
    }

    /**
     * Metodo para definir las columnas a seleccionar en la consulta
     * @param array|string $columns Columnas a seleccionar
     * @return $this    
     */
    public function distinct(){
        $this->distinct = true;
        return $this;
    }

    /**
     * Metodo para agregar una condicion WHERE a la consulta
     * @param string $column Columna a filtrar
     * @param string $operator Operador de la condicion
     * @param mixed $value Valor de la condicion
     * @return $this    
     */
    public function where($column, $operator = '=', $value = null){
        $operator = strtoupper($operator);

        if($operator === 'IN' && is_array($value)){
            $placeholdes = implode(', ',array_map(fn($v) => "?", $value));
            $this->where[] = "$column IN ($placeholdes)";
            $this->bindings = array_merge($this->bindings, $value);
        } elseif ($operator === 'NOT IN' && is_array($value)){
            $placeholdes = implode(', ',array_map(fn($v) => "?", $value));
            $this->where[] = "$column NOT IN ($placeholdes)";
            $this->bindings = array_merge($this->bindings, $value);
        } else {
            $this->where[] = "$column $operator :$column";
            $this->bindings[$column] = $value;
        }
        return $this;
    }
        
    /**
     * Método para agregar una condición WHERE con OR
     * 
     * @param string $column Nombre de la columna
     * @param string $operator Operador de comparación
     * @param mixed $value Valor de la condición
     * @return $this
     */
    public function orWhere($column, $operator = '=', $value = null) {
        $this->where[] = "OR $column $operator :$column";
        $this->bindings[$column] = $value;
        return $this;
    }

    public function orderBy($column, $direction = 'ASC') {
        $this->orderBy[] = "$column $direction";
        return $this;
    }

    public function groupBy($columns) {
        $this->groupBy = is_array($columns) ? $columns : func_get_args();
        return $this;
    }

    public function havingRaw($having) {
        $this->having[] = $having;
        return $this;
    }

    public function limit($limit) {
        $this->limit = "LIMIT $limit";
        return $this;
    }

    public function leftJoin($table, $first, $operator, $second) {
        $this->joins[] = "LEFT JOIN $table ON $first $operator $second";
        return $this;
    }

    public function rightJoin($table, $first, $operator, $second) {
        $this->joins[] = "RIGHT JOIN $table ON $first $operator $second";
        return $this;
    }

    public function crossJoin($table) {
        $this->joins[] = "CROSS JOIN $table";
        return $this;
    }

    public function join($table, $first, $operator, $second) {
        $this->joins[] = "INNER JOIN $table ON $first $operator $second";
        return $this;
    }

    public function subQuery($subQuery, $alias) {
        $this->subQueries[] = "($subQuery) AS $alias";
        return $this;
    }

    public function like($column, $value) {
        $this->where[] = "$column LIKE :like_$column";
        $this->bindings["like_$column"] = '%' . $value . '%';
        return $this;
    }

    public function between($column, $start, $end) {
        $this->where[] = "$column BETWEEN :start AND :end";
        $this->bindings['start'] = $start;
        $this->bindings['end'] = $end;
        return $this;
    }

    public function as($column, $alias) {
        $this->selectColumns[$column] = "$column AS $alias";
        return $this;
    }

    public function count($column) {
        $this->selectColumns[] = "COUNT($column) AS count";
        return $this;
    }

    public function min($column) {
        $this->selectColumns[] = "MIN($column) AS min";
        return $this;
    }

    public function max($column) {
        $this->selectColumns[] = "MAX($column) AS max";
        return $this;
    }

    public function avg($column) {
        $this->selectColumns[] = "AVG($column) AS avg";
        return $this;
    }

    public function sum($column) {
        $this->selectColumns[] = "SUM($column) AS sum";
        return $this;
    }

    /**
     * Método para ejecutar la consulta y obtener los resultados
     * 
     * @return array Resultado de la consulta en forma de array asociativo
     */
    public function get() {
        try {
            // Construcción de la consulta SQL
            $sql = "SELECT " . ($this->distinct ? "DISTINCT " : "") . implode(", ", $this->selectColumns ?: [$this->defaultColumns]) . " FROM {$this->table}";
    
            if (!empty($this->joins)) {
                $sql .= " " . implode(" ", $this->joins);
            }
    
            if (!empty($this->where)) {
                $sql .= " WHERE " . implode(' AND ', $this->where);
            }
    
            if (!empty($this->groupBy)) {
                $sql .= " GROUP BY " . implode(', ', $this->groupBy);
            }
    
            if (!empty($this->having)) {
                $sql .= " HAVING " . implode(' AND ', $this->having);
            }
    
            if (!empty($this->orderBy)) {
                $sql .= " ORDER BY " . implode(', ', $this->orderBy);
            }
    
            if (!empty($this->limit)) {
                $sql .= " " . $this->limit;
            }
    
            // Preparar la consulta
            $stmt = $this->pdo->prepare($sql);
    
            // Inicializar el índice
            $index = 1; // Asegúrate de que comience en 1
    
            // Vincular parámetros
            foreach ($this->bindings as $value) {
                $stmt->bindValue($index++, $value); // Usar $index y luego incrementarlo
            }
    
            // Ejecutar la consulta
            $stmt->execute();
    
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Usar FETCH_ASSOC para obtener resultados como arrays asociativos
    
        } catch (PDOException $e) {
            die("Error al realizar la consulta: " . $e->getMessage());
        }
    }
    

    public function insert($data) {
        try {
            $columns = implode(", ", array_keys($data));
            $placeholders = ':' . implode(', :', array_keys($data));
            $sql = "INSERT INTO {$this->table} ($columns) VALUES ($placeholders)";

            $stmt = $this->pdo->prepare($sql);

            foreach ($data as $key => $value) {
                $stmt->bindValue(":{$key}", $value);
            }

            $stmt->execute();
            return $this->pdo->lastInsertId();
        } catch (PDOException $e) {
            die("Error al realizar el insert: " . $e->getMessage());
        }
    }

    public function insertMultiple($data) {
        try {
            // Verificar que hay datos para insertar
            if (empty($data)) {
                throw new Exception("No hay datos para insertar.");
            }
    
            // Obtener las columnas de la primera fila de datos
            $columns = implode(", ", array_keys($data[0]));
    
            // Crear una cadena de placeholders para múltiples filas
            $placeholders = [];
            foreach ($data as $row) {
                $placeholders[] = '(' . implode(', ', array_map(fn($key) => ":{$key}_" . count($placeholders), array_keys($row))) . ')';
            }
    
            // Construir la consulta SQL
            $sql = "INSERT INTO {$this->table} ($columns) VALUES " . implode(', ', $placeholders);
    
            // Preparar la consulta
            $stmt = $this->pdo->prepare($sql);
    
            // Vincular los valores
            foreach ($data as $index => $row) {
                foreach ($row as $key => $value) {
                    $stmt->bindValue(":{$key}_" . $index, $value);
                }
            }
    
            // Ejecutar la consulta
            $stmt->execute();
            
            return $this->pdo->lastInsertId(); // Devuelve el ID del último registro insertado (en caso de ser necesario)
        } catch (PDOException $e) {
            die("Error al realizar el insert múltiple: " . $e->getMessage());
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function update($data) {
        try {
            // Verificar que haya datos para actualizar
            if (empty($data)) {
                throw new Exception("No hay datos para actualizar.");
            }
    
            // Construir la parte SET de la consulta
            $sets = [];
            foreach ($data as $column => $value) {
                $sets[] = "$column = :$column"; // Añadir cada columna a actualizar
                $this->bindings[$column] = $value; // Vincular el valor correspondiente
            }
    
            // Construir la consulta SQL
            $sql = "UPDATE {$this->table} SET " . implode(', ', $sets);
    
            // Asegurarse de que haya una cláusula WHERE
            if (!empty($this->where)) {
                $sql .= " WHERE " . implode(' AND ', $this->where);
            } else {
                throw new Exception("No se definió ninguna condición WHERE para la actualización.");
            }
    
            // Preparar la consulta
            $stmt = $this->pdo->prepare($sql);
    
            // Vincular los parámetros de actualización
            foreach ($this->bindings as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }
    
            // Ejecutar la consulta
            $stmt->execute();
    
            // Limpiar los parámetros de la clase después de ejecutar
            $this->where = [];
            $this->bindings = [];
    
            return $stmt->rowCount(); // Devuelve el número de filas afectadas
        } catch (PDOException $e) {
            die("Error al realizar el update: " . $e->getMessage());
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function delete() {
        try {
            $sql = "DELETE FROM {$this->table}";
    
            if (!empty($this->where)) {
                $sql .= " WHERE " . implode(' AND ', $this->where);
            }
    
            $stmt = $this->pdo->prepare($sql);
    
            foreach ($this->bindings as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }
    
            $stmt->execute();
    
            return $stmt->rowCount();
        } catch (PDOException $e) {
            die("Error al realizar el delete: " . $e->getMessage());
        }
    }

}