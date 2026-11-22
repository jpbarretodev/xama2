<?php

require_once __DIR__ . "/../../utils/Utils.php";
require_once __DIR__ . "/../../database/connection.php";
require_once __DIR__ . "/../../repository/RequestsProtocolo.php";

class Protocolo {

    private function requests(): RequestsProtocolo {
        return new RequestsProtocolo(DataBaseConnection::getConnection());
    }

    private function utils_database(): UtilsDb {
        return new UtilsDb(DataBaseConnection::getConnection());
    }

    public function setProtocolo(
    array $apresentanteDocumento,
    string $data,
    string $servico,
    string $descricao,
    string $custas,
    int $pagamento,
    string $responsavel): array {

        $data = new DateTime($data);

        $data_hora_abertura = Utils::date_to_string($data, 3);
        $responsavel = $this->utils_database()->get_hash_responsavel($responsavel);
        
        $totalProtocolosResponsavel = $this->utils_database()->get_total_protocolos_responsavel($responsavel);
        $codigoProtocolo = Utils::set_codigo_protocolo($totalProtocolosResponsavel, $servico, $data);

        if(is_null($responsavel)) return [];

        return $this->requests()->safeSetProtocolo(
            $codigoProtocolo,
            $apresentanteDocumento,
            $data_hora_abertura,
            $descricao,
            $custas,
            $pagamento,
            $responsavel);
    }

    public function getProtocolo(string $codigoProtocolo, string $responsavel): array {

        $responsavel = $this->utils_database()->get_hash_responsavel($responsavel);
        
        $protocoloEncontrado = $this->requests()->safeGetProtocolo($codigoProtocolo, $responsavel); // array

        $protocoloEncontrado["data_abertura"] = Utils::date_to_string($protocoloEncontrado["data_abertura"], 2);
        $protocoloEncontrado["responsavel"] = $this->utils_database()->get_nome_responsavel($protocoloEncontrado["responsavel"]);

        return $protocoloEncontrado;
    
    }

    //public function updateProtocolo() {}


    public function set_protocolos_atrasados() {
        
    }
}

?>
