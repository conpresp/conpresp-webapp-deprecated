<?php
session_start();
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
    <!-- DataTable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" />

    <link rel="stylesheet" href="css/home.css" />
    <link rel="stylesheet" href="css/doc_conpresp.css" />

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
              <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
              >
                <h6 class="m-0 font-weight-bold text-primary nombre-subtitulo">
                  Dados a cadastrar
                </h6>
              </div>
              <img class="card-img" src="img/banner.png" alt="Card image" />
              <div class="card-body">
                <div class="row color-text">
                  <div class="col-md-12 order-md-1">
                    <!-- <form class="needs-validation" novalidate>
                      <div class="form-row">
                        <div class="col-md-6 mb-3">
                          <label for="validationCustom01">First name</label>
                          <input
                            type="text"
                            class="form-control"
                            id="validationCustom01"
                            value="Mark"
                            required
                          />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <div class="col-md-6 mb-3">
                          <label for="validationCustom02">Last name</label>
                          <input
                            type="text"
                            class="form-control"
                            id="validationCustom02"
                            value="Otto"
                            required
                          />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="col-md-6 mb-3">
                          <label for="validationCustom03">City</label>
                          <input
                            type="text"
                            class="form-control"
                            id="validationCustom03"
                            required
                          />
                          <div class="invalid-feedback">
                            Please provide a valid city.
                          </div>
                        </div>
                        <div class="col-md-3 mb-3">
                          <label for="validationCustom04">State</label>
                          <select
                            class="custom-select"
                            id="validationCustom04"
                            required
                          >
                            <option selected disabled value="">
                              Choose...
                            </option>
                            <option>...</option>
                          </select>
                          <div class="invalid-feedback">
                            Please select a valid state.
                          </div>
                        </div>
                        <div class="col-md-3 mb-3">
                          <label for="validationCustom05">Zip</label>
                          <input
                            type="text"
                            class="form-control"
                            id="validationCustom05"
                            required
                          />
                          <div class="invalid-feedback">
                            Please provide a valid zip.
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="form-check">
                          <input
                            class="form-check-input"
                            type="checkbox"
                            value=""
                            id="invalidCheck"
                            required
                          />
                          <label class="form-check-label" for="invalidCheck">
                            Agree to terms and conditions
                          </label>
                          <div class="invalid-feedback">
                            You must agree before submitting.
                          </div>
                        </div>
                      </div>
                      <button class="btn btn-primary" type="submit">
                        Submit form
                      </button>
                    </form> -->
                    <form class="needs-validation" novalidate>
                      <div class="row justify-content-center">
                        <a
                          href="home.html"
                          name="btn-cancel"
                          class="btn btn-primary btn-lg m-2 col-md-3"
                          ><i class="fa fa-times" aria-hidden="true"></i>
                          Cancelar</a
                        >
                        <button
                          class="btn btn-info btn-lg m-2 col-md-3"
                          name="btn-guardar"
                          type="submit"
                        >
                          <i class="fa fa-floppy-o" aria-hidden="true"></i>
                          Guardar
                        </button>
                      </div>

                      <div class="mb-3">
                        <label>Código:</label>
                        <input
                          type="text"
                          class="form-control"
                          id="codigo-lpp"
                          disabled
                        />
                      </div>
                      <div class="mb-3">
                        <label>Nome e sobrenome:</label>

                        <input
                          type="text"
                          class="form-control"
                          id="name-lpp"
                          required
                        />
                        <div class="invalid-feedback">
                          Por favor ingrese um nome e sobrenome.
                        </div>
                      </div>
                      <div class="mb-3">
                        <label>Grupo:</label>
                        <select
                          id="grupo-tipo-equipe"
                          class="custom-select d-block w-100"
                          required
                        >
                          <option value="">Selecionar classificação...</option>
                          <option value="Equipe Centro/Mooca">
                            Equipe Centro/Mooca
                          </option>
                          <option value="Equipe Vila Olímpia">
                            Equipe Vila Olímpia
                          </option>
                          <option value="Equipe DHP">Equipe DHP</option>
                        </select>
                        <div class="invalid-feedback">
                          Por favor seleccione uma opção.
                        </div>
                      </div>
                      <hr class="mb-4" />

                      <div class="mb-3 p-2 subtitulos">
                        <h4>1. Dados Gerais</h4>
                      </div>
                      <div class="mb-3">
                        <label>Número do Bem:</label>
                        <h6>
                          Inserir o número do bem a ser cadastrado de acordo com
                          o número correspondente na resolução de tombamento. No
                          caso de resoluções com um bem apenas, identificá-lo
                          com o número 01 (um).
                        </h6>
                        <input
                          type="text"
                          class="form-control"
                          id="numero-bem"
                          required
                        />
                        <div class="invalid-feedback">
                          Por favor ingrese o número do bem.
                        </div>
                      </div>
                      <div class="mb-3">
                        <label>Denominação:</label>
                        <h6>
                          Inserir a denominação oficial do bem, de acordo com a
                          resolução ou documento oficial.
                        </h6>
                        <textarea
                          id="denomicacao-bem"
                          class="form-control"
                          aria-label="With textarea"
                          required
                        ></textarea>
                        <div class="invalid-feedback">
                          Por favor ingrese a denominação.
                        </div>
                      </div>
                      <div class="mb-3">
                        <label>Denominações Complementares:</label>
                        <h6>
                          Inserir denominações complementares, quando houver.
                        </h6>
                        <textarea
                          id="denomicacoes-complementares-bem"
                          class="form-control"
                          aria-label="With textarea"
                        ></textarea>
                      </div>
                      <div class="mb-3">
                        <label>Número de Bens:</label>
                        <h6>
                          Ingressar o número de bens que compõe o item. Ex.:
                          Casa Mário de Andrade: 01 item | Vila Economizadora:
                          120 itens
                        </h6>
                        <input
                          id="numero-bens-item"
                          type="text"
                          class="form-control"
                        />
                      </div>
                      <div class="row">
                        <div class="col-md-3 mb-3">
                          <label>Tipo de Bem:</label>
                          <select
                            id="grupo-tipo-bem"
                            class="custom-select d-block w-100"
                          >
                            <option value="">
                              Selecionar classificação...
                            </option>
                            <option value="Inmóvel">Inmóvel</option>
                            <option value="Móvel">Móvel</option>
                            <option value="Sítio Urbano">Sítio Urbano</option>
                            <option value="Natural">Natural</option>
                          </select>
                          <!-- <div class="invalid-feedback">
                            Por favor seleccione uma classificação.
                          </div> -->
                        </div>
                        <div class="col-md-5 mb-3">
                          <label>Recorte Temático:</label>
                          <select
                            id="grupo-recorte-tematico"
                            class="custom-select d-block w-100"
                          >
                            <option value="">
                              Selecionar classificação...
                            </option>
                            <option value="Cinemas, Conservatórios e Teatros">
                              Cinemas, Conservatórios e Teatros
                            </option>
                            <option value="Conjuntos Residenciais">
                              Conjuntos Residenciais
                            </option>
                            <option value="Edifícios Bancários">
                              Edifícios Bancários
                            </option>
                            <option value="Edifícios Comerciais">
                              Edifícios Comerciais
                            </option>
                            <option value="Edifícios de Uso Administrativo">
                              Edifícios de Uso Administrativo
                            </option>
                            <option value="Edifícios de Uso Especia">
                              Edifícios de Uso Especia
                            </option>
                            <option value="Edifícios de Uso Ferroviário">
                              Edifícios de Uso Ferroviário
                            </option>
                            <option value="Edifícios de Uso Misto">
                              Edifícios de Uso Misto
                            </option>
                            <option value="Edifícios Escolares">
                              Edifícios Escolares
                            </option>
                            <option value="Edifícios Hospitalares">
                              Edifícios Hospitalares
                            </option>
                            <option value="Edifícios Hoteleiros">
                              Edifícios Hoteleiros
                            </option>
                            <option value="Edifícios Religiosos">
                              Edifícios Religiosos
                            </option>
                            <option
                              value="Edifícios Residenciais Multifamiliares"
                            >
                              Edifícios Residenciais Multifamiliares
                            </option>
                            <option
                              value="Edifícios Residenciais Unifamiliares"
                            >
                              Edifícios Residenciais Unifamiliares
                            </option>
                            <option
                              value="Ed. Res. Unifamiliares - Conj. Residenciais"
                            >
                              Ed. Res. Unifamiliares - Conj. Residenciais
                            </option>
                            <option value="Edifícios Rurais">
                              Edifícios Rurais
                            </option>
                            <option value="Logradouros">Logradouros</option>
                            <option value="Monumentos">Monumentos</option>
                            <option value="Museus e Pavilhões de Exposição">
                              Museus e Pavilhões de Exposição
                            </option>
                            <option value="Obras de Arte">Obras de Arte</option>
                          </select>
                          <!-- <div class="invalid-feedback">
                            Por favor seleccione uma classificação.
                          </div> -->
                        </div>
                        <div class="col-md-4 mb-3">
                          <label>Propiedade:</label>
                          <select
                            id="grupo-propiedade"
                            class="custom-select d-block w-100"
                            id=""
                          >
                            <option value="">
                              Selecionar classificação...
                            </option>
                            <option value="Pública Municipal">
                              Pública Municipal
                            </option>
                            <option value="Pública Estadual">
                              Pública Estadual
                            </option>
                            <option value="Pública Federal">
                              Pública Federal
                            </option>
                            <option value="Instituição Religiosa">
                              Instituição Religiosa
                            </option>
                            <option value="Outros">Outros</option>
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
                          <label>Térreo (original)</label>
                          <select
                            id="grupo-uso-original"
                            class="custom-select d-block w-100"
                          >
                            <option value="">
                              Selecionar classificação...
                            </option>
                            <option value="Evocativo">Evocativo</option>
                            <option value="Funerário">Funerário</option>
                            <option value="Industrial">Industrial</option>
                            <option value="Institucional">Institucional</option>
                            <option value="Residencial">Residencial</option>
                            <option value="Serviços">Serviços</option>
                            <option value="Outros">Outros</option>
                          </select>
                          <!-- <div class="invalid-feedback">
                            Por favor seleccione uma classificação.
                          </div> -->
                        </div>
                        <div class="col-md-6 mb-3">
                          <label>Demais pavimentos (original)</label>
                          <select
                            id="grupo-pavimentos-original"
                            class="custom-select d-block w-100"
                          >
                            <option value="">
                              Selecionar classificação...
                            </option>
                            <option value="Evocativo">Evocativo</option>
                            <option value="Funerário">Funerário</option>
                            <option value="Industrial">Industrial</option>
                            <option value="Institucional">Institucional</option>
                            <option value="Residencial">Residencial</option>
                            <option value="Serviços">Serviços</option>
                            <option value="Outros">Outros</option>
                          </select>
                          <!-- <div class="invalid-feedback">
                            Por favor seleccione uma classificação.
                          </div> -->
                        </div>
                      </div>

                      <div class="mb-3 p-2 subtitulos_sub">
                        <h4>Uso Atual</h4>
                      </div>
                      <div class="row">
                        <div class="col-md-6 mb-3">
                          <label>Térreo (atual):</label>
                          <select
                            id="grupo-terreo-atual"
                            class="custom-select d-block w-100"
                          >
                            <option value="">
                              Selecionar classificação...
                            </option>
                            <option value="Evocativo">Evocativo</option>
                            <option value="Funerário">Funerário</option>
                            <option value="Industrial">Industrial</option>
                            <option value="Institucional">Institucional</option>
                            <option value="Residencial">Residencial</option>
                            <option value="Serviços">Serviços</option>
                            <option value="Outros">Outros</option>
                          </select>
                          <!-- <div class="invalid-feedback">
                            Por favor seleccione uma classificação.
                          </div> -->
                        </div>
                        <div class="col-md-6 mb-3">
                          <label>Demais pavimentos (atual):</label>
                          <select
                            id="grupo-pavimentos-atual"
                            class="custom-select d-block w-100"
                          >
                            <option value="">
                              Selecionar classificação...
                            </option>
                            <option value="Evocativo">Evocativo</option>
                            <option value="Funerário">Funerário</option>
                            <option value="Industrial">Industrial</option>
                            <option value="Institucional">Institucional</option>
                            <option value="Residencial">Residencial</option>
                            <option value="Serviços">Serviços</option>
                            <option value="Outros">Outros</option>
                          </select>
                          <!-- <div class="invalid-feedback">
                            Por favor seleccione uma classificação.
                          </div> -->
                        </div>
                      </div>
                      <div class="mb-3">
                        <label>Uso - Observações:</label>
                        <h6>Inserir observações</h6>
                        <textarea
                          id="uso-observacoes"
                          class="form-control"
                          aria-label="With textarea"
                        ></textarea>
                      </div>

                      <div class="mb-3 p-2 subtitulos">
                        <h4>2. Tombamento</h4>
                      </div>
                      <div class="mb-3">
                        <label>Resolução:</label>
                        <h6>
                          Seguir o formato: Ex.: Res. 05/91 Utilizar o site da
                          prefeitura como referência:
                          <a
                            href="http://www.prefeitura.sp.gov.br/cidade/secretarias/cultura/conpresp/legislacao/resolucoes/index.php?p=1137"
                            target="_blank"
                            >CLICK AQUI</a
                          >
                        </h6>
                        <input
                          type="text"
                          class="form-control"
                          id="resolucao-tombamento"
                          required
                        />
                        <div class="invalid-feedback">
                          Por favor ingrese formato da resolução.
                        </div>
                      </div>
                      <div class="mb-3">
                        <label>Resoluções Relacionadas ao Bem:</label>
                        <h6>
                          Outras resoluções relacionadas ao , como, por exemplo,
                          regulamentações de área envoltória.
                        </h6>
                        <input
                          type="text"
                          class="form-control"
                          id="relacionadas-tombamento"
                        />
                      </div>
                      <div class="mb-3 p-2 subtitulos_sub">
                        <h4>CONDEPHAAT</h4>
                      </div>
                      <div class="mb-3">
                        <label>Resolução:</label>
                        <h6>
                          Seguir o formato: Ex.: RES. SC SN/70 ou RES. SC 67/82
                          Utilizar o site da prefeitura como referência:
                          <a
                            href=" http://www.prefeitura.sp.gov.br/cidade/secretarias/cultura/cit/index.php?p=1157"
                            target="_blank"
                            >CLICK AQUI</a
                          >
                        </h6>
                        <input
                          type="text"
                          class="form-control"
                          id="resolucao-condephaat"
                        />
                      </div>
                      <div class="mb-3">
                        <label>Resoluções Relacionadas ao Bem:</label>
                        <input
                          type="text"
                          class="form-control"
                          id="relacionadas-condephaat"
                        />
                      </div>
                      <div class="mb-3 p-2 subtitulos_sub">
                        <h4>IPHAN</h4>
                      </div>
                      <div class="mb-3">
                        <label>Resolução:</label>
                        <h6>
                          Seguir o formato: Ex.: nº 353 Ano 1951 Utilizar a
                          lista de bens tombados do Iphan como referência:
                          <a
                            href="http://portal.iphan.gov.br/uploads/ckfinder/arquivos/2016-11-25_Lista_Bens_Tombados.pdf"
                            target="_blank"
                            >CLICK AQUI</a
                          >
                        </h6>
                        <input
                          type="text"
                          class="form-control"
                          id="resolucao-iphan"
                        />
                      </div>
                      <div class="mb-3">
                        <label>Resoluções Relacionadas ao Bem:</label>
                        <input
                          type="text"
                          class="form-control"
                          id="relacionadas-iphan"
                        />
                      </div>
                      <div class="mb-3">
                        <label>Tipos de Proteção:</label>
                        <div class="row m-2">
                          <div class="col-md-6 mb-3">
                            <div class="custom-control custom-checkbox">
                              <input
                                type="checkbox"
                                class="custom-control-input"
                                id="cb-apt"
                              />
                              <label class="custom-control-label" for="cb-apt"
                                >APT</label
                              >
                            </div>
                            <div class="custom-control custom-checkbox">
                              <input
                                type="checkbox"
                                class="custom-control-input"
                                id="cb-teo"
                              />
                              <label class="custom-control-label" for="cb-teo"
                                >TEO</label
                              >
                            </div>
                            <div class="custom-control custom-checkbox">
                              <input
                                type="checkbox"
                                class="custom-control-input"
                                id="cb-t"
                              />
                              <label class="custom-control-label" for="cb-t"
                                >T</label
                              >
                            </div>
                            <div class="custom-control custom-checkbox">
                              <input
                                type="checkbox"
                                class="custom-control-input"
                                id="cb-ticp"
                              />
                              <label class="custom-control-label" for="cb-ticp"
                                >TICP</label
                              >
                            </div>
                          </div>

                          <div class="col-md-6 mb-3">
                            <div class="custom-control custom-checkbox">
                              <input
                                type="checkbox"
                                class="custom-control-input"
                                id="cb-apc"
                              />
                              <label class="custom-control-label" for="cb-apc"
                                >ZEPEC APC</label
                              >
                            </div>
                            <div class="custom-control custom-checkbox">
                              <input
                                type="checkbox"
                                class="custom-control-input"
                                id="cb-bir"
                              />
                              <label class="custom-control-label" for="cb-bir"
                                >ZEPEC BIR</label
                              >
                            </div>
                            <div class="custom-control custom-checkbox">
                              <input
                                type="checkbox"
                                class="custom-control-input"
                                id="cb-aue"
                              />
                              <label class="custom-control-label" for="cb-aue"
                                >ZEPEC AUE</label
                              >
                            </div>
                            <div class="custom-control custom-checkbox">
                              <input
                                type="checkbox"
                                class="custom-control-input"
                                id="cb-app"
                              />
                              <label class="custom-control-label" for="cb-app"
                                >ZEPEC APP</label
                              >
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="mb-3 p-2 subtitulos">
                        <h4>3. Localização</h4>
                      </div>
                      <div class="mb-3">
                        <label class="font-weight-bold">Endereço Atual</label>
                        <h6>
                          Preencher os dados de localização do bem, utilizando
                          os ferramentas disponíveis em:
                          <a
                            href="http://geosampa.prefeitura.sp.gov.br/PaginasPublicas/_SBC.aspx"
                            target="_blank"
                            >GEOSAMPA</a
                          >
                          e
                          <a
                            href="http://www3.prefeitura.sp.gov.br/cit/Forms/frmPesquisaGeral.aspx"
                            target="_blank"
                            >CADASTRO DE IMÓVEIS TOMBADOS</a
                          >
                        </h6>
                      </div>
                      <div class="row">
                        <div class="col-md-6 mb-3">
                          <label>Tipo</label>
                          <select
                            id="grupo-tipo-imoveis"
                            class="custom-select d-block w-100"
                          >
                            <option value="">Selecionar tipo...</option>
                            <option value="ALAMEDA">ALAMEDA</option>
                            <option value="AVENIDA">AVENIDA</option>
                            <option value="CAMPO">CAMPO</option>
                            <option value="CHACARA">CHACARA</option>
                            <option value="ESTRADA">ESTRADA</option>
                            <option value="JARDIM">JARDIM</option>
                            <option value="LADEIRA">LADEIRA</option>
                            <option value="LAGO">LAGO</option>
                            <option value="LAGOA">LAGOA</option>
                            <option value="LARGO">LARGO</option>
                            <option value="PARQUE">PARQUE</option>
                            <option value="PASSARELA">PASSARELA</option>
                            <option value="PATIO">PATIO</option>
                            <option value="PRACA">PRACA</option>
                            <option value="RODOVIA">RODOVIA</option>
                            <option value="RUA">RUA</option>
                            <option value="SETOR">SETOR</option>
                            <option value="SITIO">SITIO</option>
                            <option value="TRAVESSA">TRAVESSA</option>
                            <option value="VIA">VIA</option>
                            <option value="VIADUTO">VIADUTO</option>
                            <option value="VIELA">VIELA</option>
                            <option value="OUTROS">OUTROS</option>
                          </select>
                          <div class="invalid-feedback">
                            Por favor seleccione uma classificação.
                          </div>
                        </div>
                        <div class="col-md-6 mb-3">
                          <label>Título</label>
                          <select
                            id="grupo-tipo-titulo"
                            class="custom-select d-block w-100"
                          >
                            <option value="">
                              Selecionar classificação...
                            </option>
                            <option value="ABADE">ABADE</option>
                            <option value="ACADEMICO">ACADEMICO</option>
                            <option value="ADVOGADO">ADVOGADO</option>
                            <option value="AGENTE">AGENTE</option>
                            <option value="AGRIC">AGRIC</option>
                            <option value="AGRIMENSOR">AGRIMENSOR</option>
                            <option value="AJUDANTE">AJUDANTE</option>
                            <option value="ALFERES">ALFERES</option>
                            <option value="ALMIRANTE">ALMIRANTE</option>
                            <option value="APOSTOLO">APOSTOLO</option>
                            <option value="ARCEBISPO">ARCEBISPO</option>
                            <option value="ARCIP">ARCIP</option>
                            <option value="ARCJO">ARCJO</option>
                            <option value="ARQUITETA">ARQUITETA</option>
                            <option value="ARQUITETO">ARQUITETO</option>
                            <option value="ARQUITETO PROFESSOR">
                              ARQUITETO PROFESSOR
                            </option>
                            <option value="ASPIRANTE">ASPIRANTE</option>
                            <option value="AVENIDA">AVENIDA</option>
                            <option value="AVIADOR">AVIADOR</option>
                            <option value="AVIADORA">AVIADORA</option>
                            <option value="BACHAREL">BACHAREL</option>
                            <option value="BANDEIRANTE">BANDEIRANTE</option>
                            <option value="BANQUEIRO">BANQUEIRO</option>
                            <option value="BARAO">BARAO</option>
                            <option value="BARONESA">BARONESA</option>
                            <option value="BEATO PADRE">BEATO PADRE</option>
                            <option value="BEM AVENTURADO">
                              BEM AVENTURADO
                            </option>
                            <option value="BENEMERITO">BENEMERITO</option>
                            <option value="BISPO">BISPO</option>
                            <option value="BRIGADEIRO">BRIGADEIRO</option>
                            <option value="CABO">CABO</option>
                            <option value="CABO PM">CABO PM</option>
                            <option value="CADETE">CADETE</option>
                            <option value="CAMPEADOR">CAMPEADOR</option>
                            <option value="CAPITAO">CAPITAO</option>
                            <option value="CAPITAO ALMIRANTE">
                              CAPITAO ALMIRANTE
                            </option>
                            <option value="CAPITAO DE FRAGATA">
                              CAPITAO DE FRAGATA
                            </option>
                            <option value="CAPITAO DE MAR E GUERRA">
                              CAPITAO DE MAR E GUERRA
                            </option>
                            <option value="CAPITAO GENERAL">
                              CAPITAO GENERAL
                            </option>
                            <option value="CAPITAO MOR">CAPITAO MOR</option>
                            <option value="CAPITAO PM">CAPITAO PM</option>
                            <option value="CAPITAO TENENTE">
                              CAPITAO TENENTE
                            </option>
                            <option value="CARDEAL">CARDEAL</option>
                            <option value="CATEQUISTA">CATEQUISTA</option>
                            <option value="CAVALEIRO">CAVALEIRO</option>
                            <option value="CAVALHEIRO">CAVALHEIRO</option>
                            <option value="CINEASTA">CINEASTA</option>
                            <option value="COMANDANTE">COMANDANTE</option>
                            <option value="COMEDIANTE">COMEDIANTE</option>
                            <option value="COMENDADOR">COMENDADOR</option>
                            <option value="COMISSARIA">COMISSARIA</option>
                            <option value="COMISSARIO">COMISSARIO</option>
                            <option value="COMPOSITOR">COMPOSITOR</option>
                            <option value="CONDE">CONDE</option>
                            <option value="CONDESSA">CONDESSA</option>
                            <option value="CONEGO">CONEGO</option>
                            <option value="CONFRADE">CONFRADE</option>
                            <option value="CONSELHEIRO">CONSELHEIRO</option>
                            <option value="CONSUL">CONSUL</option>
                            <option value="CORONEL">CORONEL</option>
                            <option value="CORONEL PM">CORONEL PM</option>
                            <option value="CORREGEDOR">CORREGEDOR</option>
                            <option value="DELEGADO">DELEGADO</option>
                            <option value="DENTISTA">DENTISTA</option>
                            <option value="DEPUTADA">DEPUTADA</option>
                            <option value="DEPUTADO">DEPUTADO</option>
                            <option value="DEPUTADO DOUTOR">
                              DEPUTADO DOUTOR
                            </option>
                            <option value="DESEMBARGADOR">DESEMBARGADOR</option>
                            <option value="DIACO">DIACO</option>
                            <option value="DOM">DOM</option>
                            <option value="DONA">DONA</option>
                            <option value="DOUTOR">DOUTOR</option>
                            <option value="DOUTORA">DOUTORA</option>
                            <option value="DUQUE">DUQUE</option>
                            <option value="DUQUESA">DUQUESA</option>
                            <option value="EDITOR">EDITOR</option>
                            <option value="EDUCADOR">EDUCADOR</option>
                            <option value="EDUCADORA">EDUCADORA</option>
                            <option value="EMBAIXADOR">EMBAIXADOR</option>
                            <option value="EMBAIXADORA">EMBAIXADORA</option>
                            <option value="ENGENHEIRA">ENGENHEIRA</option>
                            <option value="ENGENHEIRO">ENGENHEIRO</option>
                            <option value="ESCOTEIRO">ESCOTEIRO</option>
                            <option value="ESCRAVO">ESCRAVO</option>
                            <option value="ESCRITOR">ESCRITOR</option>
                            <option value="EXPEDICIONARIO">
                              EXPEDICIONARIO
                            </option>
                            <option value="FISICO">FISICO</option>
                            <option value="FREI">FREI</option>
                            <option value="GENERAL">GENERAL</option>
                            <option value="GOVERNADOR">GOVERNADOR</option>
                            <option value="GRUMETE">GRUMETE</option>
                            <option value="GUARDA CIVIL METROPOLITANO">
                              GUARDA CIVIL METROPOLITANO
                            </option>
                            <option value="IMACULADA">IMACULADA</option>
                            <option value="IMPERADOR">IMPERADOR</option>
                            <option value="IMPERATRIZ">IMPERATRIZ</option>
                            <option value="INFANTE">INFANTE</option>
                            <option value="INSPETOR">INSPETOR</option>
                            <option value="IRMA">IRMA</option>
                            <option value="IRMAO">IRMAO</option>
                            <option value="IRMAOS">IRMAOS</option>
                            <option value="IRMAS">IRMAS</option>
                            <option value="JORNALISTA">JORNALISTA</option>
                            <option value="LIBERTADOR">LIBERTADOR</option>
                            <option value="LIDCO">LIDCO</option>
                            <option value="LIVREIRO">LIVREIRO</option>
                            <option value="LORDE">LORDE</option>
                            <option value="MADAME">MADAME</option>
                            <option value="MADRE">MADRE</option>
                            <option value="MAESTRO">MAESTRO</option>
                            <option value="MAJOR">MAJOR</option>
                            <option value="MAJOR AVIADOR">MAJOR AVIADOR</option>
                            <option value="MAJOR BRIGADEIRO">
                              MAJOR BRIGADEIRO
                            </option>
                            <option value="MAQUINISTA">MAQUINISTA</option>
                            <option value="MARECHAL">MARECHAL</option>
                            <option value="MARECHAL DO AR">
                              MARECHAL DO AR
                            </option>
                            <option value="MARQUES">MARQUES</option>
                            <option value="MARQUESA">MARQUESA</option>
                            <option value="MERE">MERE</option>
                            <option value="MESTRAS">MESTRAS</option>
                            <option value="MESTRE">MESTRE</option>
                            <option value="MESTRES">MESTRES</option>
                            <option value="MILITANTE">MILITANTE</option>
                            <option value="MINISTRO">MINISTRO</option>
                            <option value="MISSIONARIA">MISSIONARIA</option>
                            <option value="MISSIONARIO">MISSIONARIO</option>
                            <option value="MONGE">MONGE</option>
                            <option value="MONSENHOR">MONSENHOR</option>
                            <option value="MUNIC">MUNIC</option>
                            <option value="MUSICO">MUSICO</option>
                            <option value="NOSSA SENHORA">NOSSA SENHORA</option>
                            <option value="NOSSO SENHOR">NOSSO SENHOR</option>
                            <option value="OUVIDOR">OUVIDOR</option>
                            <option value="PADRE">PADRE</option>
                            <option value="PADRES">PADRES</option>
                            <option value="PAI">PAI</option>
                            <option value="PAPA">PAPA</option>
                            <option value="PASTOR">PASTOR</option>
                            <option value="PATRIARCA">PATRIARCA</option>
                            <option value="POETA">POETA</option>
                            <option value="POETISA">POETISA</option>
                            <option value="PREFEITO">PREFEITO</option>
                            <option value="PRESIDENTE">PRESIDENTE</option>
                            <option value="PRESIDENTE DA ACAD.BRAS.LETRAS">
                              PRESIDENTE DA ACAD.BRAS.LETRAS
                            </option>
                            <option value="PREVR">PREVR</option>
                            <option value="PRIMEIRO SARGENTO">
                              PRIMEIRO SARGENTO
                            </option>
                            <option value="PRIMEIRO SARGENTO PM">
                              PRIMEIRO SARGENTO PM
                            </option>
                            <option value="PRIMEIRO TENENTE">
                              PRIMEIRO TENENTE
                            </option>
                            <option value="PRIMEIRO TENENTE PM">
                              PRIMEIRO TENENTE PM
                            </option>
                            <option value="PRINCESA">PRINCESA</option>
                            <option value="PRINCIPE">PRINCIPE</option>
                            <option value="PROCURADOR">PROCURADOR</option>
                            <option value="PROFESSOR">PROFESSOR</option>
                            <option value="PROFESSOR DOUTOR">
                              PROFESSOR DOUTOR
                            </option>
                            <option value="PROFESSOR ENGENHEIRO">
                              PROFESSOR ENGENHEIRO
                            </option>
                            <option value="PROFESSORA">PROFESSORA</option>
                            <option value="PROFETA">PROFETA</option>
                            <option value="PROMOTOR">PROMOTOR</option>
                            <option value="PROVEDOR">PROVEDOR</option>
                            <option value="PROVEDOR MOR">PROVEDOR MOR</option>
                            <option value="RABINO">RABINO</option>
                            <option value="RADIALISTA">RADIALISTA</option>
                            <option value="RAINHA">RAINHA</option>
                            <option value="REGENTE">REGENTE</option>
                            <option value="REI">REI</option>
                            <option value="REVERENDO">REVERENDO</option>
                            <option value="RUA">RUA</option>
                            <option value="SACERDOTE">SACERDOTE</option>
                            <option value="SANTA">SANTA</option>
                            <option value="SANTO">SANTO</option>
                            <option value="SAO">SAO</option>
                            <option value="SARGENTO">SARGENTO</option>
                            <option value="SARGENTO MOR">SARGENTO MOR</option>
                            <option value="SARGENTO PM">SARGENTO PM</option>
                            <option value="SEGUNDO SARGENTO">
                              SEGUNDO SARGENTO
                            </option>
                            <option value="SEGUNDO SARGENTO PM">
                              SEGUNDO SARGENTO PM
                            </option>
                            <option value="SEGUNDO TENENTE">
                              SEGUNDO TENENTE
                            </option>
                            <option value="SENADOR">SENADOR</option>
                            <option value="SENHOR">SENHOR</option>
                            <option value="SENHORA">SENHORA</option>
                            <option value="SERTANISTA">SERTANISTA</option>
                            <option value="SINHA">SINHA</option>
                            <option value="SIR">SIR</option>
                            <option value="SOCIOLOGO">SOCIOLOGO</option>
                            <option value="SOLDADO">SOLDADO</option>
                            <option value="SOLDADO PM">SOLDADO PM</option>
                            <option value="SOROR">SOROR</option>
                            <option value="SUB TENENTE">SUB TENENTE</option>
                            <option value="TENENTE">TENENTE</option>
                            <option value="TENENTE AVIADOR">
                              TENENTE AVIADOR
                            </option>
                            <option value="TENENTE BRIGADEIRO">
                              TENENTE BRIGADEIRO
                            </option>
                            <option value="TENENTE CORONE">
                              TENENTE CORONEL
                            </option>
                            <option value="TENENTE CORONEL PM">
                              TENENTE CORONEL PM
                            </option>
                            <option value="TEOLOGO">TEOLOGO</option>
                            <option value="TERCEIRO SARGENTO">
                              TERCEIRO SARGENTO
                            </option>
                            <option value="TERCEIRO SARGENTO PM">
                              TERCEIRO SARGENTO PM
                            </option>
                            <option value="TIA">TIA</option>
                            <option value="VEREADOR">VEREADOR</option>
                            <option value="VICE ALMIRANTE">
                              VICE ALMIRANTE
                            </option>
                            <option value="VICE REI">VICE REI</option>
                            <option value="VIGARIO">VIGARIO</option>
                            <option value="VISCONDE">VISCONDE</option>
                            <option value="VISCONDESSA">VISCONDESSA</option>
                            <option value="VOLUNTARIO">VOLUNTARIO</option>
                          </select>
                          <!-- <div class="invalid-feedback">
                            Por favor seleccione uma classificação.
                          </div> -->
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
                        <input
                          type="text"
                          class="form-control"
                          id="input-logradouro"
                        />
                      </div>
                      <div class="mb-3">
                        <label>Número Atual:</label>
                        <h6>Ingressar o Número Atual do endereço</h6>
                        <input
                          type="text"
                          class="form-control"
                          id="numero-atual"
                        />
                      </div>
                      <div class="mb-3">
                        <label>Endereço Complementar:</label>
                        <h6>
                          Inserir endereços adicionais quando houver entradas
                          secundárias. Preencher com nome da rua e número.
                        </h6>
                        <input
                          type="text"
                          class="form-control"
                          id="endereco-completo"
                        />
                      </div>
                      <div class="row">
                        <div class="col-md-6 mb-3">
                          <label>Distrito</label>
                          <h6>
                            Escolher o Distrito. Utilizar o GEOSAMPA como
                            referência. Camada: Limites Administrativos -
                            Distrito
                          </h6>
                          <select
                            id="grupo-tipo-distrito"
                            class="custom-select d-block w-100"
                          >
                            <option value="">Selecionar distrito...</option>
                            <option value="Água Rasa">Água Rasa</option>
                            <option value="Alto de Pinheiros">
                              Alto de Pinheiros
                            </option>
                            <option value="Anhanguera">Anhanguera</option>
                            <option value="Aricanduva">Aricanduva</option>
                            <option value="Artur Alvim">Artur Alvim</option>
                            <option value="Barra Funda">Barra Funda</option>
                            <option value="Bela Vista">Bela Vista</option>
                            <option value="Belém">Belém</option>
                            <option value="Bom Retiro">Bom Retiro</option>
                            <option value="Brás">Brás</option>
                            <option value="Brasilândia">Brasilândia</option>
                            <option value="Butantã">Butantã</option>
                            <option value="Cachoeirinha">Cachoeirinha</option>
                            <option value="Cambuci">Cambuci</option>
                            <option value="Campo Belo">Campo Belo</option>
                            <option value="Campo Grande">Campo Grande</option>
                            <option value="Campo Limpo">Campo Limpo</option>
                            <option value="Cangaíba">Cangaíba</option>
                            <option value="Capão Redondo">Capão Redondo</option>
                            <option value="Carrão">Carrão</option>
                            <option value="Casa Verde">Casa Verde</option>
                            <option value="Cidade Ademar">Cidade Ademar</option>
                            <option value="Cidade Dutra">Cidade Dutra</option>
                            <option value="Cidade Líder">Cidade Líder</option>
                            <option value="Cidade Tiradentes">
                              Cidade Tiradentes
                            </option>
                            <option value="Consolação">Consolação</option>
                            <option value="Cursino">Cursino</option>
                            <option value="Ermelino Matarazzo">
                              Ermelino Matarazzo
                            </option>
                            <option value="Freguesia do Ó">
                              Freguesia do Ó
                            </option>
                            <option value="Grajaú">Grajaú</option>
                            <option value="Guaianases">Guaianases</option>
                            <option value="Iguatemi">Iguatemi</option>
                            <option value="Ipiranga">Ipiranga</option>
                            <option value="Itaim Bibi">Itaim Bibi</option>
                            <option value="Itaim Paulista">
                              Itaim Paulista
                            </option>
                            <option value="Itaquera">Itaquera</option>
                            <option value="Jabaquara">Jabaquara</option>
                            <option value="Jaçanã">Jaçanã</option>
                            <option value="Jaraguá">Jaraguá</option>
                            <option value="Jaguaré">Jaguaré</option>
                            <option value="Jaraguá">Jaraguá</option>
                            <option value="Jardim Ângela">Jardim Ângela</option>
                            <option value="Jardim Helena">Jardim Helena</option>
                            <option value="Jardim Paulista">
                              Jardim Paulista
                            </option>
                            <option value="Jardim São Luís">
                              Jardim São Luís
                            </option>
                            <option value="José Bonifácio">
                              José Bonifácio
                            </option>
                            <option value="Lajeado">Lajeado</option>
                            <option value="Lapa">Lapa</option>
                            <option value="Liberdade">Liberdade</option>
                            <option value="Limão">Limão</option>
                            <option value="Mandaqui">Mandaqui</option>
                            <option value="Marsilac">Marsilac</option>
                            <option value="Moema">Moema</option>
                            <option value="Mooca">Mooca</option>
                            <option value="Morumbi">Morumbi</option>
                            <option value="Parelheiros">Parelheiros</option>
                            <option value="Pari">Pari</option>
                            <option value="Parque do Carmo">
                              Parque do Carmo
                            </option>
                            <option value="Pedreira">Pedreira</option>
                            <option value="Penha">Penha</option>
                            <option value="Perdizes">Perdizes</option>
                            <option value="Perus">Perus</option>
                            <option value="Pinheiros">Pinheiros</option>
                            <option value="Pirituba">Pirituba</option>
                            <option value="Ponte Rasa">Ponte Rasa</option>
                            <option value="Raposo Tavares">
                              Raposo Tavares
                            </option>
                            <option value="República">República</option>
                            <option value="Rio Pequeno">Rio Pequeno</option>
                            <option value="Sacomã">Sacomã</option>
                            <option value="Santa Cecília">Santa Cecília</option>
                            <option value="Santana">Santana</option>
                            <option value="Santo Amaro">Santo Amaro</option>
                            <option value="São Domingos">São Domingos</option>
                            <option value="São Lucas">São Lucas</option>
                            <option value="São Mateus">São Mateus</option>
                            <option value="São Miguel">São Miguel</option>
                            <option value="São Rafael">São Rafael</option>
                            <option value="Sapopemba">Sapopemba</option>
                            <option value="Saúde">Saúde</option>
                            <option value="Sé">Sé</option>
                            <option value="Socorro">Socorro</option>
                            <option value="Tatuapé">Tatuapé</option>
                            <option value="Tremembé">Tremembé</option>
                            <option value="Tucuruvi">Tucuruvi</option>
                            <option value="Vila Andrade">Vila Andrade</option>
                            <option value="Vila Curuçá">Vila Curuçá</option>
                            <option value="Vila Formosa">Vila Formosa</option>
                            <option value="Vila Guilherme">
                              Vila Guilherme
                            </option>
                            <option value="Vila Jacuí">Vila Jacuí</option>
                            <option value="Vila Leopoldina">
                              Vila Leopoldina
                            </option>
                            <option value="Vila Maria">Vila Maria</option>
                            <option value="Vila Mariana">Vila Mariana</option>
                            <option value="Vila Matilde">Vila Matilde</option>
                            <option value="Vila Medeiros">Vila Medeiros</option>
                            <option value="Vila Prudente">Vila Prudente</option>
                            <option value="Vila Sônia">Vila Sônia</option>
                          </select>
                          <div class="invalid-feedback">
                            Por favor seleccione uma classificação..
                          </div>
                        </div>
                        <div class="col-md-6 mb-3">
                          <label for="state">Prefeitura Regional</label>
                          <h6>
                            Escolher o a Prefeitura Regional. Utilizar o
                            GEOSAMPA como referência. Camada: Limites
                            Administrativos - Prefeituras Regionais
                          </h6>
                          <select
                            id="grupo-prefeitura-regional"
                            class="custom-select d-block w-100"
                          >
                            <option value="">
                              Selecionar uma classificação....
                            </option>
                            <option value="Aricanduva/Vila Formosa">
                              Aricanduva/Vila Formosa
                            </option>
                            <option value="Butantã">Butantã</option>
                            <option value="Campo Limpo">Campo Limpo</option>
                            <option value="Capela do Socorro">
                              Capela do Socorro
                            </option>
                            <option value="Casa Verde">Casa Verde</option>
                            <option value="Cidade Ademar">Cidade Ademar</option>
                            <option value="Cidade Tiradentes">
                              Cidade Tiradentes
                            </option>
                            <option value="Ermelino Matarazzo">
                              Ermelino Matarazzo
                            </option>
                            <option value="Freguesia do Ó/Brasilândia">
                              Freguesia do Ó/Brasilândia
                            </option>
                            <option value="Guaianases">Guaianases</option>
                            <option value="Ipiranga">Ipiranga</option>
                            <option value="Itaim Paulista">
                              Itaim Paulista
                            </option>
                            <option value="Itaquera">Itaquera</option>
                            <option value="Jabaquara">Jabaquara</option>
                            <option value="Jaçanã/Temembé">
                              Jaçanã/Temembé
                            </option>
                            <option value="Lapa">Lapa</option>
                            <option value="M'Boi Mirim">M'Boi Mirim</option>
                            <option value="Mooca">Mooca</option>
                            <option value="Parelheiros">Parelheiros</option>
                            <option value="Penha">Penha</option>
                            <option value="Perus">Perus</option>
                            <option value="Pinheiros">Pinheiros</option>
                            <option value="Pirituba/Jaraguá">
                              Pirituba/Jaraguá
                            </option>
                            <option value="Santana/Tucuruvi">
                              Santana/Tucuruvi
                            </option>
                            <option value="Santo Amaro">Santo Amaro</option>
                            <option value="São Mateus">São Mateus</option>
                            <option value="São Miguel Paulista">
                              São Miguel Paulista
                            </option>
                            <option value="Sapobemba">Sapobemba</option>
                            <option value="Sé">Sé</option>
                            <option value="Vila Maria/Vila Guilherme">
                              Vila Maria/Vila Guilherme
                            </option>
                            <option value="Vila Mariana">Vila Mariana</option>
                            <option value="Vila Prudente">Vila Prudente</option>
                          </select>
                          <!-- <div class="invalid-feedback">
                            Por favor seleccione uma classificação.
                          </div> -->
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
                        <input
                          type="text"
                          class="form-control"
                          id="input-setor"
                        />
                      </div>
                      <div class="mb-3">
                        <label>Quadra:</label>
                        <h6>
                          Ingressar o número da quadra com três dígitos, inserir
                          letra "x" antes. Ex: Quadra 012, inserir: x012
                          Utilizar o GEOSAMPA como referência. Camada: Cadastro
                          / Cadastro Fiscal ou o CIT - Pesquisa por endereço
                        </h6>
                        <input
                          type="text"
                          class="form-control"
                          id="input-quadra"
                        />
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
                        <input
                          type="text"
                          class="form-control"
                          id="input-lote"
                        />
                      </div>
                      <div class="mb-3">
                        <label>DAC:</label>
                        <h6>
                          Ingressar o DAC, utilizando o CIT - Cadastro de
                          Imóveis Tombados como referência. Ingressar apenas um
                          número
                          <a
                            href="http://www3.prefeitura.sp.gov.br/cit/Forms/frmPesquisaGeral.aspx"
                            >CLICK AQUI</a
                          >
                        </h6>
                        <input
                          type="text"
                          class="form-control"
                          id="input-dac"
                        />
                      </div>
                      <div class="mb-3">
                        <label>N° de Condomínio:</label>
                        <h6>
                          Se houver, ingressar o número de condomínio. Utilizar
                          o GEOSAMPA como referência. Baixar o Croqui
                          Patrimonial através da Pesquisa por Setor e Quadra
                        </h6>
                        <input
                          type="text"
                          class="form-control"
                          id="numero-condominio"
                        />
                      </div>

                      <div class="mb-3">
                        <label class="font-weight-bold">Endereço Antigo</label>
                        <h6>
                          Preencher os dados de localização do bem, utilizando
                          os ferramentas disponíveis em:
                          <a
                            href="http://geosampa.prefeitura.sp.gov.br/PaginasPublicas/_SBC.aspx"
                            target="_blank"
                            >GEOSAMPA</a
                          >
                          e
                          <a
                            href="http://www3.prefeitura.sp.gov.br/cit/Forms/frmPesquisaGeral.aspx"
                            target="_blank"
                            >CADASTRO DE IMÓVEIS TOMBADOS</a
                          >
                        </h6>
                      </div>
                      <div class="row">
                        <div class="col-md-6 mb-3">
                          <label>Tipo Antigo:</label>
                          <select
                            id="grupo-tipo-antigo"
                            class="custom-select d-block w-100"
                          >
                            <option value="">
                              Selecionar uma classificação....
                            </option>
                            <option value="ALAMEDA">ALAMEDA</option>
                            <option value="AVENIDA">AVENIDA</option>
                            <option value="CAMPO">CAMPO</option>
                            <option value="CHACARA">CHACARA</option>
                            <option value="ESTRADA">ESTRADA</option>
                            <option value="JARDIM">JARDIM</option>
                            <option value="LADEIRA">LADEIRA</option>
                            <option value="LAGO">LAGO</option>
                            <option value="LAGOA">LAGOA</option>
                            <option value="LARGO">LARGO</option>
                            <option value="PARQUE">PARQUE</option>
                            <option value="PASSARELA">PASSARELA</option>
                            <option value="PATIO">PATIO</option>
                            <option value="PATIO">PRACA</option>
                            <option value="RODOVIA">RODOVIA</option>
                            <option value="RUA">RUA</option>
                            <option value="SETOR">SETOR</option>
                            <option value="SITIO">SITIO</option>
                            <option value="TRAVESSA">TRAVESSA</option>
                            <option value="VIA">VIA</option>
                            <option value="VIADUTO">VIADUTO</option>
                            <option value="VIELA">VIELA</option>
                            <option value="OUTROS">OUTROS</option>
                          </select>
                          <!-- <div class="invalid-feedback">
                            Por favor seleccione uma classificação.
                          </div> -->
                        </div>
                        <div class="col-md-6 mb-3">
                          <label>Título Antigo:</label>
                          <select
                            id="grupo-titulo-antigo"
                            class="custom-select d-block w-100"
                          >
                            <option value="">Selecionar tipo...</option>
                            <option value="ABADE">ABADE</option>
                            <option value="ABADE">ABADE</option>
                            <option value="ACADEMICO">ACADEMICO</option>
                            <option value="ADVOGADO">ADVOGADO</option>
                            <option value="AGENTE">AGENTE</option>
                            <option value="AGRIC">AGRIC</option>
                            <option value="AGRIMENSOR">AGRIMENSOR</option>
                            <option value="AJUDANTE">AJUDANTE</option>
                            <option value="ALFERES">ALFERES</option>
                            <option value="ALMIRANTE">ALMIRANTE</option>
                            <option value="APOSTOLO">APOSTOLO</option>
                            <option value="ARCEBISPO">ARCEBISPO</option>
                            <option value="ARCIP">ARCIP</option>
                            <option value="ARCJO">ARCJO</option>
                            <option value="ARQUITETA">ARQUITETA</option>
                            <option value="ARQUITETO">ARQUITETO</option>
                            <option value="ARQUITETO PROFESSOR">
                              ARQUITETO PROFESSOR
                            </option>
                            <option value="ASPIRANTE">ASPIRANTE</option>
                            <option value="AVENIDA">AVENIDA</option>
                            <option value="AVIADOR">AVIADOR</option>
                            <option value="AVIADORA">AVIADORA</option>
                            <option value="BACHAREL">BACHAREL</option>
                            <option value="BANDEIRANTE">BANDEIRANTE</option>
                            <option value="BANQUEIRO">BANQUEIRO</option>
                            <option value="BARAO">BARAO</option>
                            <option value="BARONESA">BARONESA</option>
                            <option value="BEATO PADRE">BEATO PADRE</option>
                            <option value="BEM AVENTURADO">
                              BEM AVENTURADO
                            </option>
                            <option value="BENEMERITO">BENEMERITO</option>
                            <option value="BISPO">BISPO</option>
                            <option value="BRIGADEIRO">BRIGADEIRO</option>
                            <option value="CABO">CABO</option>
                            <option value="CABO PM">CABO PM</option>
                            <option value="CADETE">CADETE</option>
                            <option value="CAMPEADOR">CAMPEADOR</option>
                            <option value="CAPITAO">CAPITAO</option>
                            <option value="CAPITAO ALMIRANTE">
                              CAPITAO ALMIRANTE
                            </option>
                            <option value="CAPITAO DE FRAGATA">
                              CAPITAO DE FRAGATA
                            </option>
                            <option value="CAPITAO DE MAR E GUERRA">
                              CAPITAO DE MAR E GUERRA
                            </option>
                            <option value="CAPITAO GENERAL">
                              CAPITAO GENERAL
                            </option>
                            <option value="CAPITAO MOR">CAPITAO MOR</option>
                            <option value="CAPITAO PM">CAPITAO PM</option>
                            <option value="CAPITAO TENENTE">
                              CAPITAO TENENTE
                            </option>
                            <option value="CARDEAL">CARDEAL</option>
                            <option value="CATEQUISTA">CATEQUISTA</option>
                            <option value="CAVALEIRO">CAVALEIRO</option>
                            <option value="CAVALHEIRO">CAVALHEIRO</option>
                            <option value="CINEASTA">CINEASTA</option>
                            <option value="COMANDANTE">COMANDANTE</option>
                            <option value="COMEDIANTE">COMEDIANTE</option>
                            <option value="COMENDADOR">COMENDADOR</option>
                            <option value="COMISSARIA">COMISSARIA</option>
                            <option value="COMISSARIO">COMISSARIO</option>
                            <option value="COMPOSITOR">COMPOSITOR</option>
                            <option value="CONDE">CONDE</option>
                            <option value="CONDESSA">CONDESSA</option>
                            <option value="CONEGO">CONEGO</option>
                            <option value="CONFRADE">CONFRADE</option>
                            <option value="CONSELHEIRO">CONSELHEIRO</option>
                            <option value="CONSUL">CONSUL</option>
                            <option value="CORONEL">CORONEL</option>
                            <option value="CORONEL PM">CORONEL PM</option>
                            <option value="CORREGEDOR">CORREGEDOR</option>
                            <option value="DELEGADO">DELEGADO</option>
                            <option value="DENTISTA">DENTISTA</option>
                            <option value="DEPUTADA">DEPUTADA</option>
                            <option value="DEPUTADO">DEPUTADO</option>
                            <option value="DEPUTADO DOUTOR">
                              DEPUTADO DOUTOR
                            </option>
                            <option value="DESEMBARGADOR">DESEMBARGADOR</option>
                            <option value="DIACO">DIACO</option>
                            <option value="DOM">DOM</option>
                            <option value="DONA">DONA</option>
                            <option value="DOUTOR">DOUTOR</option>
                            <option value="DOUTORA">DOUTORA</option>
                            <option value="DUQUE">DUQUE</option>
                            <option value="DUQUESA">DUQUESA</option>
                            <option value="EDITOR">EDITOR</option>
                            <option value="EDUCADOR">EDUCADOR</option>
                            <option value="EDUCADORA">EDUCADORA</option>
                            <option value="EMBAIXADOR">EMBAIXADOR</option>
                            <option value="EMBAIXADORA">EMBAIXADORA</option>
                            <option value="ENGENHEIRA">ENGENHEIRA</option>
                            <option value="ENGENHEIRO">ENGENHEIRO</option>
                            <option value="ESCOTEIRO">ESCOTEIRO</option>
                            <option value="ESCRAVO">ESCRAVO</option>
                            <option value="ESCRITOR">ESCRITOR</option>
                            <option value="EXPEDICIONARIO">
                              EXPEDICIONARIO
                            </option>
                            <option value="FISICO">FISICO</option>
                            <option value="FREI">FREI</option>
                            <option value="GENERAL">GENERAL</option>
                            <option value="GOVERNADOR">GOVERNADOR</option>
                            <option value="GRUMETE">GRUMETE</option>
                            <option value="GUARDA CIVIL METROPOLITANO">
                              GUARDA CIVIL METROPOLITANO
                            </option>
                            <option value="IMACULADA">IMACULADA</option>
                            <option value="IMPERADOR">IMPERADOR</option>
                            <option value="IMPERATRIZ">IMPERATRIZ</option>
                            <option value="INFANTE">INFANTE</option>
                            <option value="INSPETOR">INSPETOR</option>
                            <option value="IRMA">IRMA</option>
                            <option value="IRMAO">IRMAO</option>
                            <option value="IRMAOS">IRMAOS</option>
                            <option value="IRMAS">IRMAS</option>
                            <option value="JORNALISTA">JORNALISTA</option>
                            <option value="LIBERTADOR">LIBERTADOR</option>
                            <option value="LIDCO">LIDCO</option>
                            <option value="LIVREIRO">LIVREIRO</option>
                            <option value="LORDE">LORDE</option>
                            <option value="MADAME">MADAME</option>
                            <option value="MADRE">MADRE</option>
                            <option value="MAESTRO">MAESTRO</option>
                            <option value="MAJOR">MAJOR</option>
                            <option value="MAJOR AVIADOR">MAJOR AVIADOR</option>
                            <option value="MAJOR BRIGADEIRO">
                              MAJOR BRIGADEIRO
                            </option>
                            <option value="MAQUINISTA">MAQUINISTA</option>
                            <option value="MARECHAL">MARECHAL</option>
                            <option value="MARECHAL DO AR">
                              MARECHAL DO AR
                            </option>
                            <option value="MARQUES">MARQUES</option>
                            <option value="MARQUESA">MARQUESA</option>
                            <option value="MERE">MERE</option>
                            <option value="MESTRAS">MESTRAS</option>
                            <option value="MESTRE">MESTRE</option>
                            <option value="MESTRES">MESTRES</option>
                            <option value="MILITANTE">MILITANTE</option>
                            <option value="MINISTRO">MINISTRO</option>
                            <option value="MISSIONARIA">MISSIONARIA</option>
                            <option value="MISSIONARIO">MISSIONARIO</option>
                            <option value="MONGE">MONGE</option>
                            <option value="MONSENHOR">MONSENHOR</option>
                            <option value="MUNIC">MUNIC</option>
                            <option value="MUSICO">MUSICO</option>
                            <option value="NOSSA SENHORA">NOSSA SENHORA</option>
                            <option value="NOSSO SENHOR">NOSSO SENHOR</option>
                            <option value="OUVIDOR">OUVIDOR</option>
                            <option value="PADRE">PADRE</option>
                            <option value="PADRES">PADRES</option>
                            <option value="PAI">PAI</option>
                            <option value="PAPA">PAPA</option>
                            <option value="PASTOR">PASTOR</option>
                            <option value="PATRIARCA">PATRIARCA</option>
                            <option value="POETA">POETA</option>
                            <option value="POETISA">POETISA</option>
                            <option value="PREFEITO">PREFEITO</option>
                            <option value="PRESIDENTE">PRESIDENTE</option>
                            <option value="PRESIDENTE DA ACAD.BRAS.LETRAS">
                              PRESIDENTE DA ACAD.BRAS.LETRAS
                            </option>
                            <option value="PREVR">PREVR</option>
                            <option value="PRIMEIRO SARGENTO">
                              PRIMEIRO SARGENTO
                            </option>
                            <option value="PRIMEIRO SARGENTO PM">
                              PRIMEIRO SARGENTO PM
                            </option>
                            <option value="PRIMEIRO TENENTE">
                              PRIMEIRO TENENTE
                            </option>
                            <option value="PRIMEIRO TENENTE PM">
                              PRIMEIRO TENENTE PM
                            </option>
                            <option value="PRINCESA">PRINCESA</option>
                            <option value="PRINCIPE">PRINCIPE</option>
                            <option value="PROCURADOR">PROCURADOR</option>
                            <option value="PROFESSOR">PROFESSOR</option>
                            <option value="PROFESSOR DOUTOR">
                              PROFESSOR DOUTOR
                            </option>
                            <option value="PROFESSOR ENGENHEIRO">
                              PROFESSOR ENGENHEIRO
                            </option>
                            <option value="PROFESSORA">PROFESSORA</option>
                            <option value="PROFETA">PROFETA</option>
                            <option value="PROMOTOR">PROMOTOR</option>
                            <option value="PROVEDOR">PROVEDOR</option>
                            <option value="PROVEDOR MOR">PROVEDOR MOR</option>
                            <option value="RABINO">RABINO</option>
                            <option value="RADIALISTA">RADIALISTA</option>
                            <option value="RAINHA">RAINHA</option>
                            <option value="REGENTE">REGENTE</option>
                            <option value="REI">REI</option>
                            <option value="REVERENDO">REVERENDO</option>
                            <option value="RUA">RUA</option>
                            <option value="SACERDOTE">SACERDOTE</option>
                            <option value="SANTA">SANTA</option>
                            <option value="SANTO">SANTO</option>
                            <option value="SAO">SAO</option>
                            <option value="SARGENTO">SARGENTO</option>
                            <option value="SARGENTO MOR">SARGENTO MOR</option>
                            <option value="SARGENTO PM">SARGENTO PM</option>
                            <option value="SEGUNDO SARGENTO">
                              SEGUNDO SARGENTO
                            </option>
                            <option value="SEGUNDO SARGENTO PM">
                              SEGUNDO SARGENTO PM
                            </option>
                            <option value="SEGUNDO TENENTE">
                              SEGUNDO TENENTE
                            </option>
                            <option value="SENADOR">SENADOR</option>
                            <option value="SENHOR">SENHOR</option>
                            <option value="SENHORA">SENHORA</option>
                            <option value="SERTANISTA">SERTANISTA</option>
                            <option value="SINHA">SINHA</option>
                            <option value="SIR">SIR</option>
                            <option value="SOCIOLOGO">SOCIOLOGO</option>
                            <option value="SOLDADO">SOLDADO</option>
                            <option value="SOLDADO PM">SOLDADO PM</option>
                            <option value="SOROR">SOROR</option>
                            <option value="SUB TENENTE">SUB TENENTE</option>
                            <option value="TENENTE">TENENTE</option>
                            <option value="TENENTE AVIADOR">
                              TENENTE AVIADOR
                            </option>
                            <option value="TENENTE BRIGADEIRO">
                              TENENTE BRIGADEIRO
                            </option>
                            <option value="TENENTE CORONE">
                              TENENTE CORONEL
                            </option>
                            <option value="TENENTE CORONEL PM">
                              TENENTE CORONEL PM
                            </option>
                            <option value="TEOLOGO">TEOLOGO</option>
                            <option value="TERCEIRO SARGENTO">
                              TERCEIRO SARGENTO
                            </option>
                            <option value="TERCEIRO SARGENTO PM">
                              TERCEIRO SARGENTO PM
                            </option>
                            <option value="TIA">TIA</option>
                            <option value="VEREADOR">VEREADOR</option>
                            <option value="VICE ALMIRANTE">
                              VICE ALMIRANTE
                            </option>
                            <option value="VICE REI">VICE REI</option>
                            <option value="VIGARIO">VIGARIO</option>
                            <option value="VISCONDE">VISCONDE</option>
                            <option value="VISCONDESSA">VISCONDESSA</option>
                            <option value="VOLUNTARIO">VOLUNTARIO</option>
                          </select>
                          <div class="invalid-feedback">
                            Por favor seleccione uma classificação.
                          </div>
                        </div>
                      </div>

                      <div class="mb-3">
                        <label>Logradouro Antigo:</label>
                        <h6>
                          Preencher apenas com o nome principal do logradouro
                          sem o título e sem preposição (de, dos, etc), sem
                          acentuação e sem cedilha. Ex. para "Praça do
                          Patriarca", escrever só "Patriarca"
                        </h6>
                        <input
                          type="text"
                          class="form-control"
                          id="logradouro-antigo"
                        />
                      </div>
                      <div class="mb-3">
                        <label>Número Antigo:</label>
                        <h6>
                          Se houver, ingressar o Número Antigo do endereço.
                        </h6>
                        <input
                          type="text"
                          class="form-control"
                          id="numero-antigo"
                        />
                      </div>

                      <div class="mb-3 p-2 subtitulos">
                        <h4>4. Ficha Técnica</h4>
                      </div>
                      <div class="row">
                        <div class="col-md-6 mb-3">
                          <label for="state">Autor</label>
                          <input
                            type="text"
                            class="form-control"
                            id="input-autor"
                          />
                        </div>
                        <div class="col-md-6 mb-3">
                          <label for="state">Constructor</label>
                          <input
                            type="text"
                            class="form-control"
                            id="input-constructor"
                          />
                        </div>
                      </div>
                      <div class="mb-3">
                        <label>Período da Construção:</label>
                        <input
                          type="text"
                          class="form-control"
                          id="periodo-construcao"
                        />
                      </div>
                      <div class="row">
                        <div class="col-md-6 mb-3">
                          <label>Estilo Arquitetônico Primário</label>
                          <select
                            id="grupo-arquitetonico-primario"
                            class="custom-select d-block w-100"
                          >
                            <option value="">
                              Selecionar uma classificação....
                            </option>
                            <option value="Art Deco">Art Deco</option>
                            <option value="Art Nouveau">Art Nouveau</option>
                            <option value="Bandeirista">Bandeirista</option>
                            <option value="Colonial">Colonial</option>
                            <option value="Eclético">Eclético</option>
                            <option value="Moderno">Moderno</option>
                            <option value="Neoclássico">Neoclássico</option>
                            <option value="Neocolonial">Neocolonial</option>
                            <option value="Neogótico">Neogótico</option>
                          </select>
                        </div>
                        <div class="col-md-6 mb-3">
                          <label>Estilo Arquitetônico Secundário</label>
                          <select
                            id="grupo-arquitectonico-secundario"
                            class="custom-select d-block w-100"
                          >
                            <option value="">Selecionar tipo...</option>
                            <option value="Art Deco">Art Deco</option>
                            <option value="Art Nouveau">Art Nouveau</option>
                            <option value="Bandeirista">Bandeirista</option>
                            <option value="Colonial">Colonial</option>
                            <option value="Eclético">Eclético</option>
                            <option value="Moderno">Moderno</option>
                            <option value="Neoclássico">Neoclássico</option>
                            <option value="Neocolonial">Neocolonial</option>
                            <option value="Neogótico">Neogótico</option>
                          </select>
                        </div>
                      </div>

                      <div class="mb-3">
                        <label>Estilo Arquitetônico - Observações:</label>

                        <textarea
                          class="form-control"
                          aria-label="With textarea"
                          id="estilo-arquitectonico-observacoes"
                        ></textarea>
                      </div>

                      <div class="row">
                        <div class="col-md-6 mb-3">
                          <label>Técnica Construtiva - Primária</label>
                          <select
                            id="tecnica-constructiva-primaria"
                            class="custom-select d-block w-100"
                          >
                            <option value="">
                              Selecionar uma classificação....
                            </option>
                            <option value="Adobe">Adobe</option>
                            <option value="Alvenaria de tijolos">
                              Alvenaria de tijolos
                            </option>
                            <option value="Concreto armado">
                              Concreto armado
                            </option>
                            <option value="Taipa-de-mão | Pau-a-pique">
                              Taipa-de-mão | Pau-a-pique
                            </option>
                            <option value="Taipa-de-pilão">
                              Taipa-de-pilão
                            </option>
                            <option value="Técnica Mista">Técnica Mista</option>
                          </select>
                        </div>
                        <div class="col-md-6 mb-3">
                          <label>Técnica Construtiva - Secundária</label>
                          <select
                            id="grupo-constructiva-secundaria"
                            class="custom-select d-block w-100"
                          >
                            <option value="">
                              Selecionar uma classificação....
                            </option>
                            <option value="Adobe">Adobe</option>
                            <option value="Alvenaria de tijolos">
                              Alvenaria de tijolos
                            </option>
                            <option value="Concreto armado">
                              Concreto armado
                            </option>
                            <option value="Taipa-de-mão | Pau-a-pique">
                              Taipa-de-mão | Pau-a-pique
                            </option>
                            <option value="Taipa-de-pilão">
                              Taipa-de-pilão
                            </option>
                            <option value="Técnica Mista">Técnica Mista</option>
                          </select>
                        </div>
                      </div>

                      <div class="mb-3">
                        <label>Técnica Construtiva - Observações:</label>
                        <textarea
                          class="form-control"
                          aria-label="With textarea"
                          id="tecnica-construtiva-observacoes"
                        ></textarea>
                      </div>
                      <div class="mb-3">
                        <label>Número de Pavimentos:</label>
                        <h6>
                          Inserir apenas o número de pavimentos. Porão, Sótão,
                          Alpendre, etc inserir no campo: Outras informações
                        </h6>
                        <input
                          type="text"
                          class="form-control"
                          id="numero-pavimentos"
                        />
                      </div>
                      <div class="mb-3">
                        <label>Outros:</label>
                        <div class="row m-2">
                          <div class="custom-control custom-checkbox mr-2">
                            <input
                              type="checkbox"
                              class="custom-control-input"
                              id="cb-terreo"
                            />
                            <label class="custom-control-label">Térreo</label>
                          </div>
                          <div class="custom-control custom-checkbox ml-2">
                            <input
                              type="checkbox"
                              class="custom-control-input"
                              id="cb-porao"
                            />
                            <label class="custom-control-label">Porão</label>
                          </div>
                        </div>
                      </div>
                      <div class="mb-3">
                        <label>Observações (pavimentos):</label>
                        <textarea
                          id="observacoes-pavimentos"
                          class="form-control"
                          aria-label="With textarea"
                        ></textarea>
                      </div>

                      <div class="mb-3 p-2 subtitulos">
                        <h4>5. Descrição</h4>
                      </div>
                      <div class="mb-3">
                        <label>Informações Históricas:</label>
                        <input
                          type="text"
                          class="form-control"
                          id="informacoes-historicas"
                        />
                      </div>
                      <div class="mb-3">
                        <label>Análise Arquitetônica:</label>
                        <input
                          type="text"
                          class="form-control"
                          id="analise-arquitectonica"
                        />
                      </div>
                      <div class="mb-3">
                        <label>Ambiência:</label>
                        <input
                          type="text"
                          class="form-control"
                          id="descricao-ambiencia"
                        />
                      </div>
                      <div class="mb-3">
                        <label>Outras Informações:</label>
                        <input
                          type="text"
                          class="form-control"
                          id="outras-informacoes"
                        />
                      </div>
                      <div class="mb-3">
                        <label>Grau de Tombamento:</label>
                        <input
                          type="text"
                          class="form-control"
                          id="grau-tombamento"
                        />
                      </div>
                      <div class="mb-3">
                        <label>Estado de Preservação</label>
                        <h6>
                          Selecionar alternativa que melhor descreva o estado de
                          preservação do bem, ou seja, se ele mantém suas
                          características de estilo e ambiência preservadas.
                        </h6>
                        <select
                          id="grupo-estado-preservacao"
                          class="custom-select d-block w-100"
                        >
                          <option value="">
                            Selecionar uma classificação....
                          </option>
                          <option value="Bom">Bom</option>
                          <option value="Regular">Regular</option>
                          <option value="Precario">Precario</option>
                        </select>
                      </div>

                      <div class="mb-3">
                        <label>Descrição do Estado de Preservação:</label>
                        <h6>
                          Inserir breve descrição quando houver informações
                          relevantes sobre o assunto
                        </h6>
                        <textarea
                          id="descripcao-estado-preservacao"
                          class="form-control"
                          aria-label="With textarea"
                        ></textarea>
                      </div>

                      <div class="mb-3">
                        <label>Estado de Conservação</label>
                        <h6>
                          Selecionar alternativa que melhor descreva o estado de
                          preservação do bem, ou seja, se ele mantém suas
                          características de estilo e ambiência preservadas.
                        </h6>
                        <select
                          id="grupo-estado-conservacao"
                          class="custom-select d-block w-100"
                        >
                          <option value="">
                            Selecionar uma classificação....
                          </option>
                          <option value="Bom">Bom</option>
                          <option value="Regular">Regular</option>
                          <option value="Precario">Precario</option>
                        </select>
                      </div>

                      <div class="mb-3">
                        <label>Descrição do Estado de Conservação:</label>
                        <h6>
                          Inserir breve descrição quando houver informações
                          relevantes sobre o assunto
                        </h6>
                        <textarea
                          id="descipcao-estado-conservacao"
                          class="form-control"
                          aria-label="With textarea"
                        ></textarea>
                      </div>
                      <div class="mb-3">
                        <label>Fontes Bibliográficas e Base de Dados</label>
                        <h6>
                          Inserir fontes bibliográficas e das imagens
                          utilizadas. Formato ABNT. Ferramenta para formatação
                          de referências em formato
                          <a
                            href="http://referencia.clevert.com.br/?page=refBib"
                            >ABNT (click here)</a
                          >
                        </h6>
                        <textarea
                          id="fontes-bibliograficas"
                          class="form-control"
                          aria-label="With textarea"
                        ></textarea>
                      </div>

                      <div class="mb-3 p-2 subtitulos">
                        <h4>6. Levantamento Fotográficoo</h4>
                      </div>

                      <div class="mb-3">
                        <label>Carregar Imagens:</label>
                        <h6>
                          Imagens em formato JPG com um máximo de 10 mb por
                          imagem
                        </h6>
                        <!-- <div class="input-group mb-3">
                          <div class="custom-file">
                            <input
                              type="file"
                              class="custom-file-input"
                              id="inputGroupFile02"
                            />
                            <label
                              class="custom-file-label"
                              for="inputGroupFile02"
                              >Pesquisar imagen</label
                            >
                          </div>
                          <div class="input-group-append">
                            <span class="input-group-text" id="">Carregar</span>
                          </div>
                        </div> -->
                      </div>

                      <hr class="mb-4" />

                      <div class="row justify-content-center">
                        <a
                          href="home.html"
                          name="btn-cancel"
                          class="btn btn-primary btn-lg m-2 col-md-3"
                          ><i class="fa fa-times" aria-hidden="true"></i>
                          Cancelar</a
                        >
                        <button
                          class="btn btn-info btn-lg m-2 col-md-3"
                          name="btn-guardar"
                          type="submit"
                          disabled
                        >
                          <i class="fa fa-floppy-o" aria-hidden="true"></i>
                          Guardar
                        </button>
                      </div>
                    </form>
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
                            <input type="email" class="form-control" name="email" value="<?php echo $email ?>" required>
                        </div>

                        <div class="form-group">
                            <label style="color: black">Status</label>
                            <select class="custom-select" name="status" required>
                                <option value="Ativo" <?php echo $status == 'Ativo' ? 'selected' : '' ?>>Ativo </option>
                                <option value="Inativo" <?php echo $status == 'Inativo' ? 'selected' : '' ?>>Inativo</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label style="color: black">Senha</label>
                            <input type="password" class="form-control" name="password" value="<?php echo $password ?>" required>
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
</html>