<?php
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

    $stmt = $pdo->prepare("INSERT INTO Cliente (nome, email, telefone) VALUES (?, ?, ?)");
    if ($stmt->execute([$nome, $email, $telefone])) {
        echo "Cliente cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar cliente.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Cliente</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1>Cadastro de Cliente</h1>
    <form action="cadastro_cliente.php" method="POST">
        <label>Nome:</label>
        <input type="text" name="nome" required>
        <label>Email:</label>
        <input type="email" name="email" required>
        <label>Telefone:</label>
        <input type="tel" name="telefone">
        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>
