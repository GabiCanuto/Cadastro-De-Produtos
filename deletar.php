<?php
require_once 'config/Database.php';
require_once 'models/Produto.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: consulta.php?error=ID inválido");
    exit;
}

$database = new Database();
$db = $database->getConnection();
$produto = new Produto($db);

$id = (int) $_GET['id'];

if ($produto->deletar($id)) {
    header("Location: consulta.php?success=Produto excluído");
    exit;
} else {
    header("Location: consulta.php?error=Falha ao excluir");
    exit;
}