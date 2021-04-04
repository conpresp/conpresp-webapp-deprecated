<?php
session_start();
$servername = "localhost";
$usernames = "root";
$passwords = "";
$dbname = "conpresp_db";
// Create connection
$conn = mysqli_connect($servername, $usernames, $passwords, $dbname) or die('Erro ao conectar');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$id = $_SESSION['id'];
$perfil = $_SESSION['perfil'];
$username = $_SESSION['username'];
$email = $_SESSION['email'];
$status = $_SESSION['status'];
$password = $_SESSION['password'];

//verificar se está sendo passado na URL a pagina atual, se não atribui a pagina como 1
$pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1;

//Seleciona todos os registro da tabela
if (!mysqli_set_charset($conn, "utf8mb4")) {
    printf("Error loading character set utf8mb4: %s\n", mysqli_error($conn));
    exit();
} else {
    if(!isset($_GET['pesquisar'])){
        header("Location: home.php");
    } else {
        $valorPesquisar = $_GET['pesquisar'];
    }
    if(!isset($_GET['tipoPesquisa'])){
        header("Location: home.php");
    } else {
        $check = $_GET['tipoPesquisa'];
    }
    
    if($check == 'respPreenchimento'){
    $sql = "SELECT * from imovel where responsavelPreenchimento like '%$valorPesquisar%'";  
    } else if($check == 'resConpresp') {
    $sql = "SELECT * from imovel where resolucaoTombamento like '%$valorPesquisar%'"; 
    } else if($check == 'denominacao'){
    $sql = "SELECT * from imovel where denominacao like '%$valorPesquisar%'";   
    } else if($check == 'terreo'){
    $sql = "SELECT * from imovel where terreo like '%$valorPesquisar%'";   
    } else if($check == 'tipo'){
    $sql = "SELECT * from imovel where tipo like '%$valorPesquisar%'";   
    } else if($check == 'titulo'){
    $sql = "SELECT * from imovel where titulo like '%$valorPesquisar%'";   
    } else if($check == 'logradouro'){
    $sql = "SELECT * from imovel where logradouro like '%$valorPesquisar%'";   
    } else if($check == 'numero'){
    $sql = "SELECT * from imovel where numeroEndereco like '%$valorPesquisar%'";
    } else if($check == 'distrito'){
    $sql = "SELECT * from imovel where distrito like '%$valorPesquisar%'";   
    } else if($check == 'subprefeitura'){
    $sql = "SELECT * from imovel where prefeituraRegional like '%$valorPesquisar%'";   
    } else if($check == 'autorOriginal'){
    $sql = "SELECT * from imovel where autorOriginal like '%$valorPesquisar%'";   
    } else if($check == 'dataConstrucao'){
    $sql = "SELECT * from imovel where 	dataConstrucao like '%$valorPesquisar%'";   
    } else if($check == 'estiloArquitetonico'){
    $sql = "SELECT * from imovel where estiloArquitetonico like '%$valorPesquisar%'";   
    }

    $result = $conn->query($sql);

    //Contar todos os registros do banco
    $total_registros = mysqli_num_rows($result);

    $quantidade_pg = 10;

    $num_paginas = ceil($total_registros / $quantidade_pg);

    $inicio = ($quantidade_pg * $pagina) - $quantidade_pg;

    if($check == 'respPreenchimento'){
    $result_registro = "SELECT * FROM imovel where responsavelPreenchimento like '%$valorPesquisar%' limit $inicio, $quantidade_pg";   
    } else if($check == 'resConpresp') {
    $result_registro = "SELECT * FROM imovel where resolucaoTombamento like '%$valorPesquisar%' limit $inicio, $quantidade_pg"; 
    } else if($check == 'denominacao'){
    $result_registro = "SELECT * FROM imovel where denominacao like '%$valorPesquisar%' limit $inicio, $quantidade_pg"; 
    } else if($check == 'terreo'){
    $result_registro = "SELECT * FROM imovel where terreo like '%$valorPesquisar%' limit $inicio, $quantidade_pg"; 
    } else if($check == 'tipo'){
    $result_registro = "SELECT * FROM imovel where tipo like '%$valorPesquisar%' limit $inicio, $quantidade_pg"; 
    } else if($check == 'titulo'){
    $result_registro = "SELECT * FROM imovel where titulo like '%$valorPesquisar%' limit $inicio, $quantidade_pg"; 
    } else if($check == 'logradouro'){
    $result_registro = "SELECT * FROM imovel where logradouro like '%$valorPesquisar%' limit $inicio, $quantidade_pg"; 
    } else if($check == 'numero'){
    $result_registro = "SELECT * FROM imovel where numeroEndereco like '%$valorPesquisar%' limit $inicio, $quantidade_pg"; 
    } else if($check == 'distrito'){
    $result_registro = "SELECT * FROM imovel where distrito like '%$valorPesquisar%' limit $inicio, $quantidade_pg"; 
    } else if($check == 'subprefeitura'){
    $result_registro = "SELECT * FROM imovel where prefeituraRegional like '%$valorPesquisar%' limit $inicio, $quantidade_pg"; 
    } else if($check == 'autorOriginal'){
    $result_registro = "SELECT * FROM imovel where autorOriginal like '%$valorPesquisar%' limit $inicio, $quantidade_pg"; 
    } else if($check == 'dataConstrucao'){
    $result_registro = "SELECT * FROM imovel where dataConstrucao like '%$valorPesquisar%'  limit $inicio, $quantidade_pg"; 
    } else if($check == 'estiloArquitetonico'){
    $result_registro = "SELECT * FROM imovel where estiloArquitetonico like '%$valorPesquisar%'  limit $inicio, $quantidade_pg"; 
    }

    $resultado_registro = mysqli_query($conn, $result_registro);

    $total_registros = mysqli_num_rows($resultado_registro);

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
                <div class="row h-100 d-flex justify-content-center">
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2 bg-darkblue">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="mr-3">
                                        <div class="text-xs font-weight-normal mb-1">
                                            <a href="index.php?modulo=Conpresp&acao=docConpresp" class="small text-white stretched-link text-decoration-none">
                                                Novo
                                            </a>
                                        </div>
                                        <div class="text-xs font-weight-bold text-uppercase mb-1">
                                            Preenchimento
                                        </div>
                                    </div>
                                    <i width="24" height="24" class="fas fa-file-signature fa-3x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    if ($perfil == 'Administrador') {
                    ?>
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2 bg-green">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="mr-3">
                                            <div class="text-xs font-weight-normal mb-1">
                                                <a href="index.php?modulo=Conpresp&acao=cadastro" class="small text-white stretched-link text-decoration-none">
                                                    Novo
                                                </a>
                                            </div>
                                            <div class="text-xs font-weight-bold text-uppercase mb-1">
                                                Usuário
                                            </div>
                                        </div>
                                        <i width="24" height="24" class="fas fa-users fa-3x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="hidden">
                            <div class="card border-left-warning shadow h-100 py-2 bg-green">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                </div>

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Fichas da preserva</h1>
                </div>

                <!-- Content Row -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">
                                    Lista de preenchimentos
                                </h6>
                            </div>
                            <div class="card-body">
                                <form class="form-inline" method="GET" action="HomePesquisa.php" style="margin-top:50px">

                                    <div class="col-md-6 mb-3" style="margin-top: 7px;">
                                        <select id="tipoPesquisa" class="custom-select d-block w-100" name="tipoPesquisa">
                                            <option value="" selected disabled>
                                                Pesquisar por...
                                            </option>
                                            <option value="respPreenchimento" <?php echo $check == 'respPreenchimento' ? 'selected' : ''  ?>>Responsável pelo Preenchimento</option>
                                            <option value="resConpresp" <?php echo $check == 'resConpresp' ? 'selected' : ''  ?>> Resolução Conpresp</option>
                                            <option value="denominacao" <?php echo $check== 'denominacao' ? 'selected' : ''  ?>>Denominação </option>
                                            <option value="terreo" <?php echo $check == 'terreo' ? 'selected' : ''  ?>>Uso Original (Térreo)</option>
                                            <option disabled>----------------------------------------</option>
                                            <option value="tipo" <?php echo $check == 'tipo' ? 'selected' : ''  ?>>Tipo do Endereço</option>
                                            <option value="titulo" <?php echo $check =='titulo' ? 'selected' : ''  ?>>Título</option>
                                            <option value="logradouro" <?php echo $check == 'logradouro' ? 'selected' : ''  ?>>logradouro</option>
                                            <option value="numero" <?php echo $check  =='numero' ? 'selected' : ''  ?>>Número do Endereço</option>
                                            <option value="distrito" <?php echo $check == 'distrito' ? 'selected' : ''  ?>>Distrito</option>
                                            <option value="subprefeitura" <?php echo $check== 'subprefeitura' ? 'selected' : ''  ?>>Prefeitura Regional</option>
                                            <option disabled>----------------------------------------</option>
                                            <option value="autorOriginal" <?php echo $check == 'autorOriginal' ? 'selected' : ''  ?>>Autor do projeto original</option>
                                            <option value="dataConstrucao" <?php echo $check == 'dataConstrucao' ? 'selected' : ''  ?>>Data de construção</option>
                                            <option value="estiloArquitetonico" <?php echo $check == 'estiloArquitetonico' ? 'selected' : ''  ?>>Estilo Arquitetônico</option>
                                            
                                        </select>
                                    </div>

                                    <div class="form-group mx-sm-3 mb-2">
                                        <label for="pesquisar" class="sr-only" style="color:black">Nome</label>
                                        <input type="text" class="form-control" placeholder="Pesquisar..." name="pesquisar" value=" <?php echo $valorPesquisar ?>">
                                    </div>
                                    <button type="submit" class="btn btn-primary mb-2" style="margin-left: 10px;">Pesquisar</button>
                                    <a href="home.php"><button type="button" class="btn btn-primary mb-2" style="margin-left: 10px;">Resetar</button></a>
                                </form>
                                <script>
                               
                                </script>
                                <div class="table-responsive" style="margin-top:50px">
                                    <table class="table table-hover" id="tablaHome">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">#</th>
                                                <!-- <th scope="col">Código</th> -->
                                                <th scope="col">Conpresp/Resolução</th>
                                                <th scope="col">Denominação</th>
                                                <!-- <th scope="col">LPP</th> -->
                                                <th scope="col">Grau de alteração</th>
                                                <th scope="col">Estado de conservação</th>
                                                <th scope="col d-none d-lg-block"></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbodyList" class="text-body">
                                            <?php
                                            while ($dados = mysqli_fetch_assoc($resultado_registro)) {
                                            ?>
                                                <tr>
                                                    <td style="color:black"><?php echo $dados['id']; ?></td>
                                                    <td style="color:black"><?php echo $dados['resolucaoTombamento']; ?></td>
                                                    <td style="color:black"><?php echo $dados['denominacao']; ?></td>
                                                    <td style="color:black"><?php echo $dados['grauAlteracao']; ?></td>
                                                    <td style="color:black"><?php echo $dados['grauEstadoConservacao']; ?></td>
                                                    <td class="sorting_1">
                                                    <div class="wrapper text-center">
                                                            <div class="btn-group">
                                                                <a href="visualizarPreenchimento.php?id=<?php echo $dados['id'];  ?>"><button class="btnVer btn btn-info" data-toggle="tooltip" title="Ver"><i class="fas fa-eye" aria-hidden="true"></i></button></a>
                                                                <?php
                                                                if ($perfil == "Administrador" || $perfil == "Moderador") { ?>
                                                                    <a href="editarPreenchimento.php?id=<?php echo $dados['id'];  ?>" ><button class="btnEditar btn btn-warning" data-toggle="tooltip" title="Editar"><i class="fas fa-edit" aria-hidden="true"></i></button></a>
                                                                <?php   }
                                                                ?>
                                                                <a href="pdf.php?id=<?php echo $dados['id'];  ?>"><button class="btnPdf btn btn-success" data-toggle="tooltip" title="Pdf"><i class="fas fa-print" aria-hidden="true"></i></button></a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                        </tbody>
                                    <?php } ?>
                                    </table>
                                    <?php
                                    $pagina_anterior = $pagina - 1;
                                    $pagina_posterior = $pagina + 1;
                                    ?>
                                    <nav aria-label="...">
                                        <ul class="pagination p-4 pagination-sm d-flex justify-content-center flex-wrap">
                                            <li class="page-item ">
                                                <a class="page-link" href="homePesquisa.php?pagina=<?php echo 1 ?>&tipoPesquisa=<?php echo $check ?>&pesquisar=<?php echo $valorPesquisar ?>">Primeira</a>
                                            </li>
                                            <?php
                                            for ($i = 1; $i < $num_paginas + 1; $i++) {
                                                $estilo = "";
                                                if ($pagina == $i)
                                                    $estilo = "class='page-item active'";
                                            ?>
                                                <li <?php echo $estilo ?>><a class="page-link " href="homePesquisa.php?pagina=<?php echo $i ?>&tipoPesquisa=<?php echo $check ?>&pesquisar=<?php echo $valorPesquisar ?>"><?php echo $i ?></a></li>
                                            <?php    } ?>
                                            <li class="page-item">
                                                <a class="page-link"  href="homePesquisa.php?pagina=<?php echo $num_paginas ?>&tipoPesquisa=<?php echo $check ?>&pesquisar=<?php echo $valorPesquisar ?>">Última</a>
                                            </li>
                                        </ul>
                                    </nav>
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
<?php } ?>

    </html>