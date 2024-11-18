<?php
include '../includes/db.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    echo "ID do chamado não especificado.";
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM Chamado WHERE id_chamado = ?");
$stmt->execute([$id]);
$chamado = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $descricao = $_POST['descricao'];
    $criticidade = $_POST['criticidade'];
    $status = $_POST['status'];
    $id_colaborador = $_POST['id_colaborador'] ?? null;

    $stmt = $pdo->prepare("UPDATE chamado SET descricao = ?, criticidade = ?, Status = ?, id_colaborador = ? WHERE id_chamado = ?");
    if ($stmt->execute([$descricao, $criticidade, $status, $id_colaborador, $id])) {
        echo "Chamado atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar chamado.";
    }
}

$colaboradores = $pdo->query("SELECT * FROM Colaborador")->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Chamado</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1>Editar Chamado</h1>
    <form action="editar_chamado.php?id=<?php echo $id; ?>" method="POST">
        <label>Descrição:</label>
        <textarea name="descricao" required><?php echo $chamado['Descricao']; ?></textarea>
        <label>Criticidade:</label>
        <select name="criticidade">
            <option value="baixa" <?php if ($chamado['Criticidade'] === 'baixa') echo 'selected'; ?>>Baixa</option>
            <option value="média" <?php if ($chamado['Criticidade'] === 'média') echo 'selected'; ?>>Média</option>
            <option value="alta" <?php if ($chamado['Criticidade'] === 'alta') echo 'selected'; ?>>Alta</option>
        </select>
        <label>Status:</label>
        <select name="status">
            <option value="aberto" <?php if ($chamado['Status'] === 'aberto') echo 'selected'; ?>>Aberto</option>
            <option value="em andamento" <?php if ($chamado['Status'] === 'em andamento') echo 'selected'; ?>>Em andamento</option>
            <option value="resolvido" <?php if ($chamado['Status'] === 'resolvido') echo 'selected'; ?>>Resolvido</option>
        </select>
        <label>Colaborador Responsável:</label>
        <select name="id_colaborador">
            <option value="">Nenhum</option>
            <?php foreach ($colaboradores as $colaborador): ?>
                <option value="<?php echo $colaborador['ID_Colaborador']; ?>" <?php if ($chamado['ID_Colaborador'] == $colaborador['ID_Colaborador']) echo 'selected'; ?>>
                    <?php echo $colaborador['Nome']; ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Atualizar</button>
    </form>
</body>
</html>
