<?php

namespace Bimp\Forge\Database;

class Database {

    private $link  = null;
    private $dsn;
    private $engine;
    private $host;
    private $name;
    private $charset;
    private $user;
    private $pass;
    private $options;

    public function __construct() {
        $this->engine  = DB_ENGINE;
        $this->host    = DB_HOST;
        $this->name    = DB_NAME;
        $this->charset = DB_CHARSET;
        
        $this->dsn = sprintf('%s:host=%s;dbname=%s;charset=%s', 
            $this->engine, $this->host, $this->name, $this->charset
        );

        $this->user    = DB_USER;
        $this->pass    = DB_PASS;

        $this->options = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES   => false
        ];

        return $this;  
    }

    /**
     * Metodo para abrir una conexion a la base de datos
     * @return void
     */
    private function connect(){
        try {
            $this->link = new \PDO($this->engine.':host='.$this->host.';dbname='.$this->name.';charset='.$this->charset, $this->user, $this->pass, $this->options); 
            return $this->link;
        } catch (\PDOException $e) {
            die(sprintf('No  hay conexión a la base de datos, hubo un error: %s', $e->getMessage()));
        }
    }

    public static function query($sql, $params = []){
        $db = new self();
        $link = $db->connect(); // nuestra conexión a la db
        $link->beginTransaction(); // por cualquier error, checkpoint
        $query = $link->prepare($sql);

        // Manejando errores en el query o la petición
        // SELECT * FROM usuarios WHERE id=:cualquier AND name = :name;
        if(!$query->execute($params)) {

        $link->rollBack();
        $error = $query->errorInfo();
        // index 0 es el tipo de error
        // index 1 es el código de error
        // index 2 es el mensaje de error al usuario
        throw new Exception($error[2]);
        }

        // SELECT | INSERT | UPDATE | DELETE | ALTER TABLE
        // Manejando el tipo de query
        // SELECT * FROM usuarios;
        if(strpos($sql, 'SELECT') !== false) {
        
        return $query->rowCount() > 0 ? $query->fetchAll() : false; // no hay resultados

        } elseif(strpos($sql, 'INSERT') !== false) {

        $id = $link->lastInsertId();
        $link->commit();
        return $id;

        } elseif(strpos($sql, 'UPDATE') !== false) {

        $link->commit();
        return true;

        } elseif(strpos($sql, 'DELETE') !== false) {

        if($query->rowCount() > 0) {
            $link->commit();
            return true;
        }
        
        $link->rollBack();
        return false; // Nada ha sido borrado

        } else {

        // ALTER TABLE | DROP TABLE 
        $link->commit();
        return true;
        
        }
    }

}