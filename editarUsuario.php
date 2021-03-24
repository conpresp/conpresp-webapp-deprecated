<?php
session_start();

$servername = "localhost";
$usernames= "root";
$passwords = "";
$dbname = "conpresp_db";

// Create connection
$conn = new mysqli($servername, $usernames, $passwords, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$idd = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$result_usuario = "SELECT * FROM users WHERE id = '$idd'";
$resultado_usuario = mysqli_query($conn, $result_usuario);
$dados = mysqli_fetch_assoc($resultado_usuario);

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
    <script src="https://kit.fontawesome.com/5e195b88df.js" crossorigin="anonymous"></script>
    <link rel="icon" href="img/logo.png" />
    <title>CONPRESP</title>
</head>

<body>
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <nav class="navbar navbar-expand navbar-dark bg-darkblue topbar static-top shadow">
                <a class="navbar-brand" href="#">
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
                <li class="nav-item font-hover">
                    <a class="nav-link" href="home.php"><i class="fas fa-home bg-gray-icon"></i>Home</a>
                </li>
                <?php
                if ($perfil == 'Administrador') {
                ?>
                <li class="nav-item font-hover">
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
          <h1 class="h3 mb-0 text-gray-800">Novo Usuário</h1>
        </div>

        <!-- Content Row -->
        <div class="row">
          <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
              <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
              >
                <h6 class="m-0 font-weight-bold text-primary">
                  Editar Usuário
                </h6>
              </div>
              <div class="card-body">
                    <div class="container col-md-6">
                    <form method="post" action="editarUser.php" >

                    <div class="form-group">
                            <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $dados['id']; ?>" >
                        </div>

                        <div class="form-group">
                            <label style="color: black">Perfil</label>
                            <select class="custom-select"  name="perfil" required>
                            <option value="Comum" <?php echo $dados['perfil'] == 'Comum' ? 'selected' : ''  ?>>Comum </option>
                            <option value="Moderador" <?php echo $dados['perfil'] == 'Moderador' ? 'selected' : ''  ?>>Moderador </option>
                            <option value="Administrador" <?php echo $dados['perfil'] == 'Administrador' ? 'selected' : ''  ?>>Administrador</option>
                          </select>
                        </div>

                        <div class="form-group">
                            <label style="color: black">Nome</label>
                            <input type="text" class="form-control" name="username" value=" <?php echo $dados['username']?>"  required>
                        </div>

                        <div class="form-group">
                            <label style="color: black">Email</label>
                            <input type="email" class="form-control" name="email" value=" <?php echo $dados['email']?>" required>
                        </div>

                        <div class="form-group">
                          <label style="color: black">Status</label>
                          <select class="custom-select"  name="status" required>
                          <option value="Ativo" <?php echo $dados['status'] == 'Ativo' ? 'selected' : ''  ?>>Ativo </option>
                          <option value="Inativo" <?php echo $dados['status'] == 'Inativo' ? 'selected' : ''  ?>>Inativo</option>
                        </select>
                      </div>
                      

                        <div class="form-group">
                            <label style="color: black">Senha</label>
                            <input type="password" class="form-control" name="password" value="<?php echo $dados['password'] ?>" required>
                        </div>
                        <br>
                        <div class="form-group col-col-md-offset-4">
                            <button type="submit" class="btn btn-dark btn-lg btn-block" >Salvar</button>
                        </div>
                    </form>
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
                    <form method="post" action="editarUser.php">

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
            <a class="" href="#">
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