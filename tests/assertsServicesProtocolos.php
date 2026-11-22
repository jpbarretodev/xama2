<?php

require_once __DIR__ . "/asserts.php";
require_once __DIR__ . "/../protocolo/services/Protocolo.php";

function testInsertProtocolo() {

        $esperado = [
          "CERT161120261",
            ["joao"],
            "2026-11-16",
            "teste",
            "0.1",
            1,
            "JoaoAdm"
        ];

      $teste = new Protocolo();
      
        Asserts::equals($esperado, $teste->setProtocolo(
            ["joao"],
            "2026-11-16",
            "CERT",
            "teste",
            "0.1",
            1,
            "JoaoAdm"
        )
        );
}

testInsertProtocolo();

?>