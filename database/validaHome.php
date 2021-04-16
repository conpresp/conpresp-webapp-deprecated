<?php
session_start();
header("Content-Type: text/html; charset=utf-8");
$host = "localhost";
$usuario = "root";
$senha = "";
$bd = "conpresp_db";

$mysqli = mysqli_connect($host, $usuario, $senha, $bd);

if ($mysqli->connect_errno)
  echo "Falha na conexao: (" . $mysqli->connect_errno . ") " . $mysqli->connect_errno;
mysqli_close($mysqli);
?>

<meta charset="UTF-8">
<font face="arial" color="black" size="4">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

  <script type="text/javascript">
    function imovelInsert() {
      setTimeout("window.location='../home.php'", 1800);
    }

    function imovelfailed() {
      setTimeout("window.location='../index.php?modulo=Conpresp&acao=DocConpresp'", 1800);
    }
  </script>

  <?php
  $conecta = mysqli_connect($host, $usuario, $senha, $bd) or die('Erro ao conectar');

  mysqli_select_db($conecta, $bd) or print(mysqli_error($conecta));


  /* change character set to utf8mb4 */
  if (!mysqli_set_charset($conecta, "utf8mb4")) {
    printf("Error loading character set utf8mb4: %s\n", mysqli_error($conecta));
    exit();
  } else {
    $responsavelPreenchimento = $_POST["responsavelPreenchimento"] ? $responsavelPreenchimento = $_POST["responsavelPreenchimento"] : '';
    $grupoTipoEquipe = $_POST["grupoTipoEquipe"] ? $grupoTipoEquipe = $_POST["grupoTipoEquipe"] : '';
    $itemResolucao = $_POST["itemResolucao"] ? $itemResolucao = $_POST["itemResolucao"] : 0;
    $denominacao = $_POST["denominacao"] ? $denominacao = $_POST["denominacao"] : '';
    $classificacao = $_POST["classificacao"] ? $classificacao = $_POST["classificacao"] : '';
    $usoAtual = $_POST["usoAtual"] ? $usoAtual = $_POST["usoAtual"] : '';
    $propriedade = $_POST["propriedade"] ? $propriedade = $_POST["propriedade"] : '';
    $terreo = $_POST["terreo"] ? $terreo = $_POST["terreo"] : '';
    $resolucaoTombamento = $_POST["resolucaoTombamento"] ? $resolucaoTombamento = $_POST["resolucaoTombamento"] : '';
    $resolucaoCondephaat = $_POST["resolucaoCondephaat"] ? $resolucaoCondephaat = $_POST["resolucaoCondephaat"] : '';
    $resolucaoIphan = $_POST["resolucaoIphan"] ? $resolucaoIphan = $_POST["resolucaoIphan"] : '';
    $tipo = $_POST["tipo"] ? $tipo = $_POST["tipo"] : '';
    $titulo = $_POST["titulo"] ? $titulo = $_POST["titulo"] : '';
    $logradouro = $_POST["logradouro"] ? $logradouro = $_POST["logradouro"] : '';
    $numeroEndereco = $_POST["numeroEndereco"] ? $numeroEndereco = $_POST["numeroEndereco"] : '';
    $distrito = $_POST["distrito"] ? $distrito = $_POST["distrito"] : '';
    $prefeituraRegional = $_POST["prefeituraRegional"] ? $prefeituraRegional = $_POST["prefeituraRegional"] : '';
    $setor = $_POST["setor"] ? $setor = $_POST["setor"] : '';
    $quadra = $_POST["quadra"] ? $quadra = $_POST["quadra"] : '';
    $lote = $_POST["lote"] ? $lote = $_POST["lote"] : '';
    $autorOriginal = $_POST["autorOriginal"] ? $autorOriginal = $_POST["autorOriginal"] : '';
    $construtor = $_POST["construtor"] ? $construtor = $_POST["construtor"] :  '';
    $dataConstrucao = $_POST["dataConstrucao"] ? $dataConstrucao = $_POST["dataConstrucao"] : '';
    $estiloArquitetonico = $_POST["estiloArquitetonico"] ? $estiloArquitetonico = $_POST["estiloArquitetonico"] : '';
    $tecnicaConstrutiva = $_POST["tecnicaConstrutiva"] ? $tecnicaConstrutiva = $_POST["tecnicaConstrutiva"] : '';
    $numeroPavimentos = $_POST["numeroPavimentos"] ? $numeroPavimentos = $_POST["numeroPavimentos"]  : 0;
    $areaLote = $_POST["areaLote"] ? $areaLote = $_POST["areaLote"] : '0';
    $areaConstruida = $_POST["areaConstruida"] ? $areaConstruida = $_POST["areaConstruida"] : '0';
    $grauTombamento = $_POST["grauTombamento"] ? $grauTombamento = $_POST["grauTombamento"] : '';
    $grauAlteracao = $_POST["grauAlteracao"] ? $grauAlteracao = $_POST["grauAlteracao"] : '';
    $comentarioGrauAlteracao = $_POST["comentarioGrauAlteracao"] ?  $comentarioGrauAlteracao = $_POST["comentarioGrauAlteracao"] : '';
    $grauEstadoConservacao = $_POST["grauEstadoConservacao"] ? $grauEstadoConservacao = $_POST["grauEstadoConservacao"] : '';
    $comentarioEstadoConservacao = $_POST["comentarioEstadoConservacao"] ? $comentarioEstadoConservacao = $_POST["comentarioEstadoConservacao"] : '';
    $observacoesPavimentos = $_POST["observacoesPavimentos"] ? $observacoesPavimentos = $_POST["observacoesPavimentos"]  : '';
    $dadosHistoricos = $_POST["dadosHistoricos"] ? $dadosHistoricos = $_POST["dadosHistoricos"]  : '';
    $dadosArquitetonicos = $_POST["dadosArquitetonicos"] ? $dadosArquitetonicos = $_POST["dadosArquitetonicos"] : '';
    $dadosAmbiencia = $_POST["dadosAmbiencia"] ? $dadosAmbiencia = $_POST["dadosAmbiencia"] : '';
    $fontesBibliograficas = $_POST["fontesBibliograficas"] ? $fontesBibliograficas = $_POST["fontesBibliograficas"] : '';
    $outrasInformacoes = $_POST["outrasInformacoes"] ? $outrasInformacoes = $_POST["outrasInformacoes"] : '';
    $observacoes = $_POST["observacoes"] ?  $observacoes = $_POST["observacoes"] : '';
    $documentacaoFotografica2 = null;
    $documentacaoFotografica3 = null;
    $documentacaoGrafica2 = null;
    $documentacaoGrafica3 = null;

    $msg = false;
    $extensao = '';
    $novaExt = '.png';

    if (isset($_FILES['documentacaoFotografica'])) {
      if ($_FILES['documentacaoFotografica']['size'] <= 3145728  ) {
        $extensao = strtolower(substr($_FILES['documentacaoFotografica']['name'], -4));
       
        if ($extensao == '.PNG' || $extensao == '.png' || $extensao == '.JPG' || $extensao == '.jpg' || $extensao == '.JPEG' || $extensao == '.jpeg') {
          $documentacaoFotografica = $_FILES['documentacaoFotografica']['name'];
          $diretorio = '../imgFotografica/img1/';
          
          move_uploaded_file($_FILES['documentacaoFotografica']['tmp_name'], $diretorio . $documentacaoFotografica);
     
        } 
        else if (!$extensao || $extensao = ''){
          $documentacaoFotografica = null;
        }else {
          $mgsExt = 'Uma ou mais imagens está com formato não compatível! O formato deve ser PNG | JPEG | JPG';
          $_SESSION['formatoImagem2'] = $mgsExt;
          header('Location: ' . $_SERVER['HTTP_REFERER'] . '');
          mysqli_close($conecta);
        }
      } else {
        $mgsSize = 'Uma ou mais imagens está com o tamanho maior que o permitido. A imagem pode ser até 2MB!';
        $_SESSION['formatoImagem2'] = $mgsSize;
        header('Location: ' . $_SERVER['HTTP_REFERER'] . '');
        mysqli_close($conecta);
      }
    }

    if (isset($_FILES['documentacaoFotografica2'])) {
      if ($_FILES['documentacaoFotografica2']['size'] <= 3145728  ) {
        $extensao = strtolower(substr($_FILES['documentacaoFotografica2']['name'], -4));
       
        if ($extensao == '.PNG' || $extensao == '.png' || $extensao == '.JPG' || $extensao == '.jpg' || $extensao == '.JPEG' || $extensao == '.jpeg') {
          $documentacaoFotografica2 = $_FILES['documentacaoFotografica2']['name'];
          $diretorio2 = '../imgFotografica/img2/';
          
          move_uploaded_file($_FILES['documentacaoFotografica2']['tmp_name'], $diretorio2 . $documentacaoFotografica2);
     
        }else if (!$extensao || $extensao = ''){
          $documentacaoFotografica2 = null;
        }else {
          $mgsExt = 'Uma ou mais imagens está com formato não compatível! O formato deve ser PNG | JPEG | JPG';
          $_SESSION['formatoImagem2'] = $_FILES['documentacaoFotografica2']['name'];
          header('Location: ' . $_SERVER['HTTP_REFERER'] . '');
          mysqli_close($conecta);
        }
      } else {
        $mgsSize = 'Uma ou mais imagens está com o tamanho maior que o permitido. A imagem pode ser até 2MB!';
        $_SESSION['formatoImagem2'] = $mgsSize;
        header('Location: ' . $_SERVER['HTTP_REFERER'] . '');
        mysqli_close($conecta);
      }
    } else if(!isset($_FILES['documentacaoFotografica2'])){
      $documentacaoFotografica2 = null;
    }

    if (isset($_FILES['documentacaoFotografica3'])) {
      if ($_FILES['documentacaoFotografica3']['size'] <= 3145728  ) {
        $extensao = strtolower(substr($_FILES['documentacaoFotografica3']['name'], -4));
       
        if ($extensao == '.PNG' || $extensao == '.png' || $extensao == '.JPG' || $extensao == '.jpg' || $extensao == '.JPEG' || $extensao == '.jpeg') {
          $documentacaoFotografica3 = $_FILES['documentacaoFotografica3']['name'];
          $diretorio3 = '../imgFotografica/img3/';
          
          move_uploaded_file($_FILES['documentacaoFotografica3']['tmp_name'], $diretorio3 . $documentacaoFotografica3);
     
        } else if (!$extensao || $extensao = ''){
          $documentacaoFotografica3 = null;
        }else {
          $mgsExt = 'Uma ou mais imagens está com formato não compatível! O formato deve ser PNG | JPEG | JPG';
          $_SESSION['formatoImagem2'] = $mgsExt;
          header('Location: ' . $_SERVER['HTTP_REFERER'] . '');
          mysqli_close($conecta);
        }
      } else {
        $mgsSize = 'Uma ou mais imagens está com o tamanho maior que o permitido. A imagem pode ser até 2MB!';
        $_SESSION['formatoImagem2'] = $mgsSize;
        header('Location: ' . $_SERVER['HTTP_REFERER'] . '');
        mysqli_close($conecta);
      }
    } else if(!isset($_FILES['documentacaoFotografica3'])){
      $documentacaoFotografica3 = null;
    }

    
  if(isset($_FILES['documentacaoGrafica'])) {
    if($_FILES['documentacaoGrafica']['size'] <= 3145728  ){
    $extensao = strtolower(substr($_FILES['documentacaoGrafica']['name'], -4));
    
    if($extensao == '.PNG' || $extensao == '.png' || $extensao == '.JPG' || $extensao == '.jpg' || $extensao == '.JPEG' || $extensao == '.jpeg') {
    $documentacaoGrafica =  $_FILES['documentacaoGrafica']['name'];
    $diretorio4 = '../imgGrafica/img1/';
    move_uploaded_file($_FILES['documentacaoGrafica']['tmp_name'], $diretorio4.$documentacaoGrafica);
    } else if (!$extensao || $extensao = ''){
      $documentacaoGrafica = null;
    }else {
      $mgsExt = 'Uma ou mais imagens está com formato não compatível! O formato deve ser PNG | JPEG | JPG';
      $_SESSION['formatoImagem2'] = $mgsExt;
      header('Location: '.$_SERVER['HTTP_REFERER']. '');
      mysqli_close($conecta);
    }
  } else {
      $mgsSize = 'Uma ou mais imagens está com o tamanho maior que o permitido. A imagem pode ser até 2MB!';
      $_SESSION['formatoImagem2'] = $mgsSize;
      header('Location: '.$_SERVER['HTTP_REFERER']. '');
      mysqli_close($conecta);
  }
  } 

  if(isset($_FILES['documentacaoGrafica2'])) {
    if($_FILES['documentacaoGrafica2']['size'] <= 3145728  ){
    $extensao = strtolower(substr($_FILES['documentacaoGrafica2']['name'], -4));
    
    if($extensao == '.PNG' || $extensao == '.png' || $extensao == '.JPG' || $extensao == '.jpg' || $extensao == '.JPEG' || $extensao == '.jpeg') {
    $documentacaoGrafica2 = $_FILES['documentacaoGrafica2']['name'];
    $diretorio5 = '../imgGrafica/img2/';
    move_uploaded_file($_FILES['documentacaoGrafica2']['tmp_name'], $diretorio5.$documentacaoGrafica2);
    } else if (!$extensao || $extensao = ''){
      $documentacaoGrafica2 = null;
    }else {
      $mgsExt = 'Uma ou mais imagens está com formato não compatível! O formato deve ser PNG | JPEG | JPG';
      $_SESSION['formatoImagem2'] = $mgsExt;
      header('Location: '.$_SERVER['HTTP_REFERER']. '');
      mysqli_close($conecta);
    }
  } else {
      $mgsSize = 'Uma ou mais imagens está com o tamanho maior que o permitido. A imagem pode ser até 2MB!';
      $_SESSION['formatoImagem2'] = $mgsSize;
      header('Location: '.$_SERVER['HTTP_REFERER']. '');
      mysqli_close($conecta);
  }
  } else if(!isset($_FILES['documentacaoGrafica2'])){
    $documentacaoGrafica2 = null;
  }

  if(isset($_FILES['documentacaoGrafica3'])) {
    if($_FILES['documentacaoGrafica3']['size'] <= 3145728  ){
    $extensao = strtolower(substr($_FILES['documentacaoGrafica3']['name'], -4));
    
    if($extensao == '.PNG' || $extensao == '.png' || $extensao == '.JPG' || $extensao == '.jpg' || $extensao == '.JPEG' || $extensao == '.jpeg') {
    $documentacaoGrafica3 = $_FILES['documentacaoGrafica3']['name'];
    $diretorio6 = '../imgGrafica/img3/';
    move_uploaded_file($_FILES['documentacaoGrafica3']['tmp_name'], $diretorio6.$documentacaoGrafica3);
    } else if (!$extensao || $extensao = ''){
      $documentacaoGrafica3 = null;
    }else {
      $mgsExt = 'Uma ou mais imagens está com formato não compatível! O formato deve ser PNG | JPEG | JPG';
      $_SESSION['formatoImagem2'] = $mgsExt;
      header('Location: '.$_SERVER['HTTP_REFERER']. '');
      mysqli_close($conecta);
    }
  } else {
      $mgsSize = 'Uma ou mais imagens está com o tamanho maior que o permitido. A imagem pode ser até 2MB!';
      $_SESSION['formatoImagem2'] = $mgsSize;
      header('Location: '.$_SERVER['HTTP_REFERER']. '');
      mysqli_close($conecta);
  }
  } else if(!isset($_FILES['documentacaoGrafica3'])){
    $documentacaoGrafica3 = null;
  }

    $sql = "INSERT into imovel(responsavelPreenchimento,grupoTipoEquipe,itemResolucao,denominacao,classificacao,usoAtual,propriedade,terreo,
    resolucaoTombamento,resolucaoCondephaat,resolucaoIphan,tipo,titulo,logradouro,numeroEndereco,distrito,prefeituraRegional,setor,quadra,lote,
    autorOriginal,construtor,dataConstrucao,estiloArquitetonico,tecnicaConstrutiva,numeroPavimentos,areaLote,areaConstruida,grauTombamento,
    grauAlteracao,comentarioGrauAlteracao, grauEstadoConservacao, comentarioEstadoConservacao,observacoesPavimentos,dadosHistoricos,dadosArquitetonicos,
    dadosAmbiencia,fontesBibliograficas,outrasInformacoes,observacoes,documentacaoFotografica,documentacaoFotografica2,documentacaoFotografica3,documentacaoGrafica,documentacaoGrafica2,documentacaoGrafica3) values";
              $sql .=  "('$responsavelPreenchimento','$grupoTipoEquipe', $itemResolucao, '$denominacao', '$classificacao','$usoAtual','$propriedade', '$terreo',
    '$resolucaoTombamento', '$resolucaoCondephaat', '$resolucaoIphan', '$tipo','$titulo','$logradouro','$numeroEndereco', '$distrito', '$prefeituraRegional','$setor','$quadra','$lote',
    '$autorOriginal','$construtor','$dataConstrucao', '$estiloArquitetonico','$tecnicaConstrutiva', $numeroPavimentos,'$areaLote', '$areaConstruida','$grauTombamento',
    '$grauAlteracao', '$comentarioGrauAlteracao', '$grauEstadoConservacao', '$comentarioEstadoConservacao', '$observacoesPavimentos', '$dadosHistoricos','$dadosArquitetonicos',
    '$dadosAmbiencia', '$fontesBibliograficas', '$outrasInformacoes', '$observacoes', '$documentacaoFotografica','$documentacaoFotografica2','$documentacaoFotografica3','$documentacaoGrafica','$documentacaoGrafica2','$documentacaoGrafica3')";

              if ($conecta->query($sql) === TRUE) {
                echo "<p style='text-align: center; margin-top: 50px;'>Registro cadastrado com sucesso! Aguarde um instante...</p>";
                echo "<script>imovelInsert()</script>";
              } else {
                echo "Error: " . $sql . "<br>" . $conecta->error;
                echo "<p style='text-align: center; margin-top: 50px;'>Erro ao efetuar registro! Aguarde um instante...</p>";
                echo "<script>imovelfailed()</script>";
              }

    mysqli_close($conecta);
  }
  ?>

  <div class="d-flex justify-content-center" style="margin-top: 100px;">
    <div class="spinner-border text-primary" style="width: 6rem; height: 6rem;" role="status">
      <span class="sr-only">Loading...</span>
    </div>
  </div>

</font>
</meta>