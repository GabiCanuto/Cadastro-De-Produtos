<?php
class Produto {
    private $conn;
    private $table = "produtos";

    public $id;
    public $nome;
    public $descricao;
    public $preco;
    public $quantidade;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Criar produto
    public function criar() {
        $query = "INSERT INTO {$this->table} (nome, descricao, preco, quantidade)
                  VALUES (:nome, :descricao, :preco, :quantidade)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":descricao", $this->descricao);
        $stmt->bindParam(":preco", $this->preco);
        $stmt->bindParam(":quantidade", $this->quantidade);
        return $stmt->execute();
    }

    // Listar todos
    public function listar() {
        $query = "SELECT * FROM {$this->table} ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Buscar 1 por ID
    public function buscarPorId($id) {
        $query = "SELECT * FROM {$this->table} WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Atualizar
    public function atualizar() {
        $query = "UPDATE {$this->table}
                  SET nome = :nome, descricao = :descricao, preco = :preco, quantidade = :quantidade
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":descricao", $this->descricao);
        $stmt->bindParam(":preco", $this->preco);
        $stmt->bindParam(":quantidade", $this->quantidade);
        $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Deletar
    public function deletar($id) {
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Buscar por termo (nome ou descrição) - usado em procurar.php
    public function buscar($termo) {
        $like = '%' . $termo . '%';
        $query = "SELECT * FROM {$this->table}
                  WHERE nome LIKE :termo OR descricao LIKE :termo
                  ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':termo', $like, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt;
    }
}
// Não use o ?> no final do arquivo para evitar espaços em branco indesejados