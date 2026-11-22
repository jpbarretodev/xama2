<?php

//TODO: inserir a rota de update dos dados do protocolo

//TODO: inserir as rotas de administrador

return [
    
    'POST /protocolo' => ['apiProtocolo', 'cadastrar'],

    'PUT /protocolo/setCustas' => ['apiProtocolo', 'setCustas'],
    'PUT /protocolo/setPagamento' => ['apiProtocolo', 'setPagamento'],

    'GET /protocolo/buscar' => ['apiProtocolo', 'buscar'],
    'GET /protocolo/buscar/situacao' => ['apiProtocolo', 'buscarSituacao'],
    'GET /protocolo/buscar/todos' => ['apiProtocolo', 'buscarTodos'],

]

?>