<?php
session_start();

$servername = "localhost";
$usernames = "root";
$passwords = "";
$dbname = "conpresp_db";
// Create connection
$conn = new mysqli($servername, $usernames, $passwords, $dbname);
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

if (!mysqli_set_charset($conn, "utf8mb4")) {
    printf("Error loading character set utf8mb4: %s\n", mysqli_error($conn));
    exit();
} else {
    //verificar se está sendo passado na URL a pagina atual, se não atribui a pagina como 1
    $pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1;
    if (!isset($_GET['pesquisar'])) {
        header("Location: usuarios.php");
    } else {
        $valorPesquisar = $_GET['pesquisar'];
    }
    if (!isset($_GET['tipoPesquisa'])) {
        header("Location: usuarios.php");
    } else {
        $check = $_GET['tipoPesquisa'];
    }

    if ($check == 'username') {
        $sql = "SELECT * from users where username like '%$valorPesquisar%'";
    } else if ($check == 'email') {
        $sql = "SELECT * from users where email like '%$valorPesquisar%'";
    } else if ($check == 'perfil') {
        $sql = "SELECT * from users where perfil like '%$valorPesquisar%'";
    } else if ($check == 'status' && $valorPesquisar == 'Ativo' || $check == 'status' && $valorPesquisar == 'ativo') {
        $sql = "SELECT * from users where status like 'a%'";
    } else if ($check == 'status' && $valorPesquisar == 'Inativo' || $check == 'status' && $valorPesquisar == 'inativo') {
        $sql = "SELECT * from users where status like 'i%'";
    } else if ($check == 'status' && $valorPesquisar == '') {
        $sql = "SELECT * from users where status like '%$valorPesquisar%'";
    } else if ($check == 'status' && $valorPesquisar != 'Ativo' || $check == 'status' && $valorPesquisar != 'ativo' || $check == 'status' && $valorPesquisar != 'Inativo' || $check == 'status' && $valorPesquisar != 'inativo') {
        $sql = "SELECT * from users where status like '%$valorPesquisar%'";
    }

    //Seleciona todos os registro da tabela


    $result = mysqli_query($conn, $sql);

    //Contar todos os registros do banco
    $total_registros = mysqli_num_rows($result);

    $quantidade_pg = 5;

    $num_paginas = ceil($total_registros / $quantidade_pg);

    $inicio = ($quantidade_pg * $pagina) - $quantidade_pg;

    if ($check == 'username') {
        $result_registro = "SELECT * FROM users where username like '%$valorPesquisar%' ORDER BY username  limit $inicio, $quantidade_pg";
    } else if ($check == 'email') {
        $result_registro = "SELECT * FROM users where email like '%$valorPesquisar%' ORDER BY username  limit $inicio, $quantidade_pg";
    } else if ($check == 'perfil') {
        $result_registro = "SELECT * FROM users where perfil like '%$valorPesquisar%' ORDER BY username  limit $inicio, $quantidade_pg";
    } else if ($check == "status" && $valorPesquisar == 'Ativo' || $check == 'status' && $valorPesquisar == 'ativo') {
        $result_registro = "SELECT * FROM users where status like 'a%' ORDER BY username  limit $inicio, $quantidade_pg";
    } else if ($check == "status" && $valorPesquisar == 'Inativo' || $check == 'status' && $valorPesquisar == 'inativo') {
        $result_registro = "SELECT * FROM users where status like 'i%' ORDER BY username  limit $inicio, $quantidade_pg";
    } else if ($check == "status" && $valorPesquisar == '') {
        $result_registro = "SELECT * FROM users where status like '%$valorPesquisar%' ORDER BY username  limit $inicio, $quantidade_pg";
    } else if ($check == 'status' && $valorPesquisar != 'Ativo' || $check == 'status' && $valorPesquisar != 'ativo' || $check == 'status' && $valorPesquisar != 'Inativo' || $check == 'status' && $valorPesquisar != 'inativo') {
        $result_registro = "SELECT * FROM users where status like '%$valorPesquisar%' ORDER BY username  limit $inicio, $quantidade_pg";
    }

    $resultado_registro = mysqli_query($conn, $result_registro);

    $total_registros = mysqli_num_rows($resultado_registro);

    $msg = '';
    if($total_registros == 0) {
        $msg = 'Nenhum resultado encontrado!';
    }

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

        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

        <link rel="stylesheet" href="css/usuarios.css" />

        <style>
            .hidden {
                display: none;
            }

            body {
                background-color: white;
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
                            <a class="nav-link" href="" data-toggle="modal" data-target="#agregarUsuarioModal"><i class="fas fa-users bg-gray-icon"></i>Novo Usuário</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </nav>

        <div class="container">
            <form class="form-inline" method="GET" action="pesquisa.php" style="margin-top:50px">
                <div class="col-md-6 mb-3" style="margin-top: 7px;">
                    <select id="tipoPesquisa" class="custom-select d-block w-100" name="tipoPesquisa">
                        <option value="" selected disabled>
                            Pesquisar por...
                        </option>
                        <option value="username">Nome</option>
                        <option value="email">Email</option>
                        <option value="perfil">Perfil</option>
                        <option value="status">Status</option>
                    </select>
                </div>

                <div class="form-group mx-sm-3 mb-2">
                    <label for="pesquisar" class="sr-only" style="color:black">Nome</label>
                    <input type="text" class="form-control" placeholder="Pesquisar..." name="pesquisar">
                </div>
                <button type="submit" class="btn btn-primary mb-2" style="margin-left: 10px;">Pesquisar</button>
                <a href="usuarios.php"><button type="button" class="btn btn-primary mb-2" style="margin-left: 10px;">Resetar</button></a>
            </form>
            <div class="table-responsive-sm">
            <p style="color: black;text-align: center" ><?php echo $msg?></p>
                <table class="table" style="margin-top: 30px">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Email</th>
                            <th scope="col">Perfil</th>
                            <th scope="col">Status</th>
                            <th scope="col">Editar</th>
                            <th scope="col">Deletar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($dado = mysqli_fetch_assoc($resultado_registro)) {
                        ?>
                            <tr>
                                <th scope="row"><?php echo $dado['id']; ?></th>
                                <td style="color:black"><?php echo $dado['username']; ?></td>
                                <td style="color:black"><?php echo $dado['email']; ?></td>
                                <td style="color:black"><?php echo $dado['perfil']; ?></td>
                                <td style="color:black"><?php echo $dado['status']; ?></td>
                                <td><a href="editarUsuario.php?id=<?php echo $dado['id'];  ?>"><span class="material-icons" style="color:#00e676">create</span></a></td>
                                <td>
                                    <a href="javascript: if(confirm('Tem certeza que deseja deletar a conta, <?php echo $dado['username']; ?>?'))
			              location.href='deletar.php?id=<?php echo $dado['id']; ?>';">
                                        <span class="material-icons" style="color: red">delete </span></a>
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
                            <a class="page-link" href="pesquisa.php?pagina=<?php echo 1 ?>&tipoPesquisa=<?php echo $check ?>&pesquisar=<?php echo $valorPesquisar ?>">Primeira</a>
                        </li>
                        <?php
                        for ($i = 1; $i < $num_paginas + 1; $i++) {
                            $estilo = "";
                            if ($pagina == $i)
                                $estilo = "class='page-item active'";
                        ?>
                            <li <?php echo $estilo ?>><a class="page-link " href="pesquisa.php?pagina=<?php echo $i ?>&tipoPesquisa=<?php echo $check ?>&pesquisar=<?php echo $valorPesquisar ?>"><?php echo $i ?></a></li>
                        <?php    } ?>
                        <li class="page-item">
                            <a class="page-link" href="pesquisa.php?pagina=<?php echo $num_paginas ?>&tipoPesquisa=<?php echo $check ?>&pesquisar=<?php echo $valorPesquisar ?>">Última</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <!-- Modal Agregar Usuario-->
        <div class="modal fade" id="agregarUsuarioModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3> Novo Usuário</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="database/validaCadastro.php">

                            <div class="form-group">
                                <select class="custom-select" id="agregarUsuarioSelect" name="perfil" required>
                                    <option value="Comum" selected>Usuário Comum</option>
                                    <option value="Moderador"> Usuário Moderador</option>
                                    <option value="Administrador">Usuário Administrador</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <input type="text" id="agregarUsuarioName" class="form-control" placeholder="Nome" name="username" required />
                            </div>

                            <div class="form-group">
                                <input type="email" id="agregarUsuarioEmail" class="form-control" placeholder="Email" name="email" required />
                            </div>


                            <div class="form-group">
                                <select class="custom-select" id="agregarUsuarioSelect" name="status" required>
                                    <option value="Ativo" selected>Status Ativo</option>
                                    <option value="Inativo">Status Inativo</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <input type="password" id="agregarUsuarioPassword" class="form-control" placeholder="Senha" name="password" required />
                            </div>

                            <button type="submit" class="btn btn-primary">Cadastrar</button>
                        </form>
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
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
        <script type="text/javascript" src="personalizado.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

        <!-- sweetalert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.14.2/dist/sweetalert2.all.min.js"></script>
    </body>
<?php } ?>

    </html>