<?php

class DataBaseConnection {

    private static mixed $conn = null;

    public static function getConnection() {

        // if (self::$conn === null) {
        //     self::$conn = mysqli_connect(
        //         "localhost",
        //         "root",
        //         "",
        //         "testecartorio"
        //     );
        // }
        
        return self::$conn;
    }

}

?>