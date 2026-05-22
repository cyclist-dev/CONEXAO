<?php
require'../conexao.php';
$id=$GET['id'];
try{
   $sql="DELETE FROM usuarios WHERE id=:id";
   $smtp = $pdo->prepare($sql);
   $smtp->execute([':id'=>$id]); 
}


?>