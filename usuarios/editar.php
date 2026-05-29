<?php
require '../conexao.php';
if (!isset($_GET['id']) || empty($_GET['id'])) {

    header("Location: listar.php");
    exit;
}
$id = intval($_GET['id']);
$sql = "SELECT * FROM usuarios WHERE id=:id LIMIT 1";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $id]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$usuario) {
    header("Location: listar.php");
    exit;
}
$mensagem = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $tipo = trim($_POST['tipo']);
    if (!empty($_POST['senha'])) {
        $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
        $sql = "UPDATE usuarios SET nome =:nome, email = :email, senha = :senha,
        tipo = :tipo WHERE id = :id";
        $params = [
            ':nome' => $nome,
            ':email' => $email,
            ':senha' => $senha,
            ':tipo' => $tipo,
            ':id' => $id
        ];
    } else {
        $sql = "UPDATE usuarios SET nome = :nome, email = :email, tipo = :tipo
        WHERE id = :id";
        $params = [
            ':nome' => $nome,
            ':email' => $email,
            ':tipo' => $tipo,
            ':id' => $id
        ];
    }
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        header("Location: listar.php");
        exit;
    } catch (PDOException $e) {
        $mensagem = "<p class='erro'>Erro ao atualizar: " . $e->getMessage() . "<p>";
    }

}


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Editar Usuário</title>
<link rel="stylesheet" href="../style.css">
</head>
<body>
 
<div class="card-editar">
    <h1>Editar Usuário</h1>
 
    <?= $mensagem ?>
 
    <form method="POST">
 
        <div class="input-group">
            <label>Nome</label>
            <input type="text" name="nome" value="<?= $usuario['nome'] ?>" required>
        </div>
 
        <div class="input-group">
            <label>Email</label>
            <input type="email" name="email" value="<?= $usuario['email'] ?>" required>
        </div>
 
        <div class="input-group">
            <label>Nova Senha <small>(opcional)</small></label>
            <input type="password" name="senha" placeholder="Deixe em branco para não alterar">
        </div>
 
        <div class="input-group">
            <label>Tipo</label>
            <select name="tipo" required>
                <option value="admin" <?= $usuario['tipo'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                <option value="aluno" <?= $usuario['tipo'] == 'aluno' ? 'selected' : '' ?>>Aluno</option>
            </select>
        </div>
 
        <button type="submit" class="btn">Salvar Alterações</button>
        <a href="listar.php" class="btn-voltar">Voltar</a>
 
    </form>
</div>
 
</body>
</html>
