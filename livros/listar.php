<?php
require '../conexao.php';
$sql="SELECT * FROM livros";
$stmt = $pdo->query($sql);
$livros = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Lista de Livros</title>
<link rel="stylesheet" href="../style.css">
 
 
</head>
<body>
 
<div class="lista-container">
    <h1>Lista de Livros</h1>
 
    <!-- BOTÃO VOLTAR -->
    <a class="btn-voltar" href="../painel.php">Voltar para o Painel</a>
 
    <table class="tabela-usuarios">
        <thead>
            <tr>
                <th>ID</th>
                <th>Imagem</th>
                <th>Título</th>
                <th>Autor</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
 
        <tbody>
            <?php foreach ($livros as $l): ?>
            <tr>
                <td><?= $l['id'] ?></td>
 
                <td>
                    <?php if($l['imagem']): ?>
                        <img src="../imagens/<?= $l['imagem'] ?>" class="capa">
                    <?php else: ?>
                        Sem imagem
                    <?php endif; ?>
                </td>
 
                <td><?= $l['titulo'] ?></td>
                <td><?= $l['autor'] ?></td>
 
                <td>
                    <?= $l['disponivel'] ? 'Disponível' : 'Alugado' ?>
                </td>
 
                <td>
                    <a class="btn-editar" href="editar.php?id=<?= $l['id'] ?>">Editar</a>
                    <a class="btn-excluir" href="excluir.php?id=<?= $l['id'] ?>" onclick="return confirm('Deseja realmente excluir este livro?')">Excluir</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
 
</body>
</html>