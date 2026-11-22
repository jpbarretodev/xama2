<?php

require_once __DIR__ . "/../database/connection.php";
require_once __DIR__ . "/../repository/RequestsProtocolo.php";
require_once __DIR__ . "/asserts.php";

class AssertsRequestsProtocolo extends RequestsProtocolo {

    public function testGetTotalProtocolosUsuario() {
        //Asserts::equals(0, $this->safeGetTotalProtocolosUsuario("joao")[0]["total"]);
    }

    public function testApresentantes() {
    $apresentantes = [
        ['nome' => 'joao', 'documento' => "077"],
        ['nome' => 'joao2', 'documento' => "088"]
    ];
    
    // Esperado após adicionar o 'fk'
    $esperado = "joao, 077, ". 77 .", joao2, 088, " . 77;

    //Asserts::equals($esperado, $this->safeSetProtocolo()); 
 
   }
}

$teste = new AssertsRequestsProtocolo(DataBaseConnection::getConnection());

$teste->testApresentantes();


?>