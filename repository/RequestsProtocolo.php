<?php

require_once __DIR__ . "/../database/connection.php";
require_once __DIR__ . "/../utils/UtilsDb.php";
require_once __DIR__ . "/../utils/Utils.php";

class RequestsProtocolo extends UtilsDb {

    private function safeGetStringPlaceholderApresentanteDocumentoFk(array $apresentantes): string {
        return implode(", ", array_fill(0, count($apresentantes), "(?, ?, ?)"));
    }

    private function safeGetIdProtocolo(string $codigoProtocolo, string $responsavel) {

        $sql =
        "SELECT id
        FROM protocolori
        WHERE codigo = ? AND responsavel = ?";

        return $this->dbQuery($sql, $codigoProtocolo, $responsavel);
    }
    
    public function safeSetApresentantes(array $apresentanteDocumento, int $idProtocolo): mixed {

       $arrayApresentantes = array_map(function ($apresentante) use ($idProtocolo) {
            return [
                $apresentante["nome"],
                $apresentante["documento"],
                $idProtocolo
            ];
        }, $apresentanteDocumento);


        $placeholder = $this->safeGetStringPlaceholderApresentanteDocumentoFk($arrayApresentantes);

        $arrayMerged = implode(', ', Utils::compactar_array($arrayApresentantes)); // string do array linear com os valores corretos a serem passados
        $sql = 
        "INSERT INTO apresentantes (nome, documento, id_protocolo)
        VALUES $placeholder";

        //return $arrayMerged;

        return $this->dbRequest($sql, $arrayMerged);
        
    }

    public function safeSetProtocolo(
    string $codigo,
    array $apresentanteDocumento,
    string $dataHoraAbertura,
    string $descricao,
    string $custas,
    string $pagamento,
    string $responsavel) {
        
        $sql = "INSERT INTO protocolos (codigo, data_abertura, descricao, custas, pagamento, responsavel)
        VALUES (?, ?, ?, ?, ?, ?)";


        if($this->dbQuery($sql, $codigo, $dataHoraAbertura, $descricao, $custas, $pagamento, $responsavel)) {
            $idProtocolo = (int) $this->get_last_insert_id();

            return $this->safeSetApresentantes($apresentanteDocumento, $idProtocolo);
        }

        return null;
    }

    public function safeGetProtocolo(string $codigoProtocolo, string $responsavel) {

        $sql = 
        "SELECT data_abertura, situacao, custas
        FROM protocolos
        INNER JOIN apresentantes ON protocolos.id_apresentantes = apresentantes.id
        WHERE codigo = ? AND responsavel = ?";

        $resultado = $this->dbQuery($sql, $codigoProtocolo, $responsavel);

        return $resultado;

    }

    public function safeUpdateCustas(string $codigoProtocolo, string $responsavel, float $custas): bool {

        $id_protocolo = $this->safeGetIdProtocolo($codigoProtocolo, $responsavel);
        
        $sql = 
        "UPDATE protocolosri
        SET custas = ?
        WHERE id = ?";

        return $this->dbRequest($sql, $custas, $id_protocolo);
   }

   public function safeUpdateDescricao(string $codigoProtocolo, string $responsavel, string $descricao) {

        $id_protocolo = $this->safeGetIdProtocolo($codigoProtocolo, $responsavel);

        $sql =
        "UPDATE protocolosri
        SET descricao = ?
        WHERE id = ?";

        return $this->dbRequest($sql, $id_protocolo, $descricao);
   }


    //TODO: Fazer a requisiçao de atualizaçao dos apresentantes (dificil em)


    public function safeUpdateSituacao(string $codigoProtocolo, string $responsavel, int $situacao) {

        $id_protocolo = $this->safeGetIdProtocolo($codigoProtocolo, $responsavel);

        $sql =
        "UPDATE protocolosri
        SET situacao = ?
        WHERE id = ?";

        return $this->dbRequest($sql, $situacao, $id_protocolo);
    }

    public function safeUpdatePagamento(string $codigoProtocolo, string $responsavel, int $pagamento) {

        $id_protocolo = $this->safeGetIdProtocolo($codigoProtocolo, $responsavel);

        $sql = 
        "UPDATE protocolosri
        SET pagamento = ?
        WHERE id = ?";

        return $this->dbRequest($sql, $pagamento, $id_protocolo);
    }

    // public function safeGetTotalProtocolosUsuario(string $responsavel): int {
    //     $sql = 
    //     "SELECT COUNT(*) as total
    //     FROM protocolos
    //     WHERE responsavel = ?";

    //     //$resultado = $this->dbQuery($sql, $responsavel);

    //     $resultado = 0;

    //     return $resultado > 0
    //     ? $resultado
    //     : 0;
    // }

    public function safeGetProtocoloSituacao(int $situacao, string $responsavel, ?int $admin = null) {

        if(!is_null($admin)) {
            $sql = 
            "SELECT codigo, data_abertura, responsavel
            FROM protocolos
            WHERE situacao = ?";
            
            return $this->dbQuery($sql, $situacao);
        }

        $sql =
        "SELECT codigo, data_abertura, responsavel
        FROM protocolos
        WHERE situacao = ? AND responsavel = ?";

        return $this->dbQuery($sql, $situacao, $responsavel);
    }

}

?>