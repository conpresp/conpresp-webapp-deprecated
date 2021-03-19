<?php


if(!isset($_GET['modulo'])){ echo '<pre>' . file_get_contents('texto.txt') . '</pre>' ; die();  }

require 'controller.php';
require 'templates/view.php';
require 'model/model.php';

$c = new Controller();

