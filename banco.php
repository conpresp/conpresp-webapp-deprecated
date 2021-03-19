<?php
 $conexao = mysqli_connect("localhost","root", "");

$host = "localhost";
$usuario = "root";
$senha = "";
$bd = "conpresp_db";

$mysqli = mysqli_connect($host, $usuario,$senha, $bd);

if($mysqli-> connect_errno)
 echo "Falha na conexao: (".$mysqli->connect_errno.") ".$mysqli->connect_errno;
 mysqli_close($conexao);
?>