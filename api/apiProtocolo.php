<?php

require_once __DIR__ . "/../protocolo/services/Protocolo.php";

class apiProtocolo {

    private Protocolo $protocolo;
    
    public function __construct()  {
        $this->protocolo = new Protocolo();
    }

    public function get_Protocolo(string $protocolo, string $responsavel): void {
        $result = $this->protocolo->getProtocolo($protocolo, $responsavel);

        if(empty($result)){
            echo json_encode(["erro" => "protocolo nao encontrado ou pertence a outro colaborador"]);
        } else {
            echo json_encode($result);
        }
    }

}




//TODO: completar as requisiçoes para integrar com o roteador