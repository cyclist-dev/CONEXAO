<?php
require'../conexao.php';
$id= $_GET['id'];
try{
   $sql="DELETE FROM usuarios WHERE id=:id";
   $smtp = $pdo->prepare($sql);
   $smtp->execute([':id'=>$id]); 
   header("Location: listar.php");
   exit();

}catch(PDOException $e){
   echo "Erro: ".$e->getMessage();
   
}


?>