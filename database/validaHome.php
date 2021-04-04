<?php
 session_start();
 header("Content-Type: text/html; charset=utf-8");
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

function imovelInsert(){
    setTimeout("window.location='../home.php'", 1800);
}

function imovelfailed(){
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
  $msg = false;
  $extensao = '';
  $novaExt = '.png';

  if(isset($_FILES['documentacaoFotografica'])) {
      
    $extensao = strtolower(substr($_FILES['documentacaoFotografica']['name'], -4));
    $documentacaoFotografica = md5(time()).$novaExt;
    $diretorio = '../imgFotografica/img1/';

    move_uploaded_file($_FILES['documentacaoFotografica']['tmp_name'], $diretorio.$documentacaoFotografica);
    
  }

  if(isset($_FILES['documentacaoGrafica'])) {

    $extensao = strtolower(substr($_FILES['documentacaoGrafica']['name'], -4));
    $documentacaoGrafica = md5(time()). $novaExt;
    $diretorio = '../imgGrafica/img1/';

    move_uploaded_file($_FILES['documentacaoGrafica']['tmp_name'], $diretorio.$documentacaoGrafica);
  }

$responsavelPreenchimento = $_POST["responsavelPreenchimento"] ? $responsavelPreenchimento = $_POST["responsavelPreenchimento"] : '';
$grupoTipoEquipe = $_POST["grupoTipoEquipe"] ? $grupoTipoEquipe = $_POST["grupoTipoEquipe"] : '';
$itemResolucao = $_POST["itemResolucao"] ? $itemResolucao = $_POST["itemResolucao"] : 0;
$denominacao = $_POST["denominacao"] ? $denominacao = $_POST["denominacao"] : '';
$classificacao = $_POST["classificacao"] ? $classificacao = $_POST["classificacao"] : '' ;
$usoAtual = $_POST["usoAtual"] ? $usoAtual = $_POST["usoAtual"] : '';
$propriedade = $_POST["propriedade"] ? $propriedade = $_POST["propriedade"] : '';
$terreo = $_POST["terreo"] ? $terreo = $_POST["terreo"]: '';
$resolucaoTombamento = $_POST["resolucaoTombamento"] ? $resolucaoTombamento = $_POST["resolucaoTombamento"]: '';
$resolucaoCondephaat = $_POST["resolucaoCondephaat"] ? $resolucaoCondephaat = $_POST["resolucaoCondephaat"] : '';
$resolucaoIphan = $_POST["resolucaoIphan"] ? $resolucaoIphan = $_POST["resolucaoIphan"]: '';
$tipo = $_POST["tipo"] ? $tipo = $_POST["tipo"] : '';
$titulo = $_POST["titulo"] ? $titulo = $_POST["titulo"] : '';
$logradouro = $_POST["logradouro"] ? $logradouro = $_POST["logradouro"] : '' ;
$numeroEndereco = $_POST["numeroEndereco"] ? $numeroEndereco = $_POST["numeroEndereco"] : '';
$distrito = $_POST["distrito"] ? $distrito = $_POST["distrito"] : '';
$prefeituraRegional= $_POST["prefeituraRegional"] ? $prefeituraRegional= $_POST["prefeituraRegional"] : '';
$setor = $_POST["setor"] ? $setor = $_POST["setor"] : '';
$quadra = $_POST["quadra"] ? $quadra = $_POST["quadra"]: '';
$lote = $_POST["lote"] ? $lote = $_POST["lote"] : '';
$autorOriginal = $_POST["autorOriginal"] ? $autorOriginal = $_POST["autorOriginal"] : '';
$construtor = $_POST["construtor"] ? $construtor = $_POST["construtor"] :  '';
$dataConstrucao= $_POST["dataConstrucao"] ? $dataConstrucao= $_POST["dataConstrucao"] : '';
$estiloArquitetonico= $_POST["estiloArquitetonico"] ? $estiloArquitetonico= $_POST["estiloArquitetonico"]: '';
$tecnicaConstrutiva = $_POST["tecnicaConstrutiva"] ? $tecnicaConstrutiva = $_POST["tecnicaConstrutiva"] : '';
$numeroPavimentos= $_POST["numeroPavimentos"] ? $numeroPavimentos= $_POST["numeroPavimentos"]  : 0;
$areaLote = $_POST["areaLote"] ? $areaLote = $_POST["areaLote"] : '0';
$areaConstruida = $_POST["areaConstruida"] ? $areaConstruida = $_POST["areaConstruida"]: '0';
$grauTombamento= $_POST["grauTombamento"] ? $grauTombamento= $_POST["grauTombamento"]: '';
$grauAlteracao = $_POST["grauAlteracao"] ? $grauAlteracao = $_POST["grauAlteracao"] : '';
$comentarioGrauAlteracao = $_POST["comentarioGrauAlteracao"] ?  $comentarioGrauAlteracao = $_POST["comentarioGrauAlteracao"]: '';
$grauEstadoConservacao = $_POST["grauEstadoConservacao"] ? $grauEstadoConservacao = $_POST["grauEstadoConservacao"] : '';
$comentarioEstadoConservacao = $_POST["comentarioEstadoConservacao"] ? $comentarioEstadoConservacao = $_POST["comentarioEstadoConservacao"] : '';
$observacoesPavimentos = $_POST["observacoesPavimentos"] ? $observacoesPavimentos = $_POST["observacoesPavimentos"]  : '';
$dadosHistoricos= $_POST["dadosHistoricos"] ? $dadosHistoricos= $_POST["dadosHistoricos"]  : '';
$dadosArquitetonicos = $_POST["dadosArquitetonicos"] ? $dadosArquitetonicos = $_POST["dadosArquitetonicos"] : '';
$dadosAmbiencia = $_POST["dadosAmbiencia"] ? $dadosAmbiencia = $_POST["dadosAmbiencia"] : '';
$fontesBibliograficas = $_POST["fontesBibliograficas"] ? $fontesBibliograficas = $_POST["fontesBibliograficas"] : '';
$outrasInformacoes = $_POST["outrasInformacoes"] ? $outrasInformacoes = $_POST["outrasInformacoes"] : '';
$observacoes = $_POST["observacoes"] ?  $observacoes = $_POST["observacoes"] : '';


// echo $responsavelPreenchimento. '<br>';
// echo $grupoTipoEquipe. '<br>';
// echo $itemResolucao. '<br>';
// echo $denominacao. '<br>';
// echo $classificacao. '<br>';
// echo $usoAtual. '<br>';
// echo $propriedade. '<br>';
// echo $terreo. '<br>';
// echo $resolucaoTombamento. '<br>';
// echo $resolucaoCondephaat. '<br>';
// echo $resolucaoIphan. '<br>';
// echo $tipo. '<br>';
// echo $titulo. '<br>';
// echo $logradouro. '<br>';
// echo $numeroEndereco. '<br>';
// echo $distrito. '<br>';
// echo $prefeituraRegional. '<br>';
// echo $setor. '<br>';
// echo $quadra. '<br>';
// echo $lote. '<br>';
// echo $autorOriginal. '<br>';
// echo $construtor. '<br>';
// echo $dataConstrucao. '<br>';
// echo $estiloArquitetonico. '<br>';
// echo $tecnicaConstrutiva. '<br>';
// echo $numeroPavimentos. '<br>';
// echo $areaLote. '<br>';
// echo $areaConstruida. '<br>';
// echo $grauTombamento. '<br>';
// echo $grauAlteracao. '<br>';
// echo $comentarioGrauAlteracao. '<br>';
// echo $grauEstadoConservacao. '<br>';
// echo $comentarioEstadoConservacao. '<br>';
// echo $observacoesPavimentos. '<br>';
// echo $dadosHistoricos. '<br>';
// echo $dadosArquitetonicos. '<br>';
// echo $dadosAmbiencia. '<br>';
// echo $fontesBibliograficas. '<br>';
// echo $outrasInformacoes. '<br>';
// echo $observacoes. '<br>';
// echo $documentacaoGrafica. '<br>';
// echo $documentacaoFotografica. '<br>';

$sql ="INSERT into imovel(responsavelPreenchimento,grupoTipoEquipe,itemResolucao,denominacao,classificacao,usoAtual,propriedade,terreo,
resolucaoTombamento,resolucaoCondephaat,resolucaoIphan,tipo,titulo,logradouro,numeroEndereco,distrito,prefeituraRegional,setor,quadra,lote,
autorOriginal,construtor,dataConstrucao,estiloArquitetonico,tecnicaConstrutiva,numeroPavimentos,areaLote,areaConstruida,grauTombamento,
grauAlteracao,comentarioGrauAlteracao, grauEstadoConservacao, comentarioEstadoConservacao,observacoesPavimentos,dadosHistoricos,dadosArquitetonicos,
dadosAmbiencia,fontesBibliograficas,outrasInformacoes,observacoes,documentacaoFotografica,documentacaoGrafica) values";
$sql .=  "('$responsavelPreenchimento','$grupoTipoEquipe', $itemResolucao, '$denominacao', '$classificacao','$usoAtual','$propriedade', '$terreo',
'$resolucaoTombamento', '$resolucaoCondephaat', '$resolucaoIphan', '$tipo','$titulo','$logradouro','$numeroEndereco', '$distrito', '$prefeituraRegional','$setor','$quadra','$lote',
'$autorOriginal','$construtor','$dataConstrucao', '$estiloArquitetonico','$tecnicaConstrutiva', $numeroPavimentos,'$areaLote', '$areaConstruida','$grauTombamento',
'$grauAlteracao', '$comentarioGrauAlteracao', '$grauEstadoConservacao', '$comentarioEstadoConservacao', '$observacoesPavimentos', '$dadosHistoricos','$dadosArquitetonicos',
'$dadosAmbiencia', '$fontesBibliograficas', '$outrasInformacoes', '$observacoes', '$documentacaoFotografica','$documentacaoGrafica')";

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
    <div class="spinner-border text-primary" style="width: 6rem; height: 6rem;"  role="status" >
      <span class="sr-only">Loading...</span>
    </div>
  </div>

  </font>
  </meta>