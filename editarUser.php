<?php
session_start();

$servername = "db";
$usernames = "root";
$passwords = "";
$dbname = "conpresp_db";
// Create connection
$conn = mysqli_connect($servername, $usernames, $passwords, $dbname) or die('Erro ao conectar');
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>

<meta charset="UTF-8">
<font face="arial" color="black" size="4">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script type="text/javascript">
    function editsuccess() {
      setTimeout("window.location='logout.php'", 1800);
    }

    function successedit() {
      setTimeout("window.location='../usuarios.php'", 1800);
    }
  </script>

  <?php

  $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
  $perfil = filter_input(INPUT_POST, 'perfil', FILTER_SANITIZE_STRING);
  $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
  $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
  $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
  $idd = $_SESSION['id'];

  $result_usuario = "UPDATE users SET username='$username', perfil='$perfil', username='$username', email='$email', status='$status' WHERE id = '$id'";
  $resultado_usuario = mysqli_query($conn, $result_usuario);

  if (mysqli_query($conn, $result_usuario)) {

    if ($id == $idd) {
      echo "<p style='text-align: center; margin-top: 50px;'>Seu cadastro foi editado com sucesso! Aguarde um instante para realizar login novamente...</p>";
      echo "<script>editsuccess()</script>";
    } else {
      echo "<p style='text-align: center; margin-top: 50px;'>Cadastro do usuário editado com sucesso! Aguarde um instante...</p>";
      echo "<script>successedit()</script>";
    }
  } else {
    echo "Erro ao editar!" . mysqli_error($conn);
  }
  ?>
  <div class="d-flex justify-content-center" style="margin-top: 100px;">
    <div class="spinner-border text-primary" style="width: 6rem; height: 6rem;" role="status">
      <span class="sr-only">Loading...</span>
    </div>
  </div>

</font>
</meta>