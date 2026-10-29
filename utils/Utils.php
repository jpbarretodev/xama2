<?php

class Utils {

    public static function json_to_array(string $json): array {
        return json_decode($json);
    }

    public static function date_to_string(DateTime $date, ?int $hour = null): string {

        return $hour !== null 
        ? $date->format("d/m/Y") 
        : $date->format("d/m/Y H:m");
    }
}
?>