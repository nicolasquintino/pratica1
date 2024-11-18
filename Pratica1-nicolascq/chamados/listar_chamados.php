<?php
include '../includes/db.php';

$stmt = $pdo->query("SELECT Chamado.*, Cliente.Nome AS cliente_nome FROM Chamado JOIN Cliente ON Chamado.ID_Cliente = Cliente.ID_Cliente");
$chamados = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Lista de Chamados</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1>Lista de Chamados</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Descrição</th>
                <th>Criticidade</th>
                <th>Status</th>
                <th>Data de Abertura</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($chamados as $chamado): ?>
                <tr>
                    <td><?php echo $chamado['ID_Chamado']; ?></td>
                    <td><?php echo $chamado['cliente_nome']; ?></td>
                    <td><?php echo $chamado['Descricao']; ?></td>
                    <td><?php echo $chamado['Criticidade']; ?></td>
                    <td><?php echo $chamado['Status']; ?></td>
                    <td><?php echo $chamado['Data_Abertura']; ?></td>
                    <td>
                        <a href="editar_chamado.php?id=<?php echo $chamado['ID_Chamado']; ?>">Editar</a>
                        <a href="deletar_chamado.php?id=<?php echo $chamado['ID_Chamado']; ?>" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
