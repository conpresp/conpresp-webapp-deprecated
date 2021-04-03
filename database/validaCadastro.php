<?php
 session_start();
 $host = "localhost";
$usuario = "root";
$senha = "";
$bd = "conpresp_db";

$mysqli = mysqli_connect($host, $usuario,$senha, $bd);

if($mysqli-> connect_errno)
 echo "Falha na conexao: (".$mysqli->connect_errno.") ".$mysqli->connect_errno;
 mysqli_close($mysqli);
?>

<meta charset="UTF-8">
<font face="arial" color="black" size="4">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<script type="text/javascript">

function cadastrosuccess(){
    setTimeout("window.location='../usuarios.php'", 1800);
}

function cadastrofailed(){
    setTimeout("window.location='../index.php?modulo=Conpresp&acao=cadastro'", 1800);
}
</script>

<?php


$conecta = mysqli_connect($host, $usuario, $senha, $bd) or die ('Erro ao conectar');

mysqli_select_db($conecta, $bd) or print(mysqli_error($conecta));
if (!mysqli_set_charset($conecta, "utf8mb4")) {
  printf("Error loading character set utf8mb4: %s\n", mysqli_error($conecta));
  exit();
} else {

  $perfil = filter_input(INPUT_POST, 'perfil', FILTER_SANITIZE_STRING);
  $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
  $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
  $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
  $password = md5(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));

$sql = "SELECT * from users where email='$email'";

$result = mysqli_query($conecta, $sql) or die ('Erro ao conectar2');
$row=mysqli_num_rows($result);

if($row>0){
    while($consulta = mysqli_fetch_array($result)){
  }
  echo "<p style='text-align: center; margin-top: 50px;'>E-mail já em uso! Aguarde um instante...</p>";
  echo "<script>cadastrofailed()</script>";}
  else {
    $sql2 ="INSERT into users(perfil,username,email,status,password) values";
    $sql2 .=  "('$perfil','$username','$email','$status', '$password')";
    if ($conecta->query($sql2) === TRUE) {
        echo "";
      } else {
        echo "Error: " . $sql2 . "<br>" . $conecta->error;
      }
    echo "<p style='text-align: center; margin-top: 50px;'>Usuário cadastrado com sucesso! Aguarde um instante...</p>";
    echo "<script>cadastrosuccess()</script>";}
    mysqli_close($conecta);
    }
?>
<div class="d-flex justify-content-center" style="margin-top: 100px;">
    <div class="spinner-border text-primary" style="width: 6rem; height: 6rem;"  role="status" >
      <span class="sr-only">Loading...</span>
    </div>
  </div>

  </font>
  </meta>