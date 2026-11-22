<?php

require_once __DIR__ . "/Servicos.php";

class Utils {

    private static array $servicos = [
            "CERT"  => "Certidão",
            "INVNT" => "Inventário",
            "OFIC"  => "Ofício",
            "REGAV" => "Registro/Averbação",
            "CMPVD" => "Compra e Venda",
            "DOAC"  => "Doação",
            "NOTIF" => "Notificação",
            "ATEST" => "Ata/Estatuto",
            "ADJUD" => "Adjudicação",
            "USUC"  => "Usucapião",
            "CCB"   => "Cédula de Crédito Bancário",
            "BXCAN" => "Baixa/Cancelamento",
            "TITDF" => "Título Definitivo",
            "RETIF" => "Retificação",
            "ALFID" => "Alienação Fiduciária",
            "OUTR"  => "Outros",
        ];

    public static function date_to_string(DateTime $date, ?int $modify = null): mixed {

        switch ($modify) {

            case 1:
                return $date->format("d/m/Y");
            
            case 2:
                return $date->format("d/m/Y H:m");

            case 3:
                return $date->format("Y-m-d");

            case 4: 
                return $date;

            default:
                return $date->format("dmY");
        }
    }

    public static function compactar_array(array $array): array {
    if (empty($array)) {
        return [];
    }

    return array_merge(...array_map('array_values', $array));
}


    public static function set_codigo_protocolo(int $total_protocolos_abertos, string $servico, DateTime $data) {
                
        $dados = [$servico, self::date_to_string($data), $total_protocolos_abertos];
        return implode("", $dados);

    }

    public static function get_nome_servico(string $servico): mixed {
        return array_key_exists($servico, self::$servicos)
        ? self::$servicos[$servico]
        : null;
    }

    public function get_situacao(int $situacao): mixed {
        
        switch($situacao) {
            
            case 1:
                return "Em aberto";

            case 2:
                return "Concluído";

            case 3:
                return "Cancelado";

            default:
                return null;
        }
    }
}

?>