<?php

class Asserts {

    public static function equals(mixed $esperado, mixed $atual): void {
        if ($esperado !== $atual) {
            echo "\033[31m✘ FALHOU \033[0m\n";

            echo "  -> Esperado: " . json_encode($esperado) . "\n";
            echo "  -> Recebido: " . json_encode($atual) . "\n\n";

            return;
        }

        echo "\033[32m✔ PASSOU \033[0m\n";
    }
}


?>