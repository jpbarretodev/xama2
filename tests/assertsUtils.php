<?php

require_once __DIR__ . "/../utils/Utils.php";
require_once __DIR__ . "/asserts.php";

function testConversorData() {
    $dataAtual = new DateTime("now");
    $dataAtual->format("d/m/Y");

    Asserts::equals($dataAtual, Utils::string_to_date("2026-10-28", null), "sucesso");
}


testConversorData();
?>