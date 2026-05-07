<?php
include 'config.php';

$acao = $_GET['acao'] ?? '';

// PRODUTOS
if ($acao == 'listar_produtos') {
    $categoria = $_GET['categoria'] ?? 'todos';
    
    if ($categoria === 'todos') {
        $sql = "SELECT * FROM produtos";
    } else {
        $sql = "SELECT * FROM produtos WHERE categoria = '" . $conexao->real_escape_string($categoria) . "'";
    }
    
    $resultado = $conexao->query($sql);
    $produtos = [];
    
    while ($linha = $resultado->fetch_assoc()) {
        $produtos[] = $linha;
    }
    
    echo json_encode($produtos);
}

// CADASTRAR CLIENTE
else if ($acao == 'cadastrar_cliente') {
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    
    if (empty($nome) || empty($email)) {
        echo json_encode(['erro' => 'Nome e email são obrigatórios']);
        exit;
    }
    
    $nome = $conexao->real_escape_string($nome);
    $email = $conexao->real_escape_string($email);
    
    $sql = "INSERT INTO clientes (nome, email) VALUES ('$nome', '$email')";
    
    if ($conexao->query($sql)) {
        echo json_encode(['sucesso' => true, 'id' => $conexao->insert_id]);
    } else {
        echo json_encode(['erro' => $conexao->error]);
    }
}

// CRIAR PEDIDO
else if ($acao == 'criar_pedido') {
    $cliente_id = $_POST['cliente_id'] ?? '';
    $itens = json_decode($_POST['itens'], true) ?? [];
    $total = $_POST['total'] ?? 0;
    
    if (empty($cliente_id) || empty($itens)) {
        echo json_encode(['erro' => 'Dados inválidos']);
        exit;
    }
    
    // Inserir pedido
    $sql = "INSERT INTO pedidos (cliente_id, total, status) VALUES ($cliente_id, $total, 'confirmado')";
    
    if ($conexao->query($sql)) {
        $pedido_id = $conexao->insert_id;
        
        // Inserir itens do pedido
        foreach ($itens as $item) {
            $produto_id = $item['id'];
            $quantidade = $item['quantidade'] ?? 1;
            $preco = $item['preco'];
            
            $sql_item = "INSERT INTO itens_pedido (pedido_id, produto_id, quantidade, preco_unitario) 
                        VALUES ($pedido_id, $produto_id, $quantidade, $preco)";
            $conexao->query($sql_item);
        }
        
        echo json_encode(['sucesso' => true, 'pedido_id' => $pedido_id]);
    } else {
        echo json_encode(['erro' => $conexao->error]);
    }
}

// LISTAR PEDIDOS
else if ($acao == 'listar_pedidos') {
    $cliente_id = $_GET['cliente_id'] ?? '';
    
    $sql = "SELECT p.*, c.nome FROM pedidos p 
            JOIN clientes c ON p.cliente_id = c.id";
    
    if ($cliente_id) {
        $sql .= " WHERE p.cliente_id = $cliente_id";
    }
    
    $resultado = $conexao->query($sql);
    $pedidos = [];
    
    while ($linha = $resultado->fetch_assoc()) {
        $pedidos[] = $linha;
    }
    
    echo json_encode($pedidos);
}

else {
    echo json_encode(['erro' => 'Ação não definida']);
}

$conexao->close();
?>
