<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST["nome"]);
    $email = trim($_POST["email"]);
    $telefone = trim($_POST["telefone"]);
    $datanasc = $_POST["datanasc"];
    $genero = $_POST["genero"];
    $mensagem = trim($_POST["mensagem"]);

    if (!$nome || !$email || !$telefone || !$datanasc || !$genero || !$mensagem) {
        die("Todos os campos são obrigatórios!");
    }

    $host = "localhost";
    $usuario = "root";
    $senha = ""; 
    $banco = "inscritos"; 

    $conn = new mysqli($host, $usuario, $senha, $banco);

    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO Inscrito (nome, email, telefone, datanasc, genero, mensagem)
                            VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $nome, $email, $telefone, $datanasc, $genero, $mensagem);

    if ($stmt->execute()) {
        echo "Inscrição feita com sucesso!";
    } else {
        echo "Erro ao inserir: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Acesso inválido.";
}
?>
