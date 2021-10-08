<?php

session_start();
$servername = "db";
$username = "root";
$password = "123";
$dbname = "conpresp_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
<meta charset="UTF-8">
<font face="arial" color="black" size="4">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <script type="text/javascript">
    function deletar() {
      setTimeout("window.location='../home.php'", 3000);
    }

    function deletar2() {
      setTimeout("window.location='logout.php'", 3000);
    }
  </script>
  <?php
  $idInput = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
  $id = $_SESSION['id'];

  if (!empty($id)) {
    $result_usuario = "DELETE FROM users WHERE id='$idInput'";
    $resultado_usuario = mysqli_query($conn, $result_usuario);
    if (mysqli_affected_rows($conn)) {
      if ($id == $idInput) {
        echo "<p style='text-align: center; margin-top: 50px;'>Sua conta foi deletada com sucesso. Aguarde um instante para realizar login novamente! </p>";
        echo "<script>deletar2()</script>";
      } else {
        echo "<p style='text-align: center; margin-top: 50px;'>Conta deletada com sucesso. Aguarde um instante!</p>";
        echo "<script>deletar()</script>";
      }
    } else {
      echo "Erro ao deletar! Por favor entrar em contato com o administrador de sistemas!" . mysqli_error($conn);
    }
  }

  ?>

  <div class="d-flex justify-content-center" style="margin-top: 100px;">
    <div class="spinner-border text-primary" style="width: 6rem; height: 6rem;" role="status">
      <span class="sr-only">Loading...</span>
    </div>
  </div>