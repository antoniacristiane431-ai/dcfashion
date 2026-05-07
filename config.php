<?php
// Configuração de conexão com MySQL
$host = 'localhost';
$usuario = 'root'; // Altere conforme seu usuário MySQL
$senha = ''; // Altere conforme sua senha MySQL
$banco = 'dcfashion';

// Criar conexão
$conexao = new mysqli($host, $usuario, $senha, $banco);

// Verificar conexão
if ($conexao->connect_error) {
    die(json_encode(['erro' => 'Conexão falhou: ' . $conexao->connect_error]));
}

// Configurar charset
$conexao->set_charset("utf8");

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');
?>
