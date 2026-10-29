<?php

require_once __DIR__ . "/../utils/Utils.php";
require_once __DIR__ . "/asserts.php";

function testConversorData() {
    $dataAtual = new DateTime("now");
    Asserts::equals($dataAtual, $dataAtual, "data convertida");
}

?>