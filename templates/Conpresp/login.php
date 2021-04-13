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
    <link rel="icon" href="img/logo.png" />
    <title>CONPRESP</title>
  </head>
  <body class="bg-darkblue">
    <section>
      <div class="row w-100 min-vh-100">
        <div class="col-lg-7 bg-darkgreen d-none d-lg-block">
          <!-- <div class="align-self-center"> -->
          <div class="px-lg-5 py-lg-4 p-4">
            <h1 class="text-center font-weight-bold mb-4">
              Bem-vindo ao CONPRESP
            </h1>
          </div>
          <div class="px-lg-5 pt-lg-4 pb-lg-3 p-4">
            <img src="img/login.svg" class="img-fluid" alt="" />
          </div>
          <!-- </div> -->
        </div>
        <div class="col-lg-5 bg-darkblue align-self-center">
          <div class="d-flex justify-content-around w-100">
            <h2 class="font-weight-normal mb-4">Login</h2>
            <img src="img/logo_1.png" class="p-2 img-logo" alt="" />
          </div>
          <div class="px-lg-5 py-lg-4 p-4 w-100 mt-auto">
          <?php if($msg != '') { ?>
          <div class="alert alert-danger" role="alert">
         <?php echo $msg ?>
          </div>
          <?php }?>
            <form class="nb-5" id="loginForm" method="POST" action="database/validaLogin.php">
              <div class="form-group mb-4">
                <label for="exampleInputEmail1" class="font-weight-bold"
                  >Email:</label
                >
                <input
                  type="email"
                  class="form-control bg-dark-x border-0"
                  id="inputEmail"
                  aria-describedby="emailHelp"
                  placeholder="Digite seu email"
                  name="email"
                  required
                />
              </div>
              <div class="form-group mb-4">
                <label for="exampleInputPassword1" class="font-weight-bold"
                  >Senha:</label
                >
                <input
                  type="password"
                  class="form-control bg-dark-x border-0 mb-2"
                  id="inputPassword"
                  placeholder="Digite sua senha"
                  name="password"
                  
                />
                <a
                  class="form-text text-muted"
                  href="#"
                  data-toggle="modal"
                  data-target="#resetPasswordModal"
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

    <!-- jQuery and Bootstrap Bundle (includes Popper) -->
    <script
      src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
      integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
