<?php
session_start();

$pesquisa = $_POST['pesquisa'];
$_SESSION['pesquisa'] = $pesquisa;
?>

<meta charset="UTF-8">
<font face="arial" color="black" size="4">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


  <script type="text/javascript">
    function success() {
      setTimeout("window.location='pesquisa.php'", 500);
    }
  </script>

<script type="text/javascript">
    function success2() {
      setTimeout("window.location='usuarios.php'", 500);
    }
  </script>

  <?php
    if($pesquisa != ""){
    echo "<p style='text-align: center; margin-top: 50px;'>Pesquisando!</p>";
    echo "<script>success()</script>";
    }
    else {
        echo "<p style='text-align: center; margin-top: 50px;'>Pesquisando!</p>";
        echo "<script>success2()</script>";  
    }
  ?> 
  <div class="d-flex justify-content-center" style="margin-top: 100px;">
    <div class="spinner-border text-primary" style="width: 6rem; height: 6rem;"  role="status" >
      <span class="sr-only">Loading...</span>
    </div>
  </div>
 
</font>
</meta>