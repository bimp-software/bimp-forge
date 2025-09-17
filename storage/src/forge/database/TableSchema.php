<?php 

namespace Bimp\Forge\Database;

use \Exception;

class TableSchema {

    private $sql = null;
    private $table_name = null;
    private $columm = null;
    private $colummns = [];
    private $pk = [];
    private $fk = [];
    private $engine = DB_ENGINE;
    private $charset = DB_CHARSET;
    private $auto_inc = 1;
    private $ph = '`%s`';

    public function __construct(string $table_name, string $engine = null, string $charset = null) {
        $this->table_name = strtolower(str_replace(' ', '_', $table_name));
        $this->engine = $engine !== null ? $engine : $this->engine;
        $this->charset = $charset !== null ? $charset : $this->charset;
    }

    /**
     * Agrega una columna a la tabla en curso
     * @param string $column_name
     * @param string $type
     * @param mixed $value
     * @param boolean $nulleable
     * @param string $default_value
     * @param boolean $pk;
     * @param boolean $auto_inc
     * @return void
     */
    public function addColumn(string $column_name, string $type, $value = null, bool $nulleable = true, string $default_value = 'null', bool $pk = false, bool $auto_inc = false) {
        $this->columm = sprintf('%s %s %s %s',sprintf($this->ph, $column_name), $this->validate_datatype($type, $value),$nulleable === true ? 'NULL' : 'NOT NULL',$this->validate_default_value($default_value));

        //Si es primary key
        if($pk === true){ 
            $this->pk[] = $column_name;
            $this->columm .= ' PRIMARY KEY';
        }

        //Si es auto incrementable
        if($pk === true && $auto_inc === true){
            $this->columm .= ' AUTO_INCREMENT';
        }

        $this->colummns[] = $this->columm;
    }

    /**
     * Verifica que el valor y el tipo de valor sean validos
     * @param string $type
     * @param mixed $value
     * @return void
     */
    private function validate_datatype(string $type, $value = null){
        $output = '';

        switch(strtolower($type)){
            case 'varchar':
                $default = 255;
                $min = 1;
                $max = 255;

                if(is_null($value)) { $value = $default; }
                if(!is_integer($value)){ throw new Exception(sprintf('El valor debe ser numerico y como maximo de %s',$max)); }

                $value = $value > $max ? $max : ($value <= 0 ? $min : $value);
                $output = sprintf('%s(%s)',$type,$value);
                break;
            case 'int':
                $min = 1;
                $max = 11;

                if(!is_integer($value) && $value !== null){ throw new Exception(sprintf('El valor debe ser numerico y como maximo de %s',$max)); }

                $value = $value > $max ? $max : ($value <= 0 ? $min : $value);
                $output = sprintf('%s(%s)',$type, $value);
                break;
            default:
            throw new Exception(sprintf('El tipo de dato %s no es valido',$type));
        }

        return $output;
    }

    /**
     * Validar el valor por defecto de la columna
     * @param mixed $default_value
     * @return string
     */
    private function validate_default_value($default_value){
        $output = '';

        switch($output){
            case false:
                $output = ''; break;
            case 'null':
                $output = 'DEFAULT NULL'; break;
            case 'current_timestamp':
                $output = 'DEFAULT CURRENT_TIMESTAMP'; break;
            case 'current_timestamp_on_update':
                $output = 'DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'; break;
            default: 
                $output = sprintf("DEFAULT '%s'",$default_value); break;
        }

        return $output;
    }

    /**
     * Metodo getter 
     * @param string $property
     * @return mixed
     */
    public function get($property){
        if(!isset($this->{$property})){ throw new Exception(sprintf('La propiedad %s no existe',$property)); }
        return $this->{$property};
    }

    /**
     * Metodo setter
     * @param string $property
     * @param mixed $value
     * @return mixed
     */
    public function set($property, $value){
        if(!isset($this->{$property})){ throw new Exception(sprintf('La propiedad %s no existe',$property)); }
        $this->{$property} = $value;
        return $this->{$property};
    }

    /**
     * Construye el query completo para crear la tabla de la base de datos 
     * @return string
     */
    private function build(){
        if(empty($this->colummns)){ throw new Exception('No hay columnas para crear la tabla.'); }

        $this->sql = sprintf('CREATE TABLE %s',sprintf($this->ph, $this->table_name));

        if(empty($this->colummns)){ throw new Exception('No hay columnas, agrega minimo una columna.'); }

        $this->sql .= '(';

        //agregando cada una de las columnas
        $total = count($this->colummns);
        foreach($this->colummns as $i => $col){
            if(($total - 1) === $i){
                $this->sql .= sprintf('%s', $col);
            }else{
                $this->sql .= sprintf('%s', $col);
            }
        }

        $this->sql .= ')';

        $this->sql .= sprintf(' ENGINE=%s AUTO_INCREMENT=%s DEFAULT CHARSET=%s;', $this->engine,$this->auto_inc, $this->charset);
        return $sql;
    }

    /**
     * Regresa el query SQL completo para la creacion de la tabla
     * @return string
     */
    public function get_sql(){ return $this->build(); }

    /**
     * Regresa el nombre de la tabla
     * @return string
     */
    public function getTableName(){ return $this->table_name; }

}