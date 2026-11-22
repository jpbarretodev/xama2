<?php

require_once __DIR__ . "/../utils/Utils.php";
require_once __DIR__ . "/asserts.php";
require_once __DIR__ . "/../utils/UtilsDb.php";

function testConversorData() {
    $dataAtual = new DateTime("now");
    Asserts::equals("01/01/2000", Utils::date_to_string(new DateTime("2000-01-01"), 1));
}

function testCompactarArray() {

    // array de teste
    $teste = [
        [1, 2, 3],
        [4, 5, 6]
    ];

    Asserts::equals([1, 2, 3, 4, 5, 6], Utils::compactar_array($teste));
}

function testSetCodigoProtocolo() {

    $esperado = "CERT161120261";

    Asserts::equals($esperado, Utils::set_codigo_protocolo("1" ,"CERT", new DateTime("16112026")));
}

testSetCodigoProtocolo();

?>