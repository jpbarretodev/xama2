<?php

class UtilsDb {

    // private mysqli $connDb;

    // public function __construct(mysqli $connection) {
    //     $this->connDb = $connection;
    // }

    public function dbQuery(string $sql, mixed ...$params): array {
        $stmt = $this->connDb->prepare($sql);
        $stmt->execute($params);
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $result;
    }

    public function dbRequest(string $sql, mixed ...$params): int {
        $stmt = $this->connDb->prepare($sql);
        $stmt->execute($params);
        $result = $stmt->affected_rows > 0;
        $stmt->close();
        return $result;
    }

    public function get_last_insert_id(): int {
        $stmt = $this->connDb->prepare("SELECT LAST_ISERT_ID()");
        $stmt->execute();
        return $stmt->get_result();

    }

    public function get_hash_responsavel(string $senha): mixed {
        
        $sql = 
        "SELECT hashh
        FROM users
        WHERE senha = ?";

        $result = $this->dbQuery($sql, $senha);

        return $result;
    }

    public function get_nome_responsavel(string $senha): mixed {

        $sql = 
        "SELECT nome
        FROM users
        WHERE senha = ?";

        $result = $this->dbQuery($sql, $senha)["nome"];

        return $result;
    }

    public function get_total_protocolos_responsavel(string $responsavel) {

        $sql = 
        "SELECT COUNT(*) as total
        FROM protocolosri
        WHERE responsavel = ?";

        return $this->dbQuery($sql, $responsavel)[0]["total"];
    }
}

?>