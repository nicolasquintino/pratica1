<?php
require '../conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['ID_Cliente']) && !empty($_POST['Descricao']) && !empty($_POST['id-categoria']) && !empty($_POST['id_prioridade'])) {
        try {
            $stmt = $pdo->prepare("INSERT INTO Chamados (ID_Cliente, Descricao, id-categoria, id_prioridade, id_status, data_abertura, id_colaborador) 
                                   VALUES (:ID_Cliente, :Descricao, :id-categoria, :id_prioridade, :id_status, :Data_Abertura, :ID_Colaborador)");
            $stmt->bindParam(':ID_Cliente', $_POST['ID_Cliente']);
            $stmt->bindParam(':Descricao', $_POST['Descricao']);
            $stmt->bindParam(':id-categoria', $_POST['id-categoria']);
            $stmt->bindParam(':id_prioridade', $_POST['id_prioridade']);
            $stmt->bindParam(':id_status', $_POST['id_status']);
            $stmt->bindParam(':Data_Abertura', date("Y-m-d H:i:s")); 

            if (!empty($_POST['ID_Colaborador'])) {
                $stmt->bindParam(':ID_Colaborador', $_POST['ID_Colaborador']);
            } else {
                $stmt->bindValue(':ID_Colaborador', null, PDO::PARAM_NULL);
            }

            $stmt->execute();

            echo "Chamado cadastrado com sucesso!";
        } catch (PDOException $e) {
            echo "Erro ao cadastrar chamado: " . $e->getMessage();
        }
    } else {
        echo "Por favor, preencha todos os campos obrigatórios.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Chamado</title>
</head>
<body>
    <h1>Cadastro de Chamado</h1>
    <form action="cadastro_chamado.php" method="post">
        <label for="ID_Cliente">Cliente:</label>
        <input type="number" id="ID_Cliente" name="ID_Cliente" required><br>

        <label for="Descricao">Descrição:</label>
        <textarea id="Descricao" name="Descricao" required></textarea><br>

        <label for="id-categoria">Categoria:</label>
        <select id="id-categoria" name="id-categoria" required>
            <?php
            // Busca as categorias no banco
            $categoriaStmt = $pdo->query("SELECT id-categoria, Descricao FROM Categoria");
            while ($categoria = $categoriaStmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='" . $categoria['id-categoria'] . "'>" . $categoria['Descricao'] . "</option>";
            }
            ?>
        </select><br>

        <label for="id_prioridade">Prioridade:</label>
        <select id="id_prioridade" name="id_prioridade" required>
            <?php
            // Busca as prioridades no banco
            $prioridadeStmt = $pdo->query("SELECT id_prioridade, Descricao FROM Prioridade");
            while ($prioridade = $prioridadeStmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='" . $prioridade['id_prioridade'] . "'>" .
