# DC Fashion - Integração com MySQL

## Arquivos Criados

1. **database.sql** - Script para criar o banco de dados e tabelas no MySQL
2. **config.php** - Arquivo de configuração de conexão com MySQL
3. **api.php** - API REST para comunicação entre o front-end e o banco de dados
4. **index_mysql.html** - Versão atualizada do HTML que usa o MySQL

## Instalação e Configuração

### 1. Criar o Banco de Dados

Abra o MySQL Workbench ou phpMyAdmin e execute o arquivo `database.sql`:

```bash
mysql -u root -p < database.sql
```

Ou copie e cole o conteúdo do arquivo `database.sql` no seu gerenciador MySQL.

### 2. Configurar a Conexão (config.php)

Abra o arquivo `config.php` e altere as credenciais:

```php
$host = 'localhost';      // Endereço do MySQL
$usuario = 'root';        // Seu usuário MySQL
$senha = '';              // Sua senha MySQL
$banco = 'dcfashion';     // Nome do banco
```

### 3. Configurar o Servidor Web

Você precisa de um servidor PHP rodando (Apache, Nginx, etc.).

**Opção A: Usar PHP Built-in**
```bash
cd c:\Users\crist\OneDrive\Documentos\Desktop\dcfashion
php -S localhost:8000
```

Acesse: `http://localhost:8000/index_mysql.html`

**Opção B: Usar XAMPP/WAMP**
- Coloque a pasta `dcfashion` em `C:\xampp\htdocs\`
- Inicie Apache e MySQL no XAMPP Control Panel
- Acesse: `http://localhost/dcfashion/index_mysql.html`

## Estrutura do Banco de Dados

### Tabelas Criadas:

1. **produtos** - Armazena os produtos
   - id, nome, categoria, preco, img, iframe

2. **clientes** - Armazena clientes que se cadastram
   - id, nome, email, cadastrado_em

3. **pedidos** - Armazena os pedidos realizados
   - id, cliente_id, total, status, criado_em

4. **itens_pedido** - Itens de cada pedido
   - id, pedido_id, produto_id, quantidade, preco_unitario

## Endpoints da API (api.php)

### Listar Produtos
```
GET /api.php?acao=listar_produtos
GET /api.php?acao=listar_produtos&categoria=blusa
```

### Cadastrar Cliente
```
POST /api.php?acao=cadastrar_cliente
Parâmetros: nome, email
```

### Criar Pedido
```
POST /api.php?acao=criar_pedido
Parâmetros: cliente_id, itens (JSON), total
```

### Listar Pedidos
```
GET /api.php?acao=listar_pedidos
GET /api.php?acao=listar_pedidos&cliente_id=1
```

## Funcionalidades

✅ Carregar produtos do MySQL
✅ Filtrar por categoria
✅ Adicionar/remover itens do carrinho
✅ Cadastrar cliente
✅ Criar pedidos
✅ Armazenar histórico de compras

## Notas de Segurança

⚠️ Use `$conexao->real_escape_string()` ou Prepared Statements para evitar SQL Injection
⚠️ Valide todos os inputs no servidor
⚠️ Nunca armazene senhas em texto plano
⚠️ Use HTTPS em produção

Está tudo pronto! 🚀
