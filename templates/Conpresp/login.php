<?php 
session_start();

if(isset($_SESSION['erroLogin'])) {
  $msg = $_SESSION['erroLogin'];
  unset($_SESSION['erroLogin']);
}
else {
  $msg = '';
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <!-- Bootstrap CSS -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
      integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="css/login.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap"
      rel="stylesheet"
    />
    <script
      src="https://kit.fontawesome.com/5e195b88df.js"
      crossorigin="anonymous"
    ></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="icon" href="img/logo.png" />
    <title>Banco de dados dos bens tombados da cidade de São Paulo</title>
  </head>
  <body style="background-color: white;">
    <script src="../../validateCampos/usuario.js"></script>
    <section>
      <div class="row w-100 min-vh-100">
        <div class="col-lg-7 d-none d-lg-block" style="background-color:#55AAB5">
          <!-- <div class="align-self-center"> -->
          <!-- <div class="px-lg-5 py-lg-4 p-4">
            <h1 class="text-center font-weight-bold mb-4">
              Bem-vindo ao CONPRESP
            </h1>
          </div> -->
          <div >
            <img src="img/imgLogin2.jpeg" style="width: 100%;height:100%"  />
            <div class="responsivoFonteLogin">
            <p style="margin-left:5%; margin-top: -72%; font-size: 35px; font-family: Arial, Helvetica, sans-serif;"><b>Banco de Dados dos</b></p>
            <p style="margin-left:5%; margin-top: -15px;font-size: 35px;font-family: Arial, Helvetica, sans-serif;"><b>Bens Tombados da</b></p>
            <p style="margin-left:5%; margin-top: -15px; font-size: 35px;font-family: Arial, Helvetica, sans-serif;"><b>cidade de São Paulo</b></p>
            <p style="margin-left:97%; margin-top: 30px; font-size: 12px;font-family: Arial, Helvetica, sans-serif;writing-mode: vertical-lr;transform: rotate(180deg)"><b>Ilustrações feitas por Mariana Cerqueira </b></p>
            </div>
          </div>
          <!-- </div> -->
        </div>
        <div class="col-lg-5 bg-darkblue align-self-center">
          <div class="d-flex justify-content-around w-100">
            <img src="img/new_logo.png"  height="80px" style="margin-top: 50px; margin-left:20px" />
            <img src="img/logo_1.png" class="p-2 img-logo" alt="" />
          </div>
          <h2 class="font-weight-normal mb-1" style="color: black; margin-left: 50px;">Login</h2>
          <div class="px-lg-5 py-lg-4 p-4 w-100 mt-auto">
          <?php if($msg != '') { ?>
          <div class="alert alert-danger" role="alert">
         <?php echo $msg ?>
          </div>
          <?php }?>
            <form class="nb-5" id="formUsuario" method="POST" action="database/validaLogin.php">
              <div class="form-group mb-4">
                <label for="exampleInputEmail1" class="font-weight-bold" style="color: black;"
                  >Email:</label
                >
                <input
                  type="email"
                  class="form-control bg-dark-x border-1"
                  id="inputEmail"
                  aria-describedby="emailHelp"
                  placeholder="Digite seu email"
                  name="email"
                  id="email"
                />
              </div>
              <div class="form-group mb-4">
                <label for="exampleInputPassword1" class="font-weight-bold" style="color: black;"
                  >Senha:</label
                >
                <input
                  type="password"
                  class="form-control bg-dark-x border-1 mb-2"
                  placeholder="Digite sua senha"
                  name="password"
                  id="password"
                                />
                <a
                  class="form-text"
                  href="#"
                  data-toggle="modal"
                  data-target="#resetPasswordModal"
                  style="color: #737373"
                  >Esqueceu a senha?</a
                >
              </div>

              <button id="btnLogin" type="submit" class="btn btn-primary w-100">
                <i class="loading-icon fa fa-spinner fa-spin d-none"></i>
                <span class="btn-txt"> Iniciar sessão </span>
              </button>
            </form>
          </div>
        </div>
      </div>
    </section>

    <!-- Modal Esqueci Senha-->
    <div
      class="modal fade"
      id="resetPasswordModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="text-dark">Esqueci a Senha</h3>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p class="text-dark">
              Iremos enviar-lhe um link de recuperação de senha para o seu
              email, após clicar no botão, verifique a sua caixa de entrada do
              email.
            </p>
            <form id="resetpasswordForm" action="">
              <div class="form-group">
                <input
                  type="email"
                  id="resetpasswordEmail"
                  class="form-control"
                  placeholder="Digite seu email"
                  required
                />
              </div>
              <button type="submit" class="btn btn-primary">
                Redefinir senha
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
