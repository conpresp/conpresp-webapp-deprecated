<?php
session_start();
session_destroy();
header("Location: index.php?modulo=Conpresp&acao=login");
?>