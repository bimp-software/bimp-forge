<?php

namespace Bimp\Forge\Database;

use Bimp\Forge\Database\Database;


class Model extends Database{

    public static function list($table, $params = [], $limit = null){
        $cols_values = "";
        $limits      = "";

        if(!empty($params)){
            $cols_values .= 'WHERE';
            foreach($params as $key => $value){
                $cols_values .= " {$key} = :{$key} AND";
            }
            $cols_values = substr($cols_values, 0, -3);
        }

        if($limit !== null){
            $limit = " LIMIT {$limit}";
        }

        $stmt = "SELECT * FROM $table {$cols_values}{$limit}";

        if(!$rows = parent::query($stmt, $params)){
            return false;
        }

        return $limit === 1 ? $rows[0] : $rows;
    }

    public static function add($table, $params){
        $cols = "";
        $placeholders = "";

        foreach($params as $key => $value){
            $cols .= "{$key} ,";
            $placeholders .= ":{$key} ,";
        }

        $cols = substr($cols, 0, -1);
        $placeholders = substr($placeholders, 0, -1);
        $stmt = "INSERT INTO {$table} ({$cols}) VALUES({$placeholders})";

        if($id = parent::query($stmt, $params)){
            return $id;
        }else{
            return false;
        }
    }

    public static function update($table, $haystack = [], $params = [])
    {
        // Generar la parte del SET con parámetros nombrados
        $set_parts = [];
        foreach ($params as $key => $value) {
            $set_parts[] = "$key = :$key";
        }
        $placeholders = implode(', ', $set_parts);

        // Generar la parte del WHERE con prefijo w_ para evitar conflictos
        $where_parts = [];
        foreach ($haystack as $key => $value) {
            $where_parts[] = "$key = :w_$key";
        }
        $col = implode(' AND ', $where_parts);

        // Construir la consulta SQL final
        $stmt = "UPDATE $table SET $placeholders WHERE $col";

        // Unir los parámetros del SET y del WHERE con nombres distintos
        $binds = $params;
        foreach ($haystack as $key => $value) {
            $binds["w_$key"] = $value;
        }

        // Ejecutar la consulta usando el método del padre
        if (!parent::query($stmt, $binds)) {
            return false;
        }

        return true;
    }


    public static function remove(){

    }
}