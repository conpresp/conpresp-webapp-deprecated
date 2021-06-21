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
if (!mysqli_set_charset($conn, "utf8mb4")) {
    printf("Error loading character set utf8mb4: %s\n", mysqli_error($conn));
    exit();
} else {

$idd = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$result_imovel = "SELECT * FROM imovel WHERE id = '$idd'";
$resultado_imovel = mysqli_query($conn, $result_imovel);
$dados = mysqli_fetch_assoc($resultado_imovel);

$id = $_SESSION['id'];
$perfil = $_SESSION['perfil'];
$username = $_SESSION['username'];
$email = $_SESSION['email'];
$status = $_SESSION['status'];
$password = $_SESSION['password'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1,
    shrink-to-fit=no" />

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
  <link rel="stylesheet" href="css/home.css" />
  <link rel="stylesheet" href="css/doc_conpresp.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

  <style>
    .hidden {
      display: none;
    }
  </style>
  <script src="https://kit.fontawesome.com/5e195b88df.js" crossorigin="anonymous"></script>
  <link rel="icon" href="img/logo.png" />
  <title>CONPRESP</title>
</head>

<body>
  <div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
      <nav class="navbar navbar-expand navbar-dark bg-darkblue topbar static-top shadow">
        <a class="navbar-brand" href="home.php">
          <img src="img/logo_1.png" width="30" height="30" class="d-inline-block align-top" alt="" />
          CONPRESP
        </a>

        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $username ?></span>
              <img class="img-profile rounded-circle" src="img/user.svg" width="30px" height="30px" />
            </a>


            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
              <?php
              if ($perfil == 'Administrador') {
              ?>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#usuario-modal">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400 bg-darkgreen-icon"></i>
                  Sua Conta
                </a>
              <?php } ?>
              <?php
              if (isset($_SESSION["username"])) {
              ?>
                <a class="dropdown-item btnLogout" href="logout.php">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400 bg-darkgreen-icon"></i>
                  Sair
                </a>
              <?php
              } else {
                header("Location: index.php?modulo=Conpresp&acao=login");
                exit;
              }
              ?>
            </div>
          </li>
        </ul>
      </nav>
    </div>
  </div>

  <nav class="navbar navbar-expand-md navbar-light bg-light rounded">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample10" aria-controls="navbarsExample10" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample10">
      <ul class="navbar-nav">
        <li class="nav-item active font-hover">
          <a class="nav-link" href="home.php"><i class="fas fa-home bg-gray-icon"></i>Home</a>
        </li>
        <?php
        if ($perfil == 'Administrador') {
        ?>
          <li class="nav-item active font-hover">
            <a class="nav-link" href="usuarios.php"><i class="fas fa-users bg-gray-icon"></i>Usuários</a>
          </li>
        <?php } ?>
        <li class="nav-item active font-hover">
                        <a class="nav-link" href="templates/glossario.pdf"><i class="fas fa-book bg-gray-icon"></i>Glossário</a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="container mt-4">
    <div class="container-fluid">
      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h2 class="h3 mb-0 text-gray-800 nombre-titulo">Registro Conpresp</h2>
      </div>

      <!-- Content Row -->
      <div class="row">
        <div class="col-xl-12 col-lg-12">
          <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary nombre-subtitulo">
                Dados a cadastrar
              </h6>
            </div>
            <img class="card-img" src="img/banner.png" alt="Card image" />
            <div class="card-body">
              <div class="row color-text">
                <div class="col-md-12 order-md-1">
                  <form class="needs-validation" method="POST" action="database/validaHome.php">
                    <div class="row justify-content-center">
                      <a href="home.php" name="btn-cancel" class="btn btn-primary btn-lg m-2 col-md-3"><i class="fa fa-times" aria-hidden="true"></i>
                        Cancelar</a>
                    </div>

                    <!-- <div class="mb-3">
                      <label>Código:</label>
                      <input type="text" class="form-control" id="codigo" name="codigo" disabled />
                    </div> -->
                    <div class="mb-3">
                      <label>Responsável pelo Preenchimento:</label>
                      <input type="text" class="form-control" id="nome" name="responsavelPreenchimento" value="<?php echo $dados['responsavelPreenchimento'];?>" disabled />
                    </div>
                    <div class="mb-3">
                      <label for="grupoTipoEquipe">Grupo:</label>
                      <select id="grupoTipoEquipe" class="custom-select d-block w-100" name="grupoTipoEquipe" disabled>
                        <option value="" selected >Selecione a classificação...</option>
                        <option value="EquipeUAM" <?php echo $dados['grupoTipoEquipe'] == 'EquipeUAM' ? 'selected' : ''  ?>>
                          Equipe UAM
                        </option>
                        <option value="EquipeDHPConpresp" <?php echo $dados['grupoTipoEquipe'] == 'EquipeDHPConpresp' ? 'selected' : ''  ?>>Equipe DHP/Conpresp</option>
                      </select>
                    </div>
                    <hr class="mb-4" />

                    <div class="mb-3 p-2 subtitulos">
                      <h4>1. Dados Gerais</h4>
                    </div>
                    <div class="mb-3">
                      <label>Item na Resolução:</label>
                      <h6>
                        Inserir o número do bem a ser cadastrado de acordo com
                        o número correspondente na resolução de tombamento. No
                        caso de resoluções com um bem apenas, identificá-lo
                        com o número 01 (um).
                      </h6>
                      <input type="number" class="form-control" id="itemResolucao" name="itemResolucao"  value="<?php echo $dados['itemResolucao']; ?>" disabled/>
                    </div>
                    <div class="mb-3">
                      <label>Denominação:</label>
                      <h6>
                        Inserir a denominação oficial do bem, de acordo com a
                        resolução ou documento oficial.
                      </h6>
                      <textarea id="denomicacao" class="form-control" aria-label="With textarea" name="denominacao" disabled ><?php echo $dados['denominacao']; ?></textarea>
                    </div>
                    <div class="row">
                      <div class="col-md-3 mb-3">
                        <label>Classificação:</label>
                        <select id="grupo-tipo-bem" class="custom-select d-block w-100" name="classificacao" disabled>
                          <option value="" selected >
                            Selecionar classificação...
                          </option>
                          <option value="Imóvel" <?php echo $dados['classificacao'] == 'Imóvel' ? 'selected' : '' ?>>Imóvel</option>
                          <option value="Móvel" <?php echo $dados['classificacao'] == 'Móvel' ? 'selected' : '' ?>>Móvel</option>
                          <option value="Sítio Urbano" <?php echo $dados['classificacao'] == 'Sítio Urbano' ? 'selected' : '' ?>>Sítio Urbano</option>
                          <option value="Natural" <?php echo $dados['classificacao'] == 'Natural' ? 'selected' : '' ?>>Natural</option>
                        </select>
                      </div>
                      <div class="col-md-5 mb-3">
                        <label>Uso atual:</label>
                        <select id="usoAtual" class="custom-select d-block w-100" name="usoAtual" disabled>
                          <option value="" selected>
                            Selecionar classificação...
                          </option>
                          <option value="Cemitérios, Mausoléus e Túmulos" <?php echo $dados['usoAtual'] == 'Cemitérios, Mausoléus e Túmulos' ? 'selected' : '' ?>>
                            Cemitérios, Mausoléus e Túmulos
                          </option>
                          <option value="Comercial" <?php echo $dados['usoAtual'] == 'Comercial' ? 'selected' : '' ?>>Comercial</option>
                          <option value="Cultural" <?php echo $dados['usoAtual'] == 'Cultural' ? 'selected' : '' ?>>Cultural</option>
                          <option value="Educacional" <?php echo $dados['usoAtual'] == 'Educacional' ? 'selected' : '' ?>>Educacional</option>
                          <option value="Espaço público" <?php echo $dados['usoAtual'] == 'Espaço público' ? 'selected' : '' ?>>Espaço público</option>
                          <option value="Industrial" <?php echo $dados['usoAtual'] == 'Industrial' ? 'selected' : '' ?>>Industrial</option>
                          <option value="Instituição de saúde" <?php echo $dados['usoAtual'] == 'Instituição de saúde' ? 'selected' : '' ?>>Instituição de saúde</option>
                          <option value="Misto (Comércio e Serviço)" <?php echo $dados['usoAtual'] == 'Misto (Comércio e Serviço)' ? 'selected' : '' ?>> Misto (Comércio e Serviço)</option>
                          <option value="Monumento e obras de arte" <?php echo $dados['usoAtual'] == 'Monumento e obras de arte' ? 'selected' : '' ?>>Monumento e obras de arte</option>
                          <option value="Natural" <?php echo $dados['usoAtual'] == 'Natural' ? 'selected' : '' ?>>Natural</option>
                          <option value="Religioso" <?php echo $dados['usoAtual'] == 'Religioso' ? 'selected' : '' ?>>Religioso</option>
                          <option value="Residencial" <?php echo $dados['usoAtual'] == 'Residencial' ? 'selected' : '' ?>>Residencial</option>
                          <option value="Serviço" <?php echo $dados['usoAtual'] == 'Serviço' ? 'selected' : '' ?>>Serviço</option>
                        </select>
                        <!-- <div class="invalid-feedback">
                            Por favor seleccione uma classificação.
                          </div> -->
                      </div>
                      <div class="col-md-4 mb-3">
                        <label>Propriedade:</label>
                        <select id="propriedade" class="custom-select d-block w-100" id="grupo-propiedade" name="propriedade" disabled>
                          <option value="" selected >
                            Selecionar classificação...
                          </option>
                          <option value="Pública" <?php echo $dados['propriedade'] == 'Pública' ? 'selected' : '' ?>>Pública</option>      
                          <option value="Particular" <?php echo $dados['propriedade'] == 'Particular' ? 'selected' : '' ?>>Particular</option>
                          <option value="Religiosa" <?php echo $dados['propriedade'] == 'Religiosa' ? 'selected' : '' ?>>Religiosa</option>
                        </select>
                        <!-- <div class="invalid-feedback">
                            Por favor seleccione uma classificação.
                          </div> -->
                      </div>
                    </div>
                    <div class="mb-3 p-2 subtitulos_sub">
                      <h4>Uso Original</h4>
                    </div>
                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <label>Uso (original)</label>
                        <select id="terreo" class="custom-select d-block w-100" name="terreo" disabled>
                          <option value="" selected >
                            Selecionar classificação...
                          </option>
                          <option value="Cemitérios, Mausoléus e Túmulos" <?php echo $dados['terreo'] == 'Cemitérios, Mausoléus e Túmulos' ? 'selected' : '' ?>>
                            Cemitérios, Mausoléus e Túmulos
                          </option>
                          <option value="Comercial" <?php echo $dados['terreo'] == 'Comercial' ? 'selected' : '' ?>>Comercial</option>
                          <option value="Cultural" <?php echo $dados['terreo'] == 'Cultural' ? 'selected' : '' ?>>Cultural</option>
                          <option value="Educacional" <?php echo $dados['terreo'] == 'Educacional' ? 'selected' : '' ?>>Educacional</option>
                          <option value="Espaço público" <?php echo $dados['terreo'] == 'Espaço público' ? 'selected' : '' ?>>Espaço público</option>
                          <option value="Industrial" <?php echo $dados['terreo'] == 'Industrial' ? 'selected' : '' ?>>Industrial</option>
                          <option value="Instituição de saúde" <?php echo $dados['terreo'] == 'Instituição de saúde' ? 'selected' : '' ?>>Instituição de saúde</option>
                          <option value="Misto (Comércio e Serviço)" <?php echo $dados['terreo'] == 'Misto (Comércio e Serviço)' ? 'selected' : '' ?>> Misto (Comércio e Serviço)</option>
                          <option value="Monumento e obras de arte" <?php echo $dados['terreo'] == 'Monumento e obras de arte' ? 'selected' : '' ?>>Monumento e obras de arte</option>
                          <option value="Natural" <?php echo $dados['terreo'] == 'Natural' ? 'selected' : '' ?>>Natural</option>
                          <option value="Religioso" <?php echo $dados['terreo'] == 'Religioso' ? 'selected' : '' ?>>Religioso</option>
                          <option value="Residencial" <?php echo $dados['terreo'] == 'Residencial' ? 'selected' : '' ?>>Residencial</option>
                          <option value="Serviço" <?php echo $dados['terreo'] == 'Serviço' ? 'selected' : '' ?>>Serviço</option>
                        </select>
                      </div>
                    </div>

                    <div class="mb-3 p-2 subtitulos">
                        <h4>2. Tombamento</h4>
                      </div>
                      <div class="mb-3 p-2 subtitulos_sub">
                        <h4>CONPRESP</h4>
                      </div>
                      <div class="row">
                        <div class="col-md-9 mb-3">
                          <label>Resolução:</label>
                          <h6>
                            Seguir o formato: Ex.: Res. 05/91 Utilizar o site da
                            prefeitura como referência:
                            <a href="http://www.prefeitura.sp.gov.br/cidade/secretarias/cultura/conpresp/legislacao/resolucoes/index.php?p=1137" target="_blank">CLICK AQUI</a>
                          </h6>
                          <input type="text" class="form-control" id="resolucaoTombamento" name="resolucaoTombamento" value="<?php echo $dados['resolucaoTombamento'] ?>" disabled />
                        </div>
                        <div class="col-md-3 mb-2" style="margin-top: 25px;">
                          <label>Ano de Tombamento</label>
                          <input class="form-control" type="number" id="anoConpresp" name="anoConpresp" value="<?php echo $dados["anoConpresp"] ?>" disabled/>
                        </div>
                      </div>
                      <div class="mb-3 p-2 subtitulos_sub">
                        <h4>CONDEPHAAT</h4>
                      </div>
                      <div class="row">
                        <div class="col-md-9 mb-3">
                          <label>Resolução:</label>
                          <h6>
                            Seguir o formato: Ex.: RES. SC SN/70 ou RES. SC 67/82
                            Utilizar o site da prefeitura como referência:
                            <a href=" http://www.prefeitura.sp.gov.br/cidade/secretarias/cultura/cit/index.php?p=1157" target="_blank">CLICK AQUI</a>
                          </h6>
                          <input type="text" class="form-control" id="resolucaoCondephaat" name="resolucaoCondephaat" value="<?php echo $dados['resolucaoCondephaat'] ?>" disabled/>
                        </div>
                        <div class="col-md-3 mb-2" style="margin-top: 25px;">
                          <label>Ano de Tombamento</label>
                          <input class="form-control" type="number" id="anoCondephaat" name="anoCondephaat" value="<?php echo $dados["anoCondephaat"] ?>" disabled />
                        </div>
                      </div>

                      <div class="mb-3 p-2 subtitulos_sub">
                        <h4>IPHAN</h4>
                      </div>
                      <div class="row">
                        <div class="col-md-9 mb-3">
                          <label>Resolução:</label>
                          <h6>
                            Seguir o formato: Ex.: nº 353 Ano 1951 Utilizar a
                            lista de bens tombados do Iphan como referência:
                            <a href="http://portal.iphan.gov.br/uploads/ckfinder/arquivos/2016-11-25_Lista_Bens_Tombados.pdf" target="_blank">CLICK AQUI</a>
                          </h6>
                          <input type="text" class="form-control" id="resolucaoIphan" name="resolucaoIphan" value="<?php echo $dados['resolucaoIphan'] ?>" disabled />
                        </div>
                        <div class="col-md-3 mb-2" style="margin-top: 25px;">
                          <label>Ano de Tombamento</label>
                          <input class="form-control" type="number" id="anoIphan" name="anoIphan" value="<?php echo $dados["anoIphan"] ?>" disabled />
                        </div>
                      </div>
                    <div class="mb-3 p-2 subtitulos">
                      <h4>3. Localização</h4>
                    </div>
                    <div class="mb-3">
                      <label class="font-weight-bold">Endereço</label>
                      <h6>
                        Preencher os dados de localização do bem, utilizando
                        os ferramentas disponíveis em:
                        <a href="http://geosampa.prefeitura.sp.gov.br/PaginasPublicas/_SBC.aspx" target="_blank">GEOSAMPA</a>
                        e
                        <a href="http://www3.prefeitura.sp.gov.br/cit/Forms/frmPesquisaGeral.aspx" target="_blank">CADASTRO DE IMÓVEIS TOMBADOS</a>
                      </h6>
                    </div>
                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <label>Tipo</label>
                        <select id="tipo" class="custom-select d-block w-100" name="tipo" disabled>
                          <option value="" selected >Selecionar tipo...</option>
                          <option value="ALAMEDA" <?php echo $dados['tipo'] == 'ALAMEDA' ? 'selected' : '' ?>>ALAMEDA</option>
                          <option value="AVENIDA" <?php echo $dados['tipo'] == 'AVENIDA' ? 'selected' : '' ?>>AVENIDA</option>
                          <option value="CAMPO" <?php echo $dados['tipo'] == 'CAMPO' ? 'selected' : '' ?>>CAMPO</option>
                          <option value="CHACARA" <?php echo $dados['tipo'] == 'CHACARA' ? 'selected' : '' ?>>CHACARA</option>
                          <option value="ESTRADA" <?php echo $dados['tipo'] == 'ESTRADA' ? 'selected' : '' ?>>ESTRADA</option>
                          <option value="JARDIM" <?php echo $dados['tipo'] == 'JARDIM' ? 'selected' : '' ?>>JARDIM</option>
                          <option value="LADEIRA" <?php echo $dados['tipo'] == 'LADEIRA' ? 'selected' : '' ?>>LADEIRA</option>
                          <option value="LAGO" <?php echo $dados['tipo'] == 'LAGO' ? 'selected' : '' ?>>LAGO</option>
                          <option value="LAGOA" <?php echo $dados['tipo'] == 'LAGOA' ? 'selected' : '' ?>>LAGOA</option>
                          <option value="LARGO" <?php echo $dados['tipo'] == 'LARGO' ? 'selected' : '' ?>>LARGO</option>
                          <option value="PARQUE" <?php echo $dados['tipo'] == 'PARQUE' ? 'selected' : '' ?>>PARQUE</option>
                          <option value="PASSARELA" <?php echo $dados['tipo'] == 'PASSARELA' ? 'selected' : '' ?>>PASSARELA</option>
                          <option value="PATIO" <?php echo $dados['tipo'] == 'PATIO' ? 'selected' : '' ?>>PATIO</option>
                          <option value="PRACA" <?php echo $dados['tipo'] == 'PRACA' ? 'selected' : '' ?>>PRACA</option>
                          <option value="RODOVIA" <?php echo $dados['tipo'] == 'RODOVIA' ? 'selected' : '' ?>>RODOVIA</option>
                          <option value="RUA" <?php echo $dados['tipo'] == 'RUA' ? 'selected' : '' ?>>RUA</option>
                          <option value="SETOR" <?php echo $dados['tipo'] == 'SETOR' ? 'selected' : '' ?>>SETOR</option>
                          <option value="SITIO" <?php echo $dados['tipo'] == 'SITIO' ? 'selected' : '' ?>>SITIO</option>
                          <option value="TRAVESSA" <?php echo $dados['tipo'] == 'TRAVESSA' ? 'selected' : '' ?>>TRAVESSA</option>
                          <option value="VIA" <?php echo $dados['tipo'] == 'VIA' ? 'selected' : '' ?>>VIA</option>
                          <option value="VIADUTO" <?php echo $dados['tipo'] == 'VIADUTO' ? 'selected' : '' ?>>VIADUTO</option>
                          <option value="VIELA" <?php echo $dados['tipo'] == 'VIELA' ? 'selected' : '' ?>>VIELA</option>
                          <option value="OUTROS" <?php echo $dados['tipo'] == 'OUTROS' ? 'selected' : '' ?>>OUTROS</option>
                        </select>
                      </div>
                      <div class="col-md-6 mb-3">
                        <label>Título</label>
                        <select id="titulo" class="custom-select d-block w-100" name="titulo" disabled>
                          <option value="" selected >
                            Selecionar classificação...
                          </option>
                          <option value="ABADE" <?php echo $dados['titulo'] == 'ABADE' ? 'selected' : '' ?>>ABADE</option>
                          <option value="ACADEMICO"  <?php echo $dados['titulo'] == 'ACADEMICO' ? 'selected' : '' ?>>ACADEMICO</option>
                          <option value="ADVOGADO"  <?php echo $dados['titulo'] == 'ADVOGADO' ? 'selected' : '' ?>>ADVOGADO</option>
                          <option value="AGENTE"  <?php echo $dados['titulo'] == 'AGENTE' ? 'selected' : '' ?>>AGENTE</option>
                          <option value="AGRIC"  <?php echo $dados['titulo'] == 'AGRIC"' ? 'selected' : '' ?>>AGRIC</option>
                          <option value="AGRIMENSOR"  <?php echo $dados['titulo'] == 'AGRIMENSOR' ? 'selected' : '' ?>>AGRIMENSOR</option>
                          <option value="AJUDANTE"  <?php echo $dados['titulo'] == 'AJUDANTE' ? 'selected' : '' ?>>AJUDANTE</option>
                          <option value="ALFERES"  <?php echo $dados['titulo'] == 'ALFERES' ? 'selected' : '' ?>>ALFERES</option>
                          <option value="ALMIRANTE"  <?php echo $dados['titulo'] == 'ALMIRANTE' ? 'selected' : '' ?>>ALMIRANTE</option>
                          <option value="APOSTOLO"  <?php echo $dados['titulo'] == 'APOSTOLO' ? 'selected' : '' ?>>APOSTOLO</option>
                          <option value="ARCEBISPO"  <?php echo $dados['titulo'] == 'ARCEBISPO' ? 'selected' : '' ?>>ARCEBISPO</option>
                          <option value="ARCIP"  <?php echo $dados['titulo'] == 'ARCIP' ? 'selected' : '' ?>>ARCIP</option>
                          <option value="ARCJO"  <?php echo $dados['titulo'] == 'ARCJO' ? 'selected' : '' ?>>ARCJO</option>
                          <option value="ARQUITETA"  <?php echo $dados['titulo'] == 'ARQUITETA' ? 'selected' : '' ?>>ARQUITETA</option>
                          <option value="ARQUITETO"  <?php echo $dados['titulo'] == 'ARQUITETO' ? 'selected' : '' ?>>ARQUITETO</option>
                          <option value="ARQUITETO PROFESSOR"  <?php echo $dados['titulo'] == 'ARQUITETO PROFESSOR' ? 'selected' : '' ?>>ARQUITETO PROFESSOR</option>
                          <option value="ASPIRANTE"  <?php echo $dados['titulo'] == 'ASPIRANTE' ? 'selected' : '' ?>>ASPIRANTE</option>
                          <option value="AVENIDA"  <?php echo $dados['titulo'] == 'AVENIDA' ? 'selected' : '' ?>>AVENIDA</option>
                          <option value="AVIADOR"  <?php echo $dados['titulo'] == 'AVIADOR' ? 'selected' : '' ?>>AVIADOR</option>
                          <option value="AVIADORA"  <?php echo $dados['titulo'] == 'AVIADORA' ? 'selected' : '' ?>>AVIADORA</option>
                          <option value="BACHAREL"  <?php echo $dados['titulo'] == 'BACHAREL' ? 'selected' : '' ?>>BACHAREL</option>
                          <option value="BANDEIRANTE"  <?php echo $dados['titulo'] == 'BANDEIRANTE' ? 'selected' : '' ?>>BANDEIRANTE</option>
                          <option value="BANQUEIRO"  <?php echo $dados['titulo'] == 'BANQUEIRO' ? 'selected' : '' ?>>BANQUEIRO</option>
                          <option value="BARAO"  <?php echo $dados['titulo'] == 'BARAO' ? 'selected' : '' ?>>BARAO</option>
                          <option value="BARONESA"  <?php echo $dados['titulo'] == 'BARONESA' ? 'selected' : '' ?>>BARONESA</option>
                          <option value="BEATO PADRE"  <?php echo $dados['titulo'] == 'BEATO PADRE' ? 'selected' : '' ?>>BEATO PADRE</option>
                          <option value="BEM AVENTURADO"  <?php echo $dados['titulo'] == 'BEM AVENTURADO' ? 'selected' : '' ?>>BEM AVENTURADO</option>
                          <option value="BENEMERITO"  <?php echo $dados['titulo'] == 'BENEMERITO' ? 'selected' : '' ?>>BENEMERITO</option>
                          <option value="BISPO"  <?php echo $dados['titulo'] == 'BISPO' ? 'selected' : '' ?>>BISPO</option>
                          <option value="BRIGADEIRO"  <?php echo $dados['titulo'] == 'BRIGADEIRO' ? 'selected' : '' ?>>BRIGADEIRO</option>
                          <option value="CABO"  <?php echo $dados['titulo'] == 'CABO' ? 'selected' : '' ?>>CABO</option>
                          <option value="CABO PM"  <?php echo $dados['titulo'] == 'CABO PM"' ? 'selected' : '' ?>>CABO PM</option>
                          <option value="CADETE"  <?php echo $dados['titulo'] == 'CADETE' ? 'selected' : '' ?>>CADETE</option>
                          <option value="CAMPEADOR"  <?php echo $dados['titulo'] == 'CAMPEADOR' ? 'selected' : '' ?>>CAMPEADOR</option>
                          <option value="CAPITAO"  <?php echo $dados['titulo'] == 'CAPITAO' ? 'selected' : '' ?>>CAPITAO</option>
                          <option value="CAPITAO ALMIRANTE"  <?php echo $dados['titulo'] == 'CAPITAO ALMIRANTE' ? 'selected' : '' ?>>CAPITAO ALMIRANTE</option>
                          <option value="CAPITAO DE FRAGATA"  <?php echo $dados['titulo'] == 'CAPITAO DE FRAGATA' ? 'selected' : '' ?>> CAPITAO DE FRAGATA </option>
                          <option value="CAPITAO DE MAR E GUERRA"  <?php echo $dados['titulo'] == 'CAPITAO DE MAR E GUERRA' ? 'selected' : '' ?>>
                            CAPITAO DE MAR E GUERRA
                          </option>
                          <option value="CAPITAO GENERAL"  <?php echo $dados['titulo'] == 'CAPITAO GENERAL' ? 'selected' : '' ?>>
                            CAPITAO GENERAL
                          </option>
                          <option value="CAPITAO MOR"  <?php echo $dados['titulo'] == 'CAPITAO MOR' ? 'selected' : '' ?>>CAPITAO MOR</option>
                          <option value="CAPITAO PM"  <?php echo $dados['titulo'] == 'CAPITAO PM' ? 'selected' : '' ?>>CAPITAO PM</option>
                          <option value="CAPITAO TENENTE"  <?php echo $dados['titulo'] == 'CAPITAO TENENTE' ? 'selected' : '' ?>>
                            CAPITAO TENENTE
                          </option>
                          <option value="CARDEAL"  <?php echo $dados['titulo'] == 'CARDEAL' ? 'selected' : '' ?>>CARDEAL</option>
                          <option value="CATEQUISTA"  <?php echo $dados['titulo'] == 'CATEQUISTA' ? 'selected' : '' ?>>CATEQUISTA</option>
                          <option value="CAVALEIRO"  <?php echo $dados['titulo'] == 'CAVALEIRO' ? 'selected' : '' ?>>CAVALEIRO</option>
                          <option value="CAVALHEIRO"  <?php echo $dados['titulo'] == 'CAVALHEIRO' ? 'selected' : '' ?>>CAVALHEIRO</option>
                          <option value="CINEASTA"  <?php echo $dados['titulo'] == 'CINEASTA' ? 'selected' : '' ?>>CINEASTA</option>
                          <option value="COMANDANTE"  <?php echo $dados['titulo'] == 'COMANDANTE' ? 'selected' : '' ?>>COMANDANTE</option>
                          <option value="COMEDIANTE"  <?php echo $dados['titulo'] == 'COMEDIANTE' ? 'selected' : '' ?>>COMEDIANTE</option>
                          <option value="COMENDADOR"  <?php echo $dados['titulo'] == 'COMENDADOR' ? 'selected' : '' ?>>COMENDADOR</option>
                          <option value="COMISSARIA"  <?php echo $dados['titulo'] == 'COMISSARIA' ? 'selected' : '' ?>>COMISSARIA</option>
                          <option value="COMISSARIO"  <?php echo $dados['titulo'] == 'COMISSARIO' ? 'selected' : '' ?>>COMISSARIO</option>
                          <option value="COMPOSITOR"  <?php echo $dados['titulo'] == 'COMPOSITOR' ? 'selected' : '' ?>>COMPOSITOR</option>
                          <option value="CONDE"  <?php echo $dados['titulo'] == 'CONDE' ? 'selected' : '' ?>>CONDE</option>
                          <option value="CONDESSA"  <?php echo $dados['titulo'] == 'CONDESSA' ? 'selected' : '' ?>>CONDESSA</option>
                          <option value="CONEGO"  <?php echo $dados['titulo'] == 'CONEGO' ? 'selected' : '' ?>>CONEGO</option>
                          <option value="CONFRADE"  <?php echo $dados['titulo'] == 'CONFRADE' ? 'selected' : '' ?>>CONFRADE</option>
                          <option value="CONSELHEIRO"  <?php echo $dados['titulo'] == 'CONSELHEIRO' ? 'selected' : '' ?>>CONSELHEIRO</option>
                          <option value="CONSUL"  <?php echo $dados['titulo'] == 'CONSUL' ? 'selected' : '' ?>>CONSUL</option>
                          <option value="CORONEL"  <?php echo $dados['titulo'] == 'CORONEL' ? 'selected' : '' ?>>CORONEL</option>
                          <option value="CORONEL PM"  <?php echo $dados['titulo'] == 'CORONEL PM' ? 'selected' : '' ?>>CORONEL PM</option>
                          <option value="CORREGEDOR"  <?php echo $dados['titulo'] == 'CORREGEDOR' ? 'selected' : '' ?>>CORREGEDOR</option>
                          <option value="DELEGADO"  <?php echo $dados['titulo'] == 'DELEGADO' ? 'selected' : '' ?>>DELEGADO</option>
                          <option value="DENTISTA"  <?php echo $dados['titulo'] == 'DENTISTA' ? 'selected' : '' ?>>DENTISTA</option>
                          <option value="DEPUTADA"  <?php echo $dados['titulo'] == 'DEPUTADA' ? 'selected' : '' ?>>DEPUTADA</option>
                          <option value="DEPUTADO"  <?php echo $dados['titulo'] == 'DEPUTADO' ? 'selected' : '' ?>>DEPUTADO</option>
                          <option value="DEPUTADO DOUTOR"  <?php echo $dados['titulo'] == 'DEPUTADO DOUTOR' ? 'selected' : '' ?>>
                            DEPUTADO DOUTOR
                          </option>
                          <option value="DESEMBARGADOR"  <?php echo $dados['titulo'] == 'DESEMBARGADOR' ? 'selected' : '' ?>>DESEMBARGADOR</option>
                          <option value="DIACO"  <?php echo $dados['titulo'] == 'DIACO' ? 'selected' : '' ?>>DIACO</option>
                          <option value="DOM"  <?php echo $dados['titulo'] == 'DOM' ? 'selected' : '' ?>>DOM</option>
                          <option value="DONA"  <?php echo $dados['titulo'] == 'DONA' ? 'selected' : '' ?>>DONA</option>
                          <option value="DOUTOR"  <?php echo $dados['titulo'] == 'DOUTOR' ? 'selected' : '' ?>>DOUTOR</option>
                          <option value="DOUTORA"  <?php echo $dados['titulo'] == 'DOUTORA' ? 'selected' : '' ?>>DOUTORA</option>
                          <option value="DUQUE"  <?php echo $dados['titulo'] == 'DUQUE' ? 'selected' : '' ?>>DUQUE</option>
                          <option value="DUQUESA"  <?php echo $dados['titulo'] == 'DUQUESA' ? 'selected' : '' ?>>DUQUESA</option>
                          <option value="EDITOR"  <?php echo $dados['titulo'] == 'EDITOR' ? 'selected' : '' ?>>EDITOR</option>
                          <option value="EDUCADOR"  <?php echo $dados['titulo'] == 'EDUCADOR' ? 'selected' : '' ?>>EDUCADOR</option>
                          <option value="EDUCADORA"  <?php echo $dados['titulo'] == 'EDUCADORA' ? 'selected' : '' ?>>EDUCADORA</option>
                          <option value="EMBAIXADOR"  <?php echo $dados['titulo'] == 'EMBAIXADOR' ? 'selected' : '' ?>>EMBAIXADOR</option>
                          <option value="EMBAIXADORA"  <?php echo $dados['titulo'] == 'EMBAIXADORA' ? 'selected' : '' ?>>EMBAIXADORA</option>
                          <option value="ENGENHEIRA"  <?php echo $dados['titulo'] == 'ENGENHEIRA' ? 'selected' : '' ?>>ENGENHEIRA</option>
                          <option value="ENGENHEIRO"  <?php echo $dados['titulo'] == 'ENGENHEIRO' ? 'selected' : '' ?>>ENGENHEIRO</option>
                          <option value="ESCOTEIRO"  <?php echo $dados['titulo'] == 'ESCOTEIRO' ? 'selected' : '' ?>>ESCOTEIRO</option>
                          <option value="ESCRAVO"  <?php echo $dados['titulo'] == 'ESCRAVO' ? 'selected' : '' ?>>ESCRAVO</option>
                          <option value="ESCRITOR"  <?php echo $dados['titulo'] == 'ESCRITOR' ? 'selected' : '' ?>>ESCRITOR</option>
                          <option value="EXPEDICIONARIO"  <?php echo $dados['titulo'] == 'EXPEDICIONARIO' ? 'selected' : '' ?>>
                            EXPEDICIONARIO
                          </option>
                          <option value="FISICO"  <?php echo $dados['titulo'] == 'FISICO' ? 'selected' : '' ?>>FISICO</option>
                          <option value="FREI"  <?php echo $dados['titulo'] == 'FREI' ? 'selected' : '' ?>>FREI</option>
                          <option value="GENERAL"  <?php echo $dados['titulo'] == 'GENERAL' ? 'selected' : '' ?>>GENERAL</option>
                          <option value="GOVERNADOR"  <?php echo $dados['titulo'] == 'GOVERNADOR' ? 'selected' : '' ?>>GOVERNADOR</option>
                          <option value="GRUMETE"  <?php echo $dados['titulo'] == 'GRUMETE' ? 'selected' : '' ?>>GRUMETE</option>
                          <option value="GUARDA CIVIL METROPOLITANO"  <?php echo $dados['titulo'] == 'GUARDA CIVIL METROPOLITANO' ? 'selected' : '' ?>>
                            GUARDA CIVIL METROPOLITANO
                          </option>
                          <option value="IMACULADA"  <?php echo $dados['titulo'] == 'IMACULADA' ? 'selected' : '' ?>>IMACULADA</option>
                          <option value="IMPERADOR"  <?php echo $dados['titulo'] == 'IMPERADOR' ? 'selected' : '' ?>>IMPERADOR</option>
                          <option value="IMPERATRIZ"  <?php echo $dados['titulo'] == 'IMPERATRIZ' ? 'selected' : '' ?>>IMPERATRIZ</option>
                          <option value="INFANTE"  <?php echo $dados['titulo'] == 'INFANTE' ? 'selected' : '' ?>>INFANTE</option>
                          <option value="INSPETOR"  <?php echo $dados['titulo'] == 'INSPETOR' ? 'selected' : '' ?>>INSPETOR</option>
                          <option value="IRMA"  <?php echo $dados['titulo'] == 'IRMA' ? 'selected' : '' ?>>IRMA</option>
                          <option value="IRMAO"  <?php echo $dados['titulo'] == 'IRMAO' ? 'selected' : '' ?>>IRMAO</option>
                          <option value="IRMAOS"  <?php echo $dados['titulo'] == 'IRMAOS' ? 'selected' : '' ?>>IRMAOS</option>
                          <option value="IRMAS"  <?php echo $dados['titulo'] == '' ? 'selected' : '' ?>>IRMAS</option>
                          <option value="JORNALISTA"  <?php echo $dados['titulo'] == 'JORNALISTA' ? 'selected' : '' ?>>JORNALISTA</option>
                          <option value="LIBERTADOR"  <?php echo $dados['titulo'] == 'LIBERTADOR' ? 'selected' : '' ?>>LIBERTADOR</option>
                          <option value="LIDCO"  <?php echo $dados['titulo'] == 'LIDCO' ? 'selected' : '' ?>>LIDCO</option>
                          <option value="LIVREIRO"  <?php echo $dados['titulo'] == 'LIVREIRO' ? 'selected' : '' ?>>LIVREIRO</option>
                          <option value="LORDE"  <?php echo $dados['titulo'] == 'LORDE' ? 'selected' : '' ?>>LORDE</option>
                          <option value="MADAME"  <?php echo $dados['titulo'] == 'MADAME' ? 'selected' : '' ?>>MADAME</option>
                          <option value="MADRE"  <?php echo $dados['titulo'] == 'MADRE' ? 'selected' : '' ?>>MADRE</option>
                          <option value="MAESTRO"  <?php echo $dados['titulo'] == 'MAESTRO' ? 'selected' : '' ?>>MAESTRO</option>
                          <option value="MAJOR"  <?php echo $dados['titulo'] == 'MAJOR' ? 'selected' : '' ?>>MAJOR</option>
                          <option value="MAJOR AVIADOR"  <?php echo $dados['titulo'] == 'MAJOR AVIADOR' ? 'selected' : '' ?>>MAJOR AVIADOR</option>
                          <option value="MAJOR BRIGADEIRO"  <?php echo $dados['titulo'] == 'MAJOR BRIGADEIRO' ? 'selected' : '' ?>>
                            MAJOR BRIGADEIRO
                          </option>
                          <option value="MAQUINISTA"  <?php echo $dados['titulo'] == 'MAQUINISTA' ? 'selected' : '' ?>>MAQUINISTA</option>
                          <option value="MARECHAL"  <?php echo $dados['titulo'] == 'MARECHAL' ? 'selected' : '' ?>>MARECHAL</option>
                          <option value="MARECHAL DO AR"  <?php echo $dados['titulo'] == 'MARECHAL DO AR' ? 'selected' : '' ?>>
                            MARECHAL DO AR
                          </option>
                          <option value="MARQUES"  <?php echo $dados['titulo'] == 'MARQUES' ? 'selected' : '' ?>>MARQUES</option>
                          <option value="MARQUESA"  <?php echo $dados['titulo'] == 'MARQUESA' ? 'selected' : '' ?>>MARQUESA</option>
                          <option value="MERE"  <?php echo $dados['titulo'] == 'MERE' ? 'selected' : '' ?>>MERE</option>
                          <option value="MESTRAS"  <?php echo $dados['titulo'] == 'MESTRAS' ? 'selected' : '' ?>>MESTRAS</option>
                          <option value="MESTRE"  <?php echo $dados['titulo'] == 'MESTRE' ? 'selected' : '' ?>>MESTRE</option>
                          <option value="MESTRES"  <?php echo $dados['titulo'] == 'MESTRES' ? 'selected' : '' ?>>MESTRES</option>
                          <option value="MILITANTE"  <?php echo $dados['titulo'] == 'MILITANTE' ? 'selected' : '' ?>>MILITANTE</option>
                          <option value="MINISTRO"  <?php echo $dados['titulo'] == 'MINISTRO' ? 'selected' : '' ?>>MINISTRO</option>
                          <option value="MISSIONARIA"  <?php echo $dados['titulo'] == 'MISSIONARIA' ? 'selected' : '' ?>>MISSIONARIA</option>
                          <option value="MISSIONARIO"  <?php echo $dados['titulo'] == 'MISSIONARIO' ? 'selected' : '' ?>>MISSIONARIO</option>
                          <option value="MONGE"  <?php echo $dados['titulo'] == 'MONGE' ? 'selected' : '' ?>>MONGE</option>
                          <option value="MONSENHOR">  <?php echo $dados['titulo'] == 'MONSENHOR' ? 'selected' : '' ?>MONSENHOR</option>
                          <option value="MUNIC"  <?php echo $dados['titulo'] == 'MUNIC' ? 'selected' : '' ?>>MUNIC</option>
                          <option value="MUSICO"  <?php echo $dados['titulo'] == 'MUSICO' ? 'selected' : '' ?>>MUSICO</option>
                          <option value="NOSSA SENHORA"  <?php echo $dados['titulo'] == 'NOSSA SENHORA' ? 'selected' : '' ?>>NOSSA SENHORA</option>
                          <option value="NOSSO SENHOR"  <?php echo $dados['titulo'] == 'NOSSO SENHOR' ? 'selected' : '' ?>>NOSSO SENHOR</option>
                          <option value="OUVIDOR"  <?php echo $dados['titulo'] == 'OUVIDOR' ? 'selected' : '' ?>>OUVIDOR</option>
                          <option value="PADRE"  <?php echo $dados['titulo'] == 'PADRE' ? 'selected' : '' ?>>PADRE</option>
                          <option value="PADRES"  <?php echo $dados['titulo'] == 'PADRES' ? 'selected' : '' ?>>PADRES</option>
                          <option value="PAI"  <?php echo $dados['titulo'] == 'PAI' ? 'selected' : '' ?>>PAI</option>
                          <option value="PAPA"  <?php echo $dados['titulo'] == 'PAPA' ? 'selected' : '' ?>>PAPA</option>
                          <option value="PASTOR"  <?php echo $dados['titulo'] == 'PASTOR' ? 'selected' : '' ?>>PASTOR</option>
                          <option value="PATRIARCA"  <?php echo $dados['titulo'] == 'PATRIARCA' ? 'selected' : '' ?>>PATRIARCA</option>
                          <option value="POETA"  <?php echo $dados['titulo'] == 'POETA' ? 'selected' : '' ?>>POETA</option>
                          <option value="POETISA"  <?php echo $dados['titulo'] == 'POETISA' ? 'selected' : '' ?>>POETISA</option>
                          <option value="PREFEITO"  <?php echo $dados['titulo'] == 'PREFEITO' ? 'selected' : '' ?>>PREFEITO</option>
                          <option value="PRESIDENTE"  <?php echo $dados['titulo'] == 'PRESIDENTE' ? 'selected' : '' ?>>PRESIDENTE</option>
                          <option value="PRESIDENTE DA ACAD.BRAS.LETRAS"  <?php echo $dados['titulo'] == 'PRESIDENTE DA ACAD.BRAS.LETRAS' ? 'selected' : '' ?>>
                            PRESIDENTE DA ACAD.BRAS.LETRAS
                          </option>
                          <option value="PREVR"  <?php echo $dados['titulo'] == 'PREVR' ? 'selected' : '' ?>>PREVR</option>
                          <option value="PRIMEIRO SARGENTO"  <?php echo $dados['titulo'] == 'PRIMEIRO SARGENTO' ? 'selected' : '' ?>>
                            PRIMEIRO SARGENTO
                          </option>
                          <option value="PRIMEIRO SARGENTO PM"  <?php echo $dados['titulo'] == 'PRIMEIRO SARGENTO PM' ? 'selected' : '' ?>>
                            PRIMEIRO SARGENTO PM
                          </option>
                          <option value="PRIMEIRO TENENTE"  <?php echo $dados['titulo'] == 'PRIMEIRO TENENTE' ? 'selected' : '' ?>>
                            PRIMEIRO TENENTE
                          </option>
                          <option value="PRIMEIRO TENENTE PM"  <?php echo $dados['titulo'] == 'PRIMEIRO TENENTE PM' ? 'selected' : '' ?>>
                            PRIMEIRO TENENTE PM
                          </option>
                          <option value="PRINCESA"  <?php echo $dados['titulo'] == 'PRINCESA' ? 'selected' : '' ?>>PRINCESA</option>
                          <option value="PRINCIPE"  <?php echo $dados['titulo'] == 'PRINCIPE' ? 'selected' : '' ?>>PRINCIPE</option>
                          <option value="PROCURADOR"  <?php echo $dados['titulo'] == 'PROCURADOR' ? 'selected' : '' ?>>PROCURADOR</option>
                          <option value="PROFESSOR"  <?php echo $dados['titulo'] == 'PROFESSOR' ? 'selected' : '' ?>>PROFESSOR</option>
                          <option value="PROFESSOR DOUTOR"  <?php echo $dados['titulo'] == 'PROFESSOR DOUTOR' ? 'selected' : '' ?>>
                            PROFESSOR DOUTOR
                          </option>
                          <option value="PROFESSOR ENGENHEIRO"  <?php echo $dados['titulo'] == 'PROFESSOR ENGENHEIRO' ? 'selected' : '' ?>>
                            PROFESSOR ENGENHEIRO
                          </option>
                          <option value="PROFESSORA"  <?php echo $dados['titulo'] == 'PROFESSORA' ? 'selected' : '' ?>>PROFESSORA</option>
                          <option value="PROFETA"  <?php echo $dados['titulo'] == 'PROFETA' ? 'selected' : '' ?>>PROFETA</option>
                          <option value="PROMOTOR"  <?php echo $dados['titulo'] == 'PROMOTOR' ? 'selected' : '' ?>>PROMOTOR</option>
                          <option value="PROVEDOR"  <?php echo $dados['titulo'] == 'PROVEDOR' ? 'selected' : '' ?>>PROVEDOR</option>
                          <option value="PROVEDOR MOR"  <?php echo $dados['titulo'] == 'PROVEDOR MOR' ? 'selected' : '' ?>>PROVEDOR MOR</option>
                          <option value="RABINO"  <?php echo $dados['titulo'] == 'RABINO' ? 'selected' : '' ?>>RABINO</option>
                          <option value="RADIALISTA"  <?php echo $dados['titulo'] == 'RADIALISTA' ? 'selected' : '' ?>>RADIALISTA</option>
                          <option value="RAINHA"  <?php echo $dados['titulo'] == 'RAINHA' ? 'selected' : '' ?>>RAINHA</option>
                          <option value="REGENTE"  <?php echo $dados['titulo'] == 'REGENTE' ? 'selected' : '' ?>>REGENTE</option>
                          <option value="REI"  <?php echo $dados['titulo'] == 'REI' ? 'selected' : '' ?>>REI</option>
                          <option value="REVERENDO"  <?php echo $dados['titulo'] == 'REVERENDO' ? 'selected' : '' ?>>REVERENDO</option>
                          <option value="RUA"  <?php echo $dados['titulo'] == 'RUA' ? 'selected' : '' ?>>RUA</option>
                          <option value="SACERDOTE"  <?php echo $dados['titulo'] == 'SACERDOTE' ? 'selected' : '' ?>>SACERDOTE</option>
                          <option value="SANTA"  <?php echo $dados['titulo'] == 'SANTA' ? 'selected' : '' ?>>SANTA</option>
                          <option value="SANTO"  <?php echo $dados['titulo'] == 'SANTO' ? 'selected' : '' ?>>SANTO</option>
                          <option value="SAO"  <?php echo $dados['titulo'] == 'SAO' ? 'selected' : '' ?>>SAO</option>
                          <option value="SARGENTO"  <?php echo $dados['titulo'] == 'SARGENTO' ? 'selected' : '' ?>>SARGENTO</option>
                          <option value="SARGENTO MOR"  <?php echo $dados['titulo'] == 'SARGENTO MOR' ? 'selected' : '' ?>>SARGENTO MOR</option>
                          <option value="SARGENTO PM"  <?php echo $dados['titulo'] == 'SARGENTO PM' ? 'selected' : '' ?>>SARGENTO PM</option>
                          <option value="SEGUNDO SARGENTO"  <?php echo $dados['titulo'] == 'SEGUNDO SARGENTO' ? 'selected' : '' ?>>
                            SEGUNDO SARGENTO
                          </option>
                          <option value="SEGUNDO SARGENTO PM"  <?php echo $dados['titulo'] == 'SEGUNDO SARGENTO PM' ? 'selected' : '' ?>>
                            SEGUNDO SARGENTO PM
                          </option>
                          <option value="SEGUNDO TENENTE"  <?php echo $dados['titulo'] == 'SEGUNDO TENENTE' ? 'selected' : '' ?>>
                            SEGUNDO TENENTE
                          </option>
                          <option value="SENADOR"  <?php echo $dados['titulo'] == 'SENADOR' ? 'selected' : '' ?>>SENADOR</option>
                          <option value="SENHOR"  <?php echo $dados['titulo'] == 'SENHOR' ? 'selected' : '' ?>>SENHOR</option>
                          <option value="SENHORA"  <?php echo $dados['titulo'] == 'SENHORA' ? 'selected' : '' ?>>SENHORA</option>
                          <option value="SERTANISTA"  <?php echo $dados['titulo'] == 'SERTANISTA' ? 'selected' : '' ?>>SERTANISTA</option>
                          <option value="SINHA"  <?php echo $dados['titulo'] == 'SINHA' ? 'selected' : '' ?>>SINHA</option>
                          <option value="SIR"  <?php echo $dados['titulo'] == 'SIR' ? 'selected' : '' ?>>SIR</option>
                          <option value="SOCIOLOGO"  <?php echo $dados['titulo'] == 'SOCIOLOGO' ? 'selected' : '' ?>>SOCIOLOGO</option>
                          <option value="SOLDADO"  <?php echo $dados['titulo'] == 'SOLDADO' ? 'selected' : '' ?>>SOLDADO</option>
                          <option value="SOLDADO PM"  <?php echo $dados['titulo'] == 'SOLDADO PM' ? 'selected' : '' ?>>SOLDADO PM</option>
                          <option value="SOROR"  <?php echo $dados['titulo'] == 'SOROR' ? 'selected' : '' ?>>SOROR</option>
                          <option value="SUB TENENTE"  <?php echo $dados['titulo'] == 'SUB TENENTE' ? 'selected' : '' ?>>SUB TENENTE</option>
                          <option value="TENENTE"  <?php echo $dados['titulo'] == 'TENENTE' ? 'selected' : '' ?>>TENENTE</option>
                          <option value="TENENTE AVIADOR"  <?php echo $dados['titulo'] == 'TENENTE AVIADOR' ? 'selected' : '' ?>>
                            TENENTE AVIADOR
                          </option>
                          <option value="TENENTE BRIGADEIRO"  <?php echo $dados['titulo'] == 'TENENTE BRIGADEIRO' ? 'selected' : '' ?>>
                            TENENTE BRIGADEIRO
                          </option>
                          <option value="TENENTE CORONE"  <?php echo $dados['titulo'] == 'TENENTE CORONE' ? 'selected' : '' ?>>
                            TENENTE CORONEL
                          </option>
                          <option value="TENENTE CORONEL PM"  <?php echo $dados['titulo'] == 'TENENTE CORONEL PM' ? 'selected' : '' ?>>
                            TENENTE CORONEL PM
                          </option>
                          <option value="TEOLOGO" <?php echo $dados['titulo'] == 'TEOLOGO' ? 'selected' : '' ?>>TEOLOGO</option>
                          <option value="TERCEIRO SARGENTO"  <?php echo $dados['titulo'] == 'TERCEIRO SARGENTO' ? 'selected' : '' ?>>
                            TERCEIRO SARGENTO
                          </option>
                          <option value="TERCEIRO SARGENTO PM"  <?php echo $dados['titulo'] == 'TERCEIRO SARGENTO PM' ? 'selected' : '' ?>>
                            TERCEIRO SARGENTO PM
                          </option>
                          <option value="TIA"  <?php echo $dados['titulo'] == 'TIA' ? 'selected' : '' ?>>TIA</option>
                          <option value="VEREADOR"  <?php echo $dados['titulo'] == 'VEREADOR' ? 'selected' : '' ?>>VEREADOR</option>
                          <option value="VICE ALMIRANTE"  <?php echo $dados['titulo'] == 'VICE ALMIRANTE' ? 'selected' : '' ?>>
                            VICE ALMIRANTE
                          </option>
                          <option value="VICE REI"  <?php echo $dados['titulo'] == 'VICE REI' ? 'selected' : '' ?>>VICE REI</option>
                          <option value="VIGARIO"  <?php echo $dados['titulo'] == 'VIGARIO' ? 'selected' : '' ?>>VIGARIO</option>
                          <option value="VISCONDE"  <?php echo $dados['titulo'] == 'VISCONDE' ? 'selected' : '' ?>>VISCONDE</option>
                          <option value="VISCONDESSA"  <?php echo $dados['titulo'] == 'VISCONDESSA' ? 'selected' : '' ?>>VISCONDESSA</option>
                          <option value="VOLUNTARIO"  <?php echo $dados['titulo'] == 'VOLUNTARIO' ? 'selected' : '' ?>>VOLUNTARIO</option>
                        </select>
                      </div>
                    </div>

                    <div class="mb-3">
                      <label>Logradouro:</label>
                      <h6>
                        Preencher apenas com o nome principal do logradouro
                        sem o título e sem preposição (de, dos, etc), sem
                        acentuação e sem cedilha. Ex. para "Praça do
                        Patriarca", escrever só "Patriarca"
                      </h6>
                      <input type="text" class="form-control" id="logradouro" name="logradouro" value="<?php echo $dados['logradouro'] ?>" disabled/>
                    </div>
                    <div class="mb-3">
                      <label>Número:</label>
                      <h6>Ingressar o Número Atual do endereço</h6>
                      <input type="text" class="form-control" id="numeroEndereco" name="numeroEndereco" value="<?php echo $dados['numeroEndereco'] ?>" disabled />
                    </div>
                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <label>Distrito</label>
                        <h6>
                          Escolher o Distrito. Utilizar o GEOSAMPA como
                          referência. Camada: Limites Administrativos -
                          Distrito
                        </h6>
                        <select id="distrito" class="custom-select d-block w-100" name="distrito" disabled >
                          <option value="" selected >Selecionar distrito...</option>
                          <option value="Água Rasa">Água Rasa</option>
                          <option value="Alto de Pinheiros">
                            Alto de Pinheiros
                          </option>
                          <option value="Anhanguera"  <?php echo $dados['distrito'] == 'Anhanguera' ? 'selected' : '' ?>>Anhanguera</option>
                          <option value="Aricanduva" <?php echo $dados['distrito'] == 'Aricanduva' ? 'selected' : '' ?>>Aricanduva</option>
                          <option value="Artur Alvim" <?php echo $dados['distrito'] == 'Artur Alvim' ? 'selected' : '' ?>>Artur Alvim</option>
                          <option value="Barra Funda" <?php echo $dados['distrito'] == 'Barra Funda' ? 'selected' : '' ?>>Barra Funda</option>
                          <option value="Bela Vista" <?php echo $dados['distrito'] == 'Bela Vista' ? 'selected' : '' ?>>Bela Vista</option>
                          <option value="Belém" <?php echo $dados['distrito'] == 'Belém' ? 'selected' : '' ?>>Belém</option>
                          <option value="Bom Retiro" <?php echo $dados['distrito'] == 'Bom Retiro' ? 'selected' : '' ?>>Bom Retiro</option>
                          <option value="Brás" <?php echo $dados['distrito'] == 'Brás' ? 'selected' : '' ?>>Brás</option>
                          <option value="Brasilândia" <?php echo $dados['distrito'] == 'Brasilândia' ? 'selected' : '' ?>>Brasilândia</option>
                          <option value="Butantã" <?php echo $dados['distrito'] == 'Butantã' ? 'selected' : '' ?>>Butantã</option>
                          <option value="Cachoeirinha" <?php echo $dados['distrito'] == 'Cachoeirinha' ? 'selected' : '' ?>>Cachoeirinha</option>
                          <option value="Cambuci" <?php echo $dados['distrito'] == 'Cambuci' ? 'selected' : '' ?>>Cambuci</option>
                          <option value="Campo Belo" <?php echo $dados['distrito'] == 'Campo Belo' ? 'selected' : '' ?>>Campo Belo</option>
                          <option value="Campo Grande" <?php echo $dados['distrito'] == 'Campo Grande' ? 'selected' : '' ?>>Campo Grande</option>
                          <option value="Campo Limpo" <?php echo $dados['distrito'] == 'Campo Limpo' ? 'selected' : '' ?>>Campo Limpo</option>
                          <option value="Cangaíba" <?php echo $dados['distrito'] == 'Cangaíba' ? 'selected' : '' ?>>Cangaíba</option>
                          <option value="Capão Redondo" <?php echo $dados['distrito'] == 'Capão Redondo' ? 'selected' : '' ?>>Capão Redondo</option>
                          <option value="Carrão" <?php echo $dados['distrito'] == 'Carrão' ? 'selected' : '' ?>>Carrão</option>
                          <option value="Casa Verde" <?php echo $dados['distrito'] == 'Casa Verde' ? 'selected' : '' ?>>Casa Verde</option>
                          <option value="Cidade Ademar" <?php echo $dados['distrito'] == 'Cidade Ademar' ? 'selected' : '' ?>>Cidade Ademar</option>
                          <option value="Cidade Dutra" <?php echo $dados['distrito'] == 'Cidade Dutra' ? 'selected' : '' ?>>Cidade Dutra</option>
                          <option value="Cidade Líder" <?php echo $dados['distrito'] == 'Cidade Líder' ? 'selected' : '' ?>>Cidade Líder</option>
                          <option value="Cidade Tiradentes" <?php echo $dados['distrito'] == 'Cidade Tiradentes' ? 'selected' : '' ?>>
                            Cidade Tiradentes
                          </option>
                          <option value="Consolação" <?php echo $dados['distrito'] == 'Consolação' ? 'selected' : '' ?>>Consolação</option>
                          <option value="Cursino" <?php echo $dados['distrito'] == 'Cursino' ? 'selected' : '' ?>>Cursino</option>
                          <option value="Ermelino Matarazzo" <?php echo $dados['distrito'] == 'Ermelino Matarazzo' ? 'selected' : '' ?>>
                            Ermelino Matarazzo
                          </option>
                          <option value="Freguesia do Ó" <?php echo $dados['distrito'] == 'Freguesia do Ó' ? 'selected' : '' ?>>
                            Freguesia do Ó
                          </option>
                          <option value="Grajaú" <?php echo $dados['distrito'] == 'Grajaú' ? 'selected' : '' ?>>Grajaú</option>
                          <option value="Guaianases" <?php echo $dados['distrito'] == 'Guaianases' ? 'selected' : '' ?>>Guaianases</option>
                          <option value="Iguatemi" <?php echo $dados['distrito'] == 'Iguatemi' ? 'selected' : '' ?>>Iguatemi</option>
                          <option value="Ipiranga" <?php echo $dados['distrito'] == 'Ipiranga' ? 'selected' : '' ?>>Ipiranga</option>
                          <option value="Itaim Bibi" <?php echo $dados['distrito'] == 'Itaim Bibi' ? 'selected' : '' ?>>Itaim Bibi</option>
                          <option value="Itaim Paulista" <?php echo $dados['distrito'] == 'Itaim Paulista' ? 'selected' : '' ?>>
                            Itaim Paulista
                          </option>
                          <option value="Itaquera" <?php echo $dados['distrito'] == 'Itaquera' ? 'selected' : '' ?>>Itaquera</option>
                          <option value="Jabaquara" <?php echo $dados['distrito'] == 'Jabaquara' ? 'selected' : '' ?>>Jabaquara</option>
                          <option value="Jaçanã" <?php echo $dados['distrito'] == 'Jaçanã' ? 'selected' : '' ?>>Jaçanã</option>
                          <option value="Jaraguá" <?php echo $dados['distrito'] == 'Jaraguá' ? 'selected' : '' ?>>Jaraguá</option>
                          <option value="Jaguaré" <?php echo $dados['distrito'] == 'Jaguaré' ? 'selected' : '' ?>>Jaguaré</option>
                          <option value="Jaraguá" <?php echo $dados['distrito'] == 'Jaraguá' ? 'selected' : '' ?>>Jaraguá</option>
                          <option value="Jardim Ângela" <?php echo $dados['distrito'] == 'Jardim Ângela' ? 'selected' : '' ?>>Jardim Ângela</option>
                          <option value="Jardim Helena" <?php echo $dados['distrito'] == 'Jardim Helena' ? 'selected' : '' ?>>Jardim Helena</option>
                          <option value="Jardim Paulista" <?php echo $dados['distrito'] == 'Jardim Paulista' ? 'selected' : '' ?>>
                            Jardim Paulista
                          </option>
                          <option value="Jardim São Luís" <?php echo $dados['distrito'] == 'Jardim São Luís' ? 'selected' : '' ?>>
                            Jardim São Luís
                          </option>
                          <option value="José Bonifácio" <?php echo $dados['distrito'] == 'José Bonifácio' ? 'selected' : '' ?>>
                            José Bonifácio
                          </option>
                          <option value="Lajeado" <?php echo $dados['distrito'] == 'Lajeado' ? 'selected' : '' ?>>Lajeado</option>
                          <option value="Lapa" <?php echo $dados['distrito'] == 'Lapa' ? 'selected' : '' ?>>Lapa</option>
                          <option value="Liberdade" <?php echo $dados['distrito'] == 'Liberdade' ? 'selected' : '' ?>>Liberdade</option>
                          <option value="Limão" <?php echo $dados['distrito'] == 'Limão' ? 'selected' : '' ?>>Limão</option>
                          <option value="Mandaqui" <?php echo $dados['distrito'] == 'Mandaqui' ? 'selected' : '' ?>>Mandaqui</option>
                          <option value="Marsilac" <?php echo $dados['distrito'] == 'Marsilac' ? 'selected' : '' ?>>Marsilac</option>
                          <option value="Moema" <?php echo $dados['distrito'] == 'Moema' ? 'selected' : '' ?>>Moema</option>
                          <option value="Mooca" <?php echo $dados['distrito'] == 'Mooca' ? 'selected' : '' ?>>Mooca</option>
                          <option value="Morumbi" <?php echo $dados['distrito'] == 'Morumbi' ? 'selected' : '' ?>>Morumbi</option>
                          <option value="Parelheiros" <?php echo $dados['distrito'] == 'Parelheiros' ? 'selected' : '' ?>>Parelheiros</option>
                          <option value="Pari" <?php echo $dados['distrito'] == 'Pari' ? 'selected' : '' ?>>Pari</option>
                          <option value="Parque do Carmo" <?php echo $dados['distrito'] == 'Parque do Carmo' ? 'selected' : '' ?>>
                            Parque do Carmo
                          </option>
                          <option value="Pedreira" <?php echo $dados['distrito'] == 'Pedreira' ? 'selected' : '' ?>>Pedreira</option>
                          <option value="Penha" <?php echo $dados['distrito'] == 'Penha' ? 'selected' : '' ?>>Penha</option>
                          <option value="Perdizes" <?php echo $dados['distrito'] == 'Perdizes' ? 'selected' : '' ?>>Perdizes</option>
                          <option value="Perus" <?php echo $dados['distrito'] == 'Perus' ? 'selected' : '' ?>>Perus</option>
                          <option value="Pinheiros" <?php echo $dados['distrito'] == 'Pinheiros' ? 'selected' : '' ?>>Pinheiros</option>
                          <option value="Pirituba" <?php echo $dados['distrito'] == 'Pirituba' ? 'selected' : '' ?>>Pirituba</option>
                          <option value="Ponte Rasa" <?php echo $dados['distrito'] == 'Ponte Rasa' ? 'selected' : '' ?>>Ponte Rasa</option>
                          <option value="Raposo Tavares" <?php echo $dados['distrito'] == 'Raposo Tavares' ? 'selected' : '' ?>>
                            Raposo Tavares
                          </option>
                          <option value="República" <?php echo $dados['distrito'] == 'República' ? 'selected' : '' ?>>República</option>
                          <option value="Rio Pequeno"> <?php echo $dados['distrito'] == 'Rio Pequeno' ? 'selected' : '' ?>Rio Pequeno</option>
                          <option value="Sacomã" <?php echo $dados['distrito'] == 'Sacomã' ? 'selected' : '' ?>>Sacomã</option>
                          <option value="Santa Cecília" <?php echo $dados['distrito'] == 'Santa Cecília' ? 'selected' : '' ?>>Santa Cecília</option>
                          <option value="Santana" <?php echo $dados['distrito'] == 'Santana' ? 'selected' : '' ?>>Santana</option>
                          <option value="Santo Amaro" <?php echo $dados['distrito'] == 'Santo Amaro' ? 'selected' : '' ?>>Santo Amaro</option>
                          <option value="São Domingos" <?php echo $dados['distrito'] == 'São Domingos' ? 'selected' : '' ?>>São Domingos</option>
                          <option value="São Lucas" <?php echo $dados['distrito'] == 'São Lucas' ? 'selected' : '' ?>>São Lucas</option>
                          <option value="São Mateus" <?php echo $dados['distrito'] == 'São Mateus' ? 'selected' : '' ?>>São Mateus</option>
                          <option value="São Miguel" <?php echo $dados['distrito'] == 'São Miguel' ? 'selected' : '' ?>>São Miguel</option>
                          <option value="São Rafael" <?php echo $dados['distrito'] == 'São Rafael' ? 'selected' : '' ?>>São Rafael</option>
                          <option value="Sapopemba" <?php echo $dados['distrito'] == 'Sapopemba' ? 'selected' : '' ?>>Sapopemba</option>
                          <option value="Saúde" <?php echo $dados['distrito'] == 'Saúde' ? 'selected' : '' ?>>Saúde</option>
                          <option value="Sé" <?php echo $dados['distrito'] == 'Sé' ? 'selected' : '' ?>>Sé</option>
                          <option value="Socorro" <?php echo $dados['distrito'] == 'Socorro' ? 'selected' : '' ?>>Socorro</option>
                          <option value="Tatuapé" <?php echo $dados['distrito'] == 'Tatuapé' ? 'selected' : '' ?>>Tatuapé</option>
                          <option value="Tremembé" <?php echo $dados['distrito'] == 'Tremembé' ? 'selected' : '' ?>>Tremembé</option>
                          <option value="Tucuruvi" <?php echo $dados['distrito'] == 'Tucuruvi' ? 'selected' : '' ?>>Tucuruvi</option>
                          <option value="Vila Andrade" <?php echo $dados['distrito'] == 'Vila Andrade' ? 'selected' : '' ?>>Vila Andrade</option>
                          <option value="Vila Curuçá" <?php echo $dados['distrito'] == 'Vila Curuçá' ? 'selected' : '' ?>>Vila Curuçá</option>
                          <option value="Vila Formosa" <?php echo $dados['distrito'] == 'Vila Formosa' ? 'selected' : '' ?>>Vila Formosa</option>
                          <option value="Vila Guilherme" <?php echo $dados['distrito'] == 'Vila Guilherme' ? 'selected' : '' ?>>
                            Vila Guilherme
                          </option>
                          <option value="Vila Jacuí" <?php echo $dados['distrito'] == 'Vila Jacuí' ? 'selected' : '' ?>>Vila Jacuí</option>
                          <option value="Vila Leopoldina" <?php echo $dados['distrito'] == 'Vila Leopoldina' ? 'selected' : '' ?>>
                            Vila Leopoldina
                          </option>
                          <option value="Vila Maria" <?php echo $dados['distrito'] == 'Vila Maria' ? 'selected' : '' ?>>Vila Maria</option>
                          <option value="Vila Mariana" <?php echo $dados['distrito'] == 'Vila Mariana' ? 'selected' : '' ?>>Vila Mariana</option>
                          <option value="Vila Matilde" <?php echo $dados['distrito'] == 'Vila Matilde' ? 'selected' : '' ?>>Vila Matilde</option>
                          <option value="Vila Medeiros" <?php echo $dados['distrito'] == 'Vila Medeiros' ? 'selected' : '' ?>>Vila Medeiros</option>
                          <option value="Vila Prudente" <?php echo $dados['distrito'] == 'Vila Prudente' ? 'selected' : '' ?>>Vila Prudente</option>
                          <option value="Vila Sônia" <?php echo $dados['distrito'] == 'Vila Sônia' ? 'selected' : '' ?>>Vila Sônia</option>
                        </select>
                      </div>
                      <div class="col-md-6 mb-3">
                        <label for="state">Prefeitura Regional</label>
                        <h6>
                          Escolher o a Prefeitura Regional. Utilizar o
                          GEOSAMPA como referência. Camada: Limites
                          Administrativos - Prefeituras Regionais
                        </h6>
                        <select id="prefeituraRegional" class="custom-select d-block w-100" name="prefeituraRegional" disabled>
                          <option value="" selected >
                            Selecionar uma classificação....
                          </option>
                          <option value="Aricanduva/Vila Formosa" <?php echo $dados['prefeituraRegional'] == 'Aricanduva/Vila Formosa' ? 'selected' : '' ?>>
                            Aricanduva/Vila Formosa
                          </option>
                          <option value="Butantã" <?php echo $dados['prefeituraRegional'] == 'Butantã' ? 'selected' : '' ?>>Butantã</option>
                          <option value="Campo Limpo" <?php echo $dados['prefeituraRegional'] == 'Campo Limpo' ? 'selected' : '' ?>> Campo Limpo</option>
                          <option value="Capela do Socorro" <?php echo $dados['prefeituraRegional'] == 'Capela do Socorro' ? 'selected' : '' ?>>
                            Capela do Socorro
                          </option>
                          <option value="Casa Verde" <?php echo $dados['prefeituraRegional'] == 'Casa Verde"' ? 'selected' : '' ?>>Casa Verde</option>
                          <option value="Cidade Ademar" <?php echo $dados['prefeituraRegional'] == 'Cidade Ademar' ? 'selected' : '' ?>>Cidade Ademar</option>
                          <option value="Cidade Tiradentes" <?php echo $dados['prefeituraRegional'] == 'Cidade Tiradentes' ? 'selected' : '' ?>>
                            Cidade Tiradentes
                          </option>
                          <option value="Ermelino Matarazzo" <?php echo $dados['prefeituraRegional'] == 'Ermelino Matarazzo' ? 'selected' : '' ?>>
                            Ermelino Matarazzo
                          </option>
                          <option value="Freguesia do Ó/Brasilândia" <?php echo $dados['prefeituraRegional'] == 'Freguesia do Ó/Brasilândia' ? 'selected' : '' ?>>
                            Freguesia do Ó/Brasilândia
                          </option>
                          <option value="Guaianases" <?php echo $dados['prefeituraRegional'] == 'Guaianases' ? 'selected' : '' ?>>Guaianases</option>
                          <option value="Ipiranga" <?php echo $dados['prefeituraRegional'] == 'Ipiranga' ? 'selected' : '' ?>>Ipiranga</option>
                          <option value="Itaim Paulista" <?php echo $dados['prefeituraRegional'] == 'Itaim Paulista' ? 'selected' : '' ?>>
                            Itaim Paulista
                          </option>
                          <option value="Itaquera" <?php echo $dados['prefeituraRegional'] == 'Itaquera' ? 'selected' : '' ?>>Itaquera</option>
                          <option value="Jabaquara" <?php echo $dados['prefeituraRegional'] == 'Jabaquara' ? 'selected' : '' ?>>Jabaquara</option>
                          <option value="Jaçanã/Temembé" <?php echo $dados['prefeituraRegional'] == 'Jaçanã/Temembé' ? 'selected' : '' ?>>
                            Jaçanã/Temembé
                          </option>
                          <option value="Lapa" <?php echo $dados['prefeituraRegional'] == 'Lapa' ? 'selected' : '' ?>>Lapa</option>
                          <option value="M Boi Mirim" <?php echo $dados['prefeituraRegional'] == 'M Boi Mirim' ? 'selected' : '' ?>>M'Boi Mirim</option>
                          <option value="Mooca" <?php echo $dados['prefeituraRegional'] == 'Mooca' ? 'selected' : '' ?>>Mooca</option>
                          <option value="Parelheiros" <?php echo $dados['prefeituraRegional'] == 'Parelheiros' ? 'selected' : '' ?>>Parelheiros</option>
                          <option value="Penha" <?php echo $dados['prefeituraRegional'] == 'Penha' ? 'selected' : '' ?>>Penha</option>
                          <option value="Perus" <?php echo $dados['prefeituraRegional'] == 'Perus' ? 'selected' : '' ?>>Perus</option>
                          <option value="Pinheiros" <?php echo $dados['prefeituraRegional'] == 'Pinheiros' ? 'selected' : '' ?>>Pinheiros</option>
                          <option value="Pirituba/Jaraguá" <?php echo $dados['prefeituraRegional'] == 'Pirituba/Jaraguá' ? 'selected' : '' ?>>
                            Pirituba/Jaraguá
                          </option>
                          <option value="Santana/Tucuruvi" <?php echo $dados['prefeituraRegional'] == 'Santana/Tucuruvi' ? 'selected' : '' ?>>
                            Santana/Tucuruvi
                          </option>
                          <option value="Santo Amaro" <?php echo $dados['prefeituraRegional'] == 'Santo Amaro' ? 'selected' : '' ?>>Santo Amaro</option>
                          <option value="São Mateus" <?php echo $dados['prefeituraRegional'] == 'São Mateus' ? 'selected' : '' ?>>São Mateus</option>
                          <option value="São Miguel Paulista" <?php echo $dados['prefeituraRegional'] == 'São Miguel Paulista' ? 'selected' : '' ?>>
                            São Miguel Paulista
                          </option>
                          <option value="Sapobemba" <?php echo $dados['prefeituraRegional'] == 'Sapobemba' ? 'selected' : '' ?>>Sapobemba</option>
                          <option value="Sé" <?php echo $dados['prefeituraRegional'] == 'Sé' ? 'selected' : '' ?>>Sé</option>
                          <option value="Vila Maria/Vila Guilherme" <?php echo $dados['prefeituraRegional'] == 'Vila Maria/Vila Guilherme' ? 'selected' : '' ?>>
                            Vila Maria/Vila Guilherme
                          </option>
                          <option value="Vila Mariana" <?php echo $dados['prefeituraRegional'] == 'Vila Mariana"' ? 'selected' : '' ?>>Vila Mariana</option>
                          <option value="Vila Prudente" <?php echo $dados['prefeituraRegional'] == 'Vila Prudente' ? 'selected' : '' ?>>Vila Prudente</option>
                        </select>
                      </div>
                    </div>
                    <div class="mb-3">
                      <label>Setor:</label>
                      <h6>
                        Ingressar o número do setor com três dígitos, inserir
                        letra "x" antes do número. Ex: Setor 006, inserir:
                        x006 Utilizar o GEOSAMPA como referência. Camada:
                        Cadastro / Cadastro Fiscal ou o CIT - Pesquisa por
                        endereço
                      </h6>
                      <input type="text" class="form-control" id="setor" name="setor"  value="<?php echo $dados['setor'] ?>" disabled/>
                    </div>
                    <div class="mb-3">
                      <label>Quadra:</label>
                      <h6>
                        Ingressar o número da quadra com três dígitos, inserir
                        letra "x" antes. Ex: Quadra 012, inserir: x012
                        Utilizar o GEOSAMPA como referência. Camada: Cadastro
                        / Cadastro Fiscal ou o CIT - Pesquisa por endereço
                      </h6>
                      <input type="text" class="form-control" id="quadra" name="quadra" value="<?php echo $dados['quadra'] ?>" disabled />
                    </div>
                    <div class="mb-3">
                      <label>Lote:</label>
                      <h6>
                        Ingressar o número do lote com quatro dígitos, inserir
                        letra "x" antes. Ex: Lote 0026, inserir: x0026
                        Utilizar o GEOSAMPA como referência. Baixar o Croqui
                        Patrimonial através da Pesquisa por Setor e Quadra ou
                        o CIT - Pesquisa por endereço
                      </h6>
                      <input type="text" class="form-control" id="lote" name="lote" value="<?php echo $dados['lote'] ?>" disabled />
                    </div>
                    <div class="mb-3 p-2 subtitulos">
                      <h4>4. Ficha Técnica</h4>
                    </div>
                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <label for="state">Autor do projeto original</label>
                        <input type="text" class="form-control" id="autorOriginal" name="autorOriginal"  value="<?php echo $dados['autorOriginal'] ?>" disabled/>
                      </div>
                      <div class="col-md-6 mb-3">
                        <label for="state">Construtor</label>
                        <input type="text" class="form-control" id="construtor" name="construtor" value="<?php echo $dados['construtor'] ?>" disabled/>
                      </div>
                    </div>
                   
                    <label>Data de Construção:</label>
                    <div class="mb-3">
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="dataAproximada" id="datasim"  value="datasim" disabled  <?php echo $dados['dataAproximada'] == 'datasim' ? 'checked' : null ?>> 
                        <label class="form-check-label" for="datasim">
                          Data aproximada
                        </label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="dataAproximada" id="datanao" value="datanao" disabled <?php echo $dados['dataAproximada'] == 'datanao' ? 'checked' : null ?>>
                        <label class="form-check-label" for="datanao">
                          Data não aproximada
                        </label>
                      </div>
                      <input type="text" class="form-control" id="dataConstrucao" name="dataConstrucao" value="<?php echo $dados['dataConstrucao'] ?>" disabled/>
                    </div>

                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <label>Estilo Arquitetônico</label>
                        <select id="estiloArquitetonico" class="custom-select d-block w-100" name="estiloArquitetonico" disabled>
                          <option value="" selected >
                            Selecionar uma classificação....
                          </option>
                          <option value="Art Deco" <?php echo $dados['estiloArquitetonico'] == 'Art Deco' ? 'selected' : '' ?>>Art Deco</option>
                          <option value="Art Nouveau" <?php echo $dados['estiloArquitetonico'] == 'Art Nouveau' ? 'selected' : '' ?>>Art Nouveau</option>
                          <option value="Bandeirista" <?php echo $dados['estiloArquitetonico'] == 'Bandeirista' ? 'selected' : '' ?>>Bandeirista</option>
                          <option value="Colonial" <?php echo $dados['estiloArquitetonico'] == 'Colonial' ? 'selected' : '' ?>>Colonial</option>
                          <option value="Eclético" <?php echo $dados['estiloArquitetonico'] == 'Eclético' ? 'selected' : '' ?>>Eclético</option>
                          <option value="Moderno" <?php echo $dados['estiloArquitetonico'] == 'Moderno' ? 'selected' : '' ?>>Moderno</option>
                          <option value="Neoclássico" <?php echo $dados['estiloArquitetonico'] == 'Neoclássico' ? 'selected' : '' ?>>Neoclássico</option>
                          <option value="Neocolonial" <?php echo $dados['estiloArquitetonico'] == 'Neocolonial' ? 'selected' : '' ?>>Neocolonial</option>
                          <option value="Neogótico" <?php echo $dados['estiloArquitetonico'] == 'Neogótico' ? 'selected' : '' ?>>Neogótico</option>
                        </select>
                      </div>
                      <div class="col-md-6 mb-3">
                        <label>Técnica Construtiva</label>
                        <select id="tecnicaConstrutiva" class="custom-select d-block w-100" name="tecnicaConstrutiva" disabled>
                          <option value="" selected >
                            Selecionar uma classificação....
                          </option>
                          <option value="Adobe" <?php echo $dados['tecnicaConstrutiva'] == 'Adob' ? 'selected' : '' ?>>Adobe</option>
                          <option value="Alvenaria de tijolos" <?php echo $dados['tecnicaConstrutiva'] == 'Alvenaria de tijolos' ? 'selected' : '' ?>>
                            Alvenaria de tijolos
                          </option>
                          <option value="Concreto armado" <?php echo $dados['tecnicaConstrutiva'] == 'Concreto armado' ? 'selected' : '' ?>>
                            Concreto armado
                          </option>
                          <option value="Taipa-de-mão | Pau-a-pique" <?php echo $dados['tecnicaConstrutiva'] == 'Taipa-de-mão | Pau-a-pique' ? 'selected' : '' ?>>
                            Taipa-de-mão | Pau-a-pique
                          </option>
                          <option value="Taipa-de-pilão" <?php echo $dados['tecnicaConstrutiva'] == 'Taipa-de-pilão' ? 'selected' : '' ?>>
                            Taipa-de-pilão
                          </option>
                          <option value="Técnica Mista" <?php echo $dados['tecnicaConstrutiva'] == 'Técnica Mista' ? 'selected' : '' ?>>Técnica Mista</option>
                        </select>
                      </div>
                    </div>

                    <div class="mb-3">
                      <label>Número de Pavimentos:</label>
                      <h6>
                        Inserir apenas o número de pavimentos. Porão, Sótão,
                        Alpendre, etc inserir no campo: Outras informações
                      </h6>
                      <input type="text" class="form-control" id="numeroPavimentos" name="numeroPavimentos" value="<?php echo $dados['numeroPavimentos'] ?>" disabled/>
                    </div>
                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <label>Área do lote (m²):</label>
                        <input type="text" class="form-control" id="areaLote" name="areaLote" value="<?php echo $dados['areaLote']?>" onkeyup="formatarCampo(this);" disabled/>
                      </div>
                      <div class="col-md-6 mb-3">
                        <label>Área construída (m²):</label>
                        <input type="text" class="form-control" id="areaConstruida" name="areaConstruida" value="<?php echo $dados['areaConstruida']?>" onkeyup="formatarCampo(this);" disabled/>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <label>Grau de Tombamento:</label>
                        <input type="text" class="form-control" id="grauTombamento" name="grauTombamento" value="<?php echo $dados['grauTombamento']?>" disabled />
                      </div>
                      <div class="col-md-6 mb-3">
                        <label>Grau de alteração: </label>
                        <select id="grauAlteracao" class="custom-select d-block w-100" name="grauAlteracao" disabled>
                          <option value="" selected >
                            Selecionar uma classificação....
                          </option>
                          <option value="Preservado" <?php echo $dados['grauAlteracao'] == 'Preservado' ? 'selected' : '' ?>>Preservado</option>
                          <option value="Alterado" <?php echo $dados['grauAlteracao'] == 'Alterado' ? 'selected' : '' ?>>Alterado</option>
                          <option value="Descaracterizado" <?php echo $dados['grauAlteracao'] == 'Descaracterizado' ? 'selected' : '' ?>>Descaracterizado</option>
                        </select>
                      </div>
                    </div>
                    <div class="mb-3">
                      <label>Comentário do Grau de Alteração:</label>
                      <h6>
                        Inserir breve descrição quando houver informações
                        relevantes sobre o assunto
                      </h6>
                      <textarea id="comentarioGrauAlteracao" class="form-control" aria-label="With textarea" name="comentarioGrauAlteracao" disabled><?php echo $dados['comentarioGrauAlteracao'] ?></textarea>
                    </div>
                    <div class="mb-3">
                      <label>Estado de Conservação:</label>
                      <h6>
                        Selecionar alternativa que melhor descreva o estado de
                        preservação do bem, ou seja, se ele mantém suas
                        características de estilo e ambiência preservadas.
                      </h6>
                      <select id="grauEstadoConservacao" class="custom-select d-block w-100" name="grauEstadoConservacao" disabled>
                        <option value="" selected >
                          Selecionar uma classificação....
                        </option>
                        <option value="Bom" <?php echo $dados['grauEstadoConservacao'] == 'Bom' ? 'selected' : '' ?>>Bom</option>
                        <option value="Regular" <?php echo $dados['grauEstadoConservacao'] == 'Regular' ? 'selected' : '' ?>>Regular</option>
                        <option value="Ruim" <?php echo $dados['grauEstadoConservacao'] == 'Ruim' ? 'selected' : '' ?>>Ruim</option>
                      </select>
                    </div>

                    <div class="mb-3">
                      <label>Comentário do Estado de Conservação:</label>
                      <h6>
                        Inserir breve descrição quando houver informações
                        relevantes sobre o assunto
                      </h6>
                      <textarea id="comentarioEstadoConservacao" class="form-control" aria-label="With textarea" name="comentarioEstadoConservacao" disabled><?php echo $dados['comentarioEstadoConservacao'] ?></textarea>
                    </div>
                    <div class="mb-3">
                      <label>Observações (pavimentos):</label>
                      <textarea id="observacoesPavimentos" class="form-control" aria-label="With textarea" name="observacoesPavimentos" disabled><?php echo $dados['observacoesPavimentos'] ?></textarea>
                    </div>

                    <div class="mb-3 p-2 subtitulos">
                      <h4>5. Descrição</h4>
                    </div>

                    <div class="mb-3">
                        <label>Dados Históricos:</label>
                        <textarea aria-label="With textarea" class="form-control" id="dadosHistoricos" name="dadosHistoricos" disabled ><?php echo $dados['dadosHistoricos'] ?></textarea>
                      </div>
                      <div class="mb-3">
                        <label>Dados Arquitetônicos:</label>
                        <textarea aria-label="With textarea" class="form-control" id="dadosArquitetonicos" name="dadosArquitetonicos" disabled><?php echo $dados['dadosArquitetonicos'] ?></textarea>
                      </div>
                      <div class="mb-3">
                        <label>Dados de Ambiência:</label>
                        <textarea aria-label="With textarea" class="form-control" id="dadosAmbiencia" name="dadosAmbiencia" disabled><?php echo $dados['dadosAmbiencia'] ?></textarea>
                      </div>

                    <div class="mb-3">
                      <label>Fontes Bibliográficas:</label>
                      <h6>
                        Inserir fontes bibliográficas e das imagens
                        utilizadas. Formato ABNT. Ferramenta para formatação
                        de referências em formato
                        <a href="http://referencia.clevert.com.br/?page=refBib">ABNT (click here)</a>
                      </h6>
                      <textarea id="fontesBibliograficas" class="form-control" aria-label="With textarea" name="fontesBibliograficas" disabled><?php echo $dados['fontesBibliograficas'] ?></textarea>
                    </div>
                    <div class="mb-3">
                      <label>Outras Informações:</label>
                      <textarea aria-label="With textarea"  class="form-control" id="outrasInformacoes" name="outrasInformacoes" disabled ><?php echo $dados['outrasInformacoes'] ?></textarea>
                    </div>

                    <div class="mb-3">
                      <label>Observações:</label>
                      <textarea id="observacoes" class="form-control" aria-label="With textarea" name="observacoes" disabled ><?php echo $dados['observacoes'] ?></textarea>
                    </div>

                    <div class="mb-3 p-2 subtitulos">
                        <h4>6. Documentação Gráfica</h4>
                      </div>

                      <div class="mb-3">
                        <label>Documentação Gráfica:</label>
                        <h6>
                        Selecione uma imagem para a documentação fotográfica!
                        </h6>
                        <input type="file" class="form-control-file" name="documentacaoGrafica" id="documentacaoGrafica" disabled/>
                        <?php if (isset($dados['documentacaoGrafica']) && $dados['documentacaoGrafica'] != null && $dados['documentacaoGrafica'] != ' ') {   ?>
                            <div><img src="imgGrafica/img1/<?php echo $dados['documentacaoGrafica'] ?>" width="300px" height="300px" style="margin-left: 50%"/></div>
                         <?php } ?>
                      </div>

                      <div class="mb-3">
                        <label>Documentação Gráfica:</label>
                        <h6>
                        Selecione uma imagem para a documentação fotográfica!
                        </h6>
                        <input type="file" class="form-control-file" name="documentacaoGrafica2" id="documentacaoGrafica2" disabled />
                        <?php if (isset($dados['documentacaoGrafica2']) && $dados['documentacaoGrafica2'] != null && $dados['documentacaoGrafica2'] != ' ') {   ?>
                            <div><img src="imgGrafica/img2/<?php echo $dados['documentacaoGrafica2'] ?>" width="300px" height="300px" style="margin-left: 50%"/></div>
                         <?php } ?>
                      </div>

                      <div class="mb-3">
                        <label>Documentação Gráfica:</label>
                        <h6>
                        Selecione uma imagem para a documentação fotográfica!
                        </h6>
                        <input type="file" class="form-control-file" name="documentacaoGrafica3" id="documentacaoGrafica3" disabled/>
                        <?php if (isset($dados['documentacaoGrafica3']) && $dados['documentacaoGrafica3'] != null && $dados['documentacaoGrafica3'] != ' ') {   ?>
                            <div><img src="imgGrafica/img3/<?php echo $dados['documentacaoGrafica3'] ?>" width="300px" height="300px" style="margin-left: 50%"/></div>
                         <?php } ?>
                 
                      </div>
                         
                      <div class="mb-3 p-2 subtitulos">
                        <h4>7. Documentação Fotográfica </h4>
                      </div>

                      <div class="mb-3">
                        <label>Documentação Fotográfica:</label>
                        <h6>
                        Selecione uma imagem para a documentação fotográfica!
                        </h6>
                        <input type="file" class="form-control-file" name="documentacaoFotografica" id="documentacaoFotografica" disabled/>
                        <?php if (isset($dados['documentacaoFotografica']) && $dados['documentacaoFotografica'] != null && $dados['documentacaoFotografica'] != ' ') {   ?>
                            <div><img src="imgFotografica/img1/<?php echo $dados['documentacaoFotografica'] ?>" width="300px" height="300px" style="margin-left: 50%"/></div>
                         <?php } ?>
                      </div>

                      <div class="mb-3">
                        <label>Documentação Fotográfica:</label>
                        <h6>
                        Selecione uma imagem para a documentação fotográfica!
                        </h6>
                        <input type="file" class="form-control-file" name="documentacaoFotografica2" id="documentacaoFotografica2" disabled/>
                        <?php if (isset($dados['documentacaoFotografica2']) && $dados['documentacaoFotografica2'] != null && $dados['documentacaoFotografica2'] != ' ') {   ?>
                            <div><img src="imgFotografica/img2/<?php echo $dados['documentacaoFotografica2'] ?>" width="300px" height="300px" style="margin-left: 50%"/></div>
                         <?php } ?>
                      </div>

                      <div class="mb-3">
                        <label>Documentação Fotográfica:</label>
                        <h6>
                        Selecione uma imagem para a documentação fotográfica!
                        </h6>
                        <input type="file" class="form-control-file" name="documentacaoFotografica3" id="documentacaoFotografica3" disabled/>
                        <?php if (isset($dados['documentacaoFotografica3']) && $dados['documentacaoFotografica3'] != null && $dados['documentacaoFotografica3'] != ' ') {   ?>
                            <div><img src="imgFotografica/img3/<?php echo $dados['documentacaoFotografica3'] ?>" width="300px" height="300px" style="margin-left: 50%"/></div>
                         <?php } ?>
                      </div>

                    <hr class="mb-4" />

                    <div class="row justify-content-center">
                      <a href="home.php" name="btn-cancel" class="btn btn-primary btn-lg m-2 col-md-3"><i class="fa fa-times" aria-hidden="true"></i>
                        Cancelar</a>
                    </div>
                  </form>

                  <script>
                    function formatarCampo(i) {
                      var valor = i.value.replace(/\D/g, '');
                      valor = (valor / 100).toFixed(2) + '';
                      valor = valor.replace(".", ",");
                      valor = valor.replace(/(\d)(\d{3})(\d{3}),/g, "$1.$2.$3,");
                      valor = valor.replace(/(\d)(\d{3}),/g, "$1.$2,");
                      i.value = valor;
                    }
                  </script>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Usuario Modal -->
  <div class="modal fade" id="usuario-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" style="color:black">Editar sua conta</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" action="/editarUser.php">

            <div class="form-group">
              <input type="hidden" class="form-control" name="id" value="<?php echo $id ?>">
            </div>

            <div class="form-group">
              <label style="color: black">Perfil</label>
              <select class="custom-select" name="perfil" required>
                <option value="Comum" <?php echo $perfil == 'Comum' ? 'selected' : '' ?>>Comum </option>
                <option value="Moderador" <?php echo $perfil == 'Moderador' ? 'selected' : '' ?>>Moderador </option>
                <option value="Administrador" <?php echo $perfil == 'Administrador' ? 'selected' : '' ?>>Administrador</option>
              </select>
            </div>

            <div class="form-group">
              <label style="color: black">Nome</label>
              <input type="text" class="form-control" name="username" value="<?php echo $username ?>" required>
            </div>

            <div class="form-group">
              <label style="color: black">Email</label>
              <input type="email" class="form-control" name="email" value="<?php echo $email ?>" required >
            </div>

            <div class="form-group">
              <label style="color: black">Status</label>
              <select class="custom-select" name="status" required>
                <option value="Ativo" <?php echo $status == 'Ativo' ? 'selected' : '' ?>>Ativo </option>
                <option value="Inativo" <?php echo $status == 'Inativo' ? 'selected' : '' ?>>Inativo</option>
              </select>
            </div>
            <br>
            <div class="modal-footer">
              <button type="submit" class="btn btn-dark" style="margin-right:40%">Salvar</button>
            </div>
          </form>
          <form method="post" action="/editarSenha.php">

            <div class="form-group">
              <input type="hidden" class="form-control" name="id" value="<?php echo $id ?>">
            </div>


            <div class="form-group">
              <label style="color: black">Senha</label>
              <input type="password" class="form-control" name="password" placeholder="Nova Senha.." required>
            </div>
            <br>
            <div class="modal-footer">
              <button type="submit" class="btn btn-dark" style="margin-right:40%">Salvar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <footer>
    <div class="footer-content">
      <a class="" href="home.php">
        <img src="img/logo_1.png" width="40" height="40" class="justify-content-center align-items-center" alt="" />
        CONPRESP
      </a>
      <ul class="socials">
        <li>
          <a href="https://www.facebook.com/preservalpp" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
        </li>
        <li>
          <a href="https://www.instagram.com/preserva.lpp/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
        </li>
        <li>
          <a href="https://www.youtube.com/channel/UCM0unl5Kp9y0JVmO_GgvvBg " target="_blank"><i class="fa fa-youtube" aria-hidden="true"></i></a>
        </li>
      </ul>
    </div>
    <div class="footer-bottom">
      <p>
        copyright &copy;2020 anhembi. desing by
        <a href="https://github.com/JhordanJulcamoro" target="_blank">@JhordanJulcamoro</a>
      </p>
    </div>
  </footer>

  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  <!-- sweetalert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.14.2/dist/sweetalert2.all.min.js"></script>

</body>
<?php }; ?>
</html>