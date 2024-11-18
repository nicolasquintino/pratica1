<?php
include '../includes/db.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    echo "ID do cliente não especificado.";
    exit;
}

// Obtém o cliente atual para exibir no formulário
$stmt = $pdo->prepare("SELECT * FROM Cliente WHERE ID_Cliente = ?");
$stmt->execute([$id]);
$cliente = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

    $stmt = $pdo->prepare("UPDATE Cliente SET Nome = ?, Email = ?, Telefone = ? WHERE ID_Cliente = ?");
    if ($stmt->execute([$nome, $email, $telefone, $id])) {
        echo "Cliente atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar cliente.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1>Editar Cliente</h1>
    <form action="editar_cliente.php?id=<?php echo $id; ?>" method="POST">
        <label>Nome:</label>
        <input type="text" name="nome" value="<?php echo $cliente['nome']; ?>" required>
        <label>Email:</label>
        <input type="email" name="email" value="<?php echo $cliente['email']; ?>" required>
        <label>Telefone:</label>
        <input type="text" name="telefone" value="<?php echo $cliente['telefone']; ?>">
        <button type="submit">Atualizar</button>
    </form>
</body>
</html>
