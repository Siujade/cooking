<?php

abstract class MainModel
{
    protected static $connection;

    public function __construct()
    {
        try {
            self::$connection = new PDO(DB_CONNECTION_STRING, DB_USER, DB_PASS);
            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public static function select($table, $fields, $conditions = array(), $order = array(), $extra_sql = '')
    {
        if (is_array($fields)) {
            $fields = implode(',', $fields);
        }

        if(!empty($conditions)) {
            $where = '1 ';

            foreach($conditions as $key => $value) {
                $where .= "AND $key = '$value' ";
            }

            $conditions = $where;
        }  else {
            $conditions = 1;
        }

//        if(!empty($order)) {
//            $order = implode(',', $order);
//        } else {
//            $order = 'user_id';
//        }

        $img = 'image';

        $sql = "SELECT $fields FROM $table $extra_sql WHERE $conditions";
        $stmt = self::$connection->prepare($sql);
        $stmt->execute();


        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function insert($table, $data = array())
    {
        $fields = implode(',', array_keys($data));

        array_walk($data, function(&$value){
            if(is_string($value)){
                $value = self::$connection->quote($value);
            }
        });

        $records = implode(',', $data);

        try{
           $stmt = self::$connection->prepare("INSERT INTO $table($fields) VALUES($records)");

           return $stmt->execute();

        } catch  (PDOException $e) {
              return $e;
        }
    }

    public static function delete($table, $fields = array()){
       $fields = implode(',', $fields);
       $stmt = self::$connection->prepare("DELETE FROM $table WHERE id in ($fields)");

        return $stmt->execute();
    }
} 