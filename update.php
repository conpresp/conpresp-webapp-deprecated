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


  $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
  $responsavelPreenchimento = filter_input(INPUT_POST, 'responsavelPreenchimento', FILTER_SANITIZE_STRING);
  $grupoTipoEquipe = filter_input(INPUT_POST, 'grupoTipoEquipe', FILTER_SANITIZE_STRING);
  $itemResolucao = filter_input(INPUT_POST, 'itemResolucao', FILTER_SANITIZE_STRING);
  $denominacao = filter_input(INPUT_POST, 'denominacao', FILTER_SANITIZE_STRING);
  $classificacao = filter_input(INPUT_POST, 'classificacao', FILTER_SANITIZE_STRING);
  $usoAtual = filter_input(INPUT_POST, 'usoAtual', FILTER_SANITIZE_STRING);
  $propriedade = filter_input(INPUT_POST, 'propriedade', FILTER_SANITIZE_STRING);
  $terreo = filter_input(INPUT_POST, 'terreo', FILTER_SANITIZE_STRING);
  $resolucaoTombamento = filter_input(INPUT_POST, 'resolucaoTombamento', FILTER_SANITIZE_STRING);
  $resolucaoCondephaat = filter_input(INPUT_POST, 'resolucaoCondephaat', FILTER_SANITIZE_STRING);
  $resolucaoIphan = filter_input(INPUT_POST, 'resolucaoIphan', FILTER_SANITIZE_STRING);
  $tipo = filter_input(INPUT_POST, 'tipo', FILTER_SANITIZE_STRING);
  $titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRING);
  $logradouro = filter_input(INPUT_POST, 'logradouro', FILTER_SANITIZE_STRING);
  $numeroEndereco = filter_input(INPUT_POST, 'numeroEndereco', FILTER_SANITIZE_STRING);
  $distrito = filter_input(INPUT_POST, 'distrito', FILTER_SANITIZE_STRING);
  $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
  $prefeituraRegional = filter_input(INPUT_POST, 'prefeituraRegional', FILTER_SANITIZE_STRING);
  $setor = filter_input(INPUT_POST, 'setor', FILTER_SANITIZE_STRING);
  $quadra = filter_input(INPUT_POST, 'quadra', FILTER_SANITIZE_STRING);
  $lote = filter_input(INPUT_POST, 'lote', FILTER_SANITIZE_STRING);
  $autorOriginal = filter_input(INPUT_POST, 'autorOriginal', FILTER_SANITIZE_STRING);
  $construtor = filter_input(INPUT_POST, 'construtor', FILTER_SANITIZE_STRING);
  $dataConstrucao = filter_input(INPUT_POST, 'dataConstrucao', FILTER_SANITIZE_STRING);
  $estiloArquitetonico = filter_input(INPUT_POST, '	estiloArquitetonico', FILTER_SANITIZE_STRING);
  $tecnicaConstrutiva = filter_input(INPUT_POST, 'tecnicaConstrutiva', FILTER_SANITIZE_STRING);
  $numeroPavimentos = filter_input(INPUT_POST, 'numeroPavimentos', FILTER_SANITIZE_STRING);
  $areaLote = filter_input(INPUT_POST, 'areaLote', FILTER_SANITIZE_STRING);
  $areaConstruida = filter_input(INPUT_POST, 'areaConstruida', FILTER_SANITIZE_STRING);
  $grauTombamento = filter_input(INPUT_POST, 'grauTombamento', FILTER_SANITIZE_STRING);
  $grauAlteracao = filter_input(INPUT_POST, 'grauAlteracao', FILTER_SANITIZE_STRING);
  $comentarioGrauAlteracao = filter_input(INPUT_POST, 'comentarioGrauAlteracao', FILTER_SANITIZE_STRING);
  $grauEstadoConservacao = filter_input(INPUT_POST, 'grauEstadoConservacao', FILTER_SANITIZE_STRING);
  $comentarioEstadoConservacao = filter_input(INPUT_POST, 'comentarioEstadoConservacao', FILTER_SANITIZE_STRING);
  $observacoesPavimentos = filter_input(INPUT_POST, 'observacoesPavimentos', FILTER_SANITIZE_STRING);
  $dadosHistoricos = filter_input(INPUT_POST, 'dadosHistoricos', FILTER_SANITIZE_STRING);
  $dadosArquitetonicos = filter_input(INPUT_POST, 'dadosArquitetonicos', FILTER_SANITIZE_STRING);
  $dadosAmbiencia = filter_input(INPUT_POST, 'dadosAmbiencia', FILTER_SANITIZE_STRING);
  $fontesBibliograficas = filter_input(INPUT_POST, 'fontesBibliograficas', FILTER_SANITIZE_STRING);
  $outrasInformacoes= filter_input(INPUT_POST, 'outrasInformacoes', FILTER_SANITIZE_STRING);
  $observacoes = filter_input(INPUT_POST, 'observacoes', FILTER_SANITIZE_STRING);
  $documentacaoFotografica = null;
  $documentacaoFotografica2 = null;
  $documentacaoFotografica3 = null;
  $documentacaoGrafica = null;
  $documentacaoGrafica2 = null;
  $documentacaoGrafica3 = null;

  $msg = false;
  $extensao = '';
  $novaExt = '.png';

  $selectUpdate = "SELECT documentacaoFotografica, documentacaoFotografica2, documentacaoFotografica3, documentacaoGrafica, documentacaoGrafica2, documentacaoGrafica3 from imovel where id = '$id' ";
  $resultSelect = mysqli_query($conn, $selectUpdate);

  while($dados = mysqli_fetch_assoc($resultSelect)) {   
  if (isset($_FILES['documentacaoFotografica'])) {
    if ($_FILES['documentacaoFotografica']['size'] <= 3145728  ) {
      $extensao = strtolower(substr($_FILES['documentacaoFotografica']['name'], -4));
     
      if ($extensao == '.PNG' || $extensao == '.png' || $extensao == '.JPG' || $extensao == '.jpg' || $extensao == '.JPEG' || $extensao == '.jpeg') {
        $documentacaoFotografica = $_FILES['documentacaoFotografica']['name'];
        $diretorio = 'imgFotografica/img1/';
        
        move_uploaded_file($_FILES['documentacaoFotografica']['tmp_name'], $diretorio . $documentacaoFotografica);
   
      } else if (!$extensao || $extensao = ''){
        $documentacaoFotografica = $dados['documentacaoFotografica'];
      }else {
        $mgsExt = 'Uma ou mais imagens está com formato não compatível! O formato deve ser PNG | JPEG | JPG';
        $_SESSION['formatoImagem'] = $mgsExt;
        header('Location: ' . $_SERVER['HTTP_REFERER'] . '');
        mysqli_close($conn);
      }
    } else {
      $mgsSize = 'Uma ou mais imagens está com o tamanho maior que o permitido. A imagem pode ser até 2MB!';
      $_SESSION['formatoImagem'] = $mgsSize;
      header('Location: ' . $_SERVER['HTTP_REFERER'] . '');
      mysqli_close($conn);
    } 
  }else if(!isset($_FILES['documentacaoFotografica'])){
    $documentacaoFotografica = null;
  }

  if (isset($_FILES['documentacaoFotografica2'])) {
    if ($_FILES['documentacaoFotografica2']['size'] <= 3145728  ) {
      $extensao = strtolower(substr($_FILES['documentacaoFotografica2']['name'], -4));
     
      if ($extensao == '.PNG' || $extensao == '.png' || $extensao == '.JPG' || $extensao == '.jpg' || $extensao == '.JPEG' || $extensao == '.jpeg') {
        $documentacaoFotografica2 = $_FILES['documentacaoFotografica2']['name'];
        $diretorio2 = 'imgFotografica/img2/';
        
        move_uploaded_file($_FILES['documentacaoFotografica2']['tmp_name'], $diretorio2 . $documentacaoFotografica2);
   
      }else if (!$extensao || $extensao = ''){
        $documentacaoFotografica2 =  $dados['documentacaoFotografica2'];
      }else {
        $mgsExt = 'Uma ou mais imagens está com formato não compatível! O formato deve ser PNG | JPEG | JPG';
        $_SESSION['formatoImagem'] = $mgsExt;
        header('Location: ' . $_SERVER['HTTP_REFERER'] . '');
        mysqli_close($conn);
      }
    } else {
      $mgsSize = 'Uma ou mais imagens está com o tamanho maior que o permitido. A imagem pode ser até 2MB!';
      $_SESSION['formatoImagem'] = $mgsSize;
      header('Location: ' . $_SERVER['HTTP_REFERER'] . '');
      mysqli_close($conn);
    }
  } else if(!isset($_FILES['documentacaoFotografica2'])){
    $documentacaoFotografica2 = null;
  }

  if (isset($_FILES['documentacaoFotografica3'])) {
    if ($_FILES['documentacaoFotografica3']['size'] <= 3145728  ) {
      $extensao = strtolower(substr($_FILES['documentacaoFotografica3']['name'], -4));
     
      if ($extensao == '.PNG' || $extensao == '.png' || $extensao == '.JPG' || $extensao == '.jpg' || $extensao == '.JPEG' || $extensao == '.jpeg') {
        $documentacaoFotografica3 = $_FILES['documentacaoFotografica3']['name'];
        $diretorio3 = 'imgFotografica/img3/';
        
        move_uploaded_file($_FILES['documentacaoFotografica3']['tmp_name'], $diretorio3 . $documentacaoFotografica3);
   
      } else if (!$extensao || $extensao = ''){
        $documentacaoFotografica3 =  $dados['documentacaoFotografica3'];
      }else {
        $mgsExt = 'Uma ou mais imagens está com formato não compatível! O formato deve ser PNG | JPEG | JPG';
        $_SESSION['formatoImagem'] = $mgsExt;
        header('Location: ' . $_SERVER['HTTP_REFERER'] . '');
        mysqli_close($conn);
      }
    } else {
      $mgsSize = 'Uma ou mais imagens está com o tamanho maior que o permitido. A imagem pode ser até 2MB!';
      $_SESSION['formatoImagem'] = $mgsSize;
      header('Location: ' . $_SERVER['HTTP_REFERER'] . '');
      mysqli_close($conn);
    }
  } else if(!isset($_FILES['documentacaoFotografica3'])){
    $documentacaoFotografica3 = null;
  }

  
if(isset($_FILES['documentacaoGrafica'])) {
  if($_FILES['documentacaoGrafica']['size'] <= 3145728  ){
  $extensao = strtolower(substr($_FILES['documentacaoGrafica']['name'], -4));
  
  if($extensao == '.PNG' || $extensao == '.png' || $extensao == '.JPG' || $extensao == '.jpg' || $extensao == '.JPEG' || $extensao == '.jpeg') {
  $documentacaoGrafica = $_FILES['documentacaoGrafica']['name'];
  $diretorio4 = 'imgGrafica/img1/';
  move_uploaded_file($_FILES['documentacaoGrafica']['tmp_name'], $diretorio4.$documentacaoGrafica);
  } else if (!$extensao || $extensao = ''){
    $documentacaoGrafica = $dados['documentacaoGrafica'];;
  }else {
    $mgsExt = 'Uma ou mais imagens está com formato não compatível! O formato deve ser PNG | JPEG | JPG';
    $_SESSION['formatoImagem'] = $mgsExt;
    header('Location: '.$_SERVER['HTTP_REFERER']. '');
    mysqli_close($conn);
  }
} else {
    $mgsSize = 'Uma ou mais imagens está com o tamanho maior que o permitido. A imagem pode ser até 2MB!';
    $_SESSION['formatoImagem'] = $mgsSize;
    header('Location: '.$_SERVER['HTTP_REFERER']. '');
    mysqli_close($conn);
}
} else if(!isset($_FILES['documentacaoGrafica'])){
  $documentacaoGrafica = null;
}

if(isset($_FILES['documentacaoGrafica2'])) {
  if($_FILES['documentacaoGrafica2']['size'] <= 3145728  ){
  $extensao = strtolower(substr($_FILES['documentacaoGrafica2']['name'], -4));
  
  if($extensao == '.PNG' || $extensao == '.png' || $extensao == '.JPG' || $extensao == '.jpg' || $extensao == '.JPEG' || $extensao == '.jpeg') {
  $documentacaoGrafica2 = $_FILES['documentacaoGrafica2']['name'];
  $diretorio5 = 'imgGrafica/img2/';
  move_uploaded_file($_FILES['documentacaoGrafica2']['tmp_name'], $diretorio5.$documentacaoGrafica2);
  } else if (!$extensao || $extensao = ''){
    $documentacaoGrafica2 = $dados['documentacaoGrafica2'];;
  }else {
    $mgsExt = 'Uma ou mais imagens está com formato não compatível! O formato deve ser PNG | JPEG | JPG';
    $_SESSION['formatoImagem'] = $mgsExt;
    header('Location: '.$_SERVER['HTTP_REFERER']. '');
    mysqli_close($conn);
  }
} else {
    $mgsSize = 'Uma ou mais imagens está com o tamanho maior que o permitido. A imagem pode ser até 2MB!';
    $_SESSION['formatoImagem'] = $mgsSize;
    header('Location: '.$_SERVER['HTTP_REFERER']. '');
    mysqli_close($conn);
}
} else if(!isset($_FILES['documentacaoGrafica2'])){
  $documentacaoGrafica2 = null;
}

if(isset($_FILES['documentacaoGrafica3'])) {
  if($_FILES['documentacaoGrafica3']['size'] <= 3145728  ){
  $extensao = strtolower(substr($_FILES['documentacaoGrafica3']['name'], -4));
  
  if($extensao == '.PNG' || $extensao == '.png' || $extensao == '.JPG' || $extensao == '.jpg' || $extensao == '.JPEG' || $extensao == '.jpeg') {
  $documentacaoGrafica3 = $_FILES['documentacaoGrafica3']['name'];
  $diretorio6 = 'imgGrafica/img3/';
  move_uploaded_file($_FILES['documentacaoGrafica3']['tmp_name'], $diretorio6.$documentacaoGrafica3);
  } else if (!$extensao || $extensao = ''){
    $documentacaoGrafica3 = $dados['documentacaoGrafica3'];;
  }else {
    $mgsExt = 'Uma ou mais imagens está com formato não compatível! O formato deve ser PNG | JPEG | JPG';
    $_SESSION['formatoImagem'] = $mgsExt;
    header('Location: '.$_SERVER['HTTP_REFERER']. '');
    mysqli_close($conn);
  }
} else {
    $mgsSize = 'Uma ou mais imagens está com o tamanho maior que o permitido. A imagem pode ser até 2MB!';
    $_SESSION['formatoImagem'] = $mgsSize;
    header('Location: '.$_SERVER['HTTP_REFERER']. '');
    mysqli_close($conn);
}
} else if(!isset($_FILES['documentacaoGrafica3'])){
  $documentacaoGrafica3 = null;
} 

  }

  $result_usuario = "UPDATE imovel SET responsavelPreenchimento ='$responsavelPreenchimento', grupoTipoEquipe='$grupoTipoEquipe', 
  itemResolucao=$itemResolucao, denominacao='$denominacao', classificacao='$classificacao', usoAtual='$usoAtual', propriedade='$propriedade',
  terreo='$terreo', resolucaoTombamento='$resolucaoTombamento', resolucaoCondephaat='$resolucaoCondephaat', resolucaoIphan='$resolucaoIphan',
  tipo='$tipo', titulo='$titulo', logradouro='$logradouro', numeroEndereco='$numeroEndereco', distrito='$distrito', prefeituraRegional='$prefeituraRegional',
  setor='$setor', quadra='$quadra', lote='$lote', 	autorOriginal='$autorOriginal', construtor='$construtor', dataConstrucao='$dataConstrucao',
  estiloArquitetonico='$estiloArquitetonico', tecnicaConstrutiva='$tecnicaConstrutiva', numeroPavimentos='$numeroPavimentos', areaLote='$areaLote',
  areaConstruida='$areaConstruida', grauTombamento='$grauTombamento', grauAlteracao='$grauAlteracao', comentarioGrauAlteracao='$comentarioGrauAlteracao',
  grauEstadoConservacao='$grauEstadoConservacao', comentarioEstadoConservacao='$comentarioEstadoConservacao', observacoesPavimentos='$observacoesPavimentos',
  dadosHistoricos='$dadosHistoricos', dadosArquitetonicos='$dadosArquitetonicos', dadosAmbiencia='$dadosAmbiencia', fontesBibliograficas='$fontesBibliograficas',
  outrasInformacoes='$outrasInformacoes', observacoes='$observacoes', documentacaoFotografica='$documentacaoFotografica', documentacaoFotografica2='$documentacaoFotografica2',
  documentacaoFotografica3='$documentacaoFotografica3', documentacaoGrafica='$documentacaoGrafica', documentacaoGrafica2='$documentacaoGrafica2', documentacaoGrafica3='$documentacaoGrafica3' WHERE id = '$id'";
  
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