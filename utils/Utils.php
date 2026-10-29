<?php

class Utils {

    public static function json_to_array(string $json): array {
        return json_decode($json);
    }

    public static function string_to_date(string $date, ?int $hour): DateTime {

        return $hour !== null
        ? DateTime::createFromFormat("d/m/Y H:m", $date) // colocar depois para o horario do Amazonas
        : DateTime::createFromFormat("d/m/Y", $date); // colocar depois para o horario do Amazonas
    } 
}
?>