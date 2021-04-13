<?php

session_start();

$servername = "localhost";
$usernames = "root";
$passwords = "";
$dbname = "conpresp_db";
// Create connection
$conn= mysqli_connect($servername, $usernames, $passwords, $dbname) or die('Erro ao conectar');
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
      setTimeout("window.location='home.php'", 1800);
    }
    function editfailed() {
      setTimeout("window.location='home.php'", 1800);
    }
    function editarPreenchimento() {
      setTimeout("window.location='editarPreenchimento.php'", 1800);
    }

 </script>

  <?php

if (!mysqli_set_charset($conn, "utf8mb4")) {
    printf("Error loading character set utf8mb4: %s\n", mysqli_error($conn));
    exit();
} else {

  $msg = false;
  $extensao = '';
  $novaExt = '.png';

  if(isset($_FILES['documentacaoGrafica'])) {
    if($_FILES['documentacaoGrafica']['size'] <= 2097152 ){
    $extensao = strtolower(substr($_FILES['documentacaoGrafica']['name'], -4));
    
    if($extensao == '.PNG' || $extensao == '.png' || $extensao == '.JPG' || $extensao == '.jpg' || $extensao == '.JPEG' || $extensao == '.jpeg') {
    $documentacaoGrafica = md5(time()).$novaExt;
    $diretorio = 'imgGrafica/img1/';
    move_uploaded_file($_FILES['documentacaoGrafica']['tmp_name'], $diretorio.$documentacaoGrafica);
    } else {
      $mgsExt = 'Formato de imagem não compatível! O formato deve ser PNG | JPEG | JPG';
      $_SESSION['formatoImagem'] = $mgsExt;
      header('Location: '.$_SERVER['HTTP_REFERER']. '');
    }
  } else {
      $mgsSize = 'Tamanho da imagem maior que o permitido. A imagem pode ser até 2MB!';
      $_SESSION['formatoImagem'] = $mgsSize;
      header('Location: '.$_SERVER['HTTP_REFERER']. '');
  }
  }

  $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

  $result_usuario = "UPDATE imovel SET documentacaoGrafica='$documentacaoGrafica'WHERE id = '$id'";
  
  $resultado_usuario = mysqli_query($conn, $result_usuario);

if (mysqli_query($conn, $result_usuario)) {

    echo "<p style='text-align: center; margin-top: 50px;'>Registro editado com sucesso!</p>";
    echo "<script>editsuccess()</script>";
    
} else {
	echo "Erro ao editar!" . mysqli_error($conn);
    echo "<script>editfailed()</script>";
  }
}
  ?> 
  <div class="d-flex justify-content-center" style="margin-top: 100px;">
    <div class="spinner-border text-primary" style="width: 6rem; height: 6rem;"  role="status" >
      <span class="sr-only">Loading...</span>
    </div>
  </div>
 
</font>
</meta>