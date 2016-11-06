<?php

namespace Lib;

class Database
{
    const CONNECTION = "mysql:host=localhost;dbname=fortune";
    const USER_NAME = "root";
    const PASSWORD = "111333a";

    protected static function connection()
    {
        $conn = new PDO(self::CONNECTION, self::USER_NAME, self::PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $conn;
    }

    private static function queryResult($sql, $successMsg = '')
    {
        try {
            self::connection()->exec($sql);
            echo $successMsg;
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }

    public static function insert($table, $data = array())
    {
        $fields = implode(',', array_keys($data));
        $records = self::connection()->quote(implode(',', $data));

        $sql = "INSERT INTO $table($fields)
                VALUES ($records)";

        self::queryResult($sql, "Браво, Ани! Успя да въведеш късметче!");
    }

    public static function massInsert($table, $field, $records = array())
    {
        $values = "";

        foreach ($records as $record) {
            $values .= "('$record'),";
        }

        $values = trim($values, ',');
        $sql = "INSERT INTO $table($field)
                VALUES $values";

        self::queryResult($sql, "Браво, Ани! Успя да въведеш късметче!");
    }

    public static function select($table, $fields, $conditions = array())
    {
        if (is_array($fields)) {
            $fields = implode(',', array_keys($fields));
        }

        $stmt = self::connection()->prepare("SELECT $fields FROM $table");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
