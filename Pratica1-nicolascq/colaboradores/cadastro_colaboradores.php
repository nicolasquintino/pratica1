<?php
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $cargo = $_POST['cargo'];

    $stmt = $pdo->prepare("INSERT INTO Colaborador (nome, cargo) VALUES (?, ?)");
    if ($stmt->execute([$nome, $cargo])) {
        echo "Colaborador cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar colaborador.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Colaborador</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1>Cadastro de Colaborador</h1>
    <form action="cadastro_colaborador.php" method="POST">
        <label>Nome:</label>
        <input type="text" name="nome" required>
        <label>Cargo:</label>
        <input type="text" name="cargo" required>
        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>
