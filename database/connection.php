<?php

class DataBaseConnection {

    private static ?mysqli $conn = null;

    public static function getConnection() {

        if (self::$conn === null) {
            self::$conn = mysqli_connect(
                "localhost",
                "root",
                "",
                "testebanco"
            );
        }
        
        return self::$conn;
    }
}

?>
