<?php

class UtilsDb {

    private mysqli $connDb;

    public function __construct(mysqli $connection) {
        $this->connDb = $connection;
    }

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
}

?>