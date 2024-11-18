<?php
include '../includes/db.php';

$id = $_GET['id'] ?? null;
if ($id) {
    $stmt = $pdo->prepare("DELETE FROM Cliente WHERE id_cliente = ?");
    if ($stmt->execute([$id])) {
        echo "Cliente excluído com sucesso!";
    } else {
        echo "Erro ao excluir cliente.";
    }
} else {
    echo "ID do cliente não especificado.";
}

header("Location: listar_clientes.php");
exit;
?>
