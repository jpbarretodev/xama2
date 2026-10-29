<?php

class DataBaseConnection {

    private static ?mysqli $conn = null;

    public static function getConnection() {
        return self::$conn != null 
        ? self::$conn
        : mysqli_connect(
            "localhost",
            "root",
            "",
            "cartorio"
        );
    }
}

?>