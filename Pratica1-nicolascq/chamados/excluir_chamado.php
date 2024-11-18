<?php
include '../includes/db.php';

$id = $_GET['id'] ?? null;
if ($id) {
    $stmt = $pdo->prepare("DELETE FROM Chamado WHERE id_chamado = ?");
    if ($stmt->execute([$id])) {
        echo "Chamado excluído com sucesso!";
    } else {
        echo "Erro ao excluir chamado.";
    }
} else {
    echo "ID do chamado não especificado.";
}

header("Location: listar_chamados.php");
exit;
?>
