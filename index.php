<?php


if(!isset($_GET['modulo'])){ echo '<pre>' . header('Location: index.php?modulo=Conpresp&acao=login') . '</pre>' ; die();  }

require 'controller.php';
require 'templates/view.php';
require 'model/model.php';

$c = new Controller();

