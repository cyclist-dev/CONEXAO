<?php
// Define o endereço do servidor onde está o banco de dados (geralmente localhost)
$host = "localhost";

// Define o nome do banco de dados que será acessado
$banco = "biblioteca";

// Define o nome de usuário usado para entrar no banco (padrão do XAMPP é "root")
$usuario = "root";

// Define a senha do usuário do banco (padrão do XAMPP é vazio "")
$senha = "";

try {
    // Cria uma conexão com o banco usando PDO
    // "mysql:host=$host;dbname=$banco;charset=utf8" informa onde está o banco e qual banco usar
    // $usuario e $senha são usados como login do banco
    $pdo = new PDO("mysql:host=$host;dbname=$banco;charset=utf8", $usuario, $senha);

    // Define que, se acontecer algum erro na conexão ou nas consultas, o PDO vai mostrar uma mensagem de erro
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {

    // Caso dê algum erro ao conectar, o sistema para e mostra a mensagem do erro
    die("Erro ao conectar: " . $e->getMessage());
}
?>
