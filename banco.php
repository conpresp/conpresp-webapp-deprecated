<?php

 $servername = "db";
 $usernames = "root";
 $passwords = "";
 $dbname = "conpresp_db";

$mysqli = mysqli_connect($servername, $usernames,$passwords, $dbname);

if($mysqli-> connect_errno)
 echo "Falha na conexao: (".$mysqli->connect_errno.") ".$mysqli->connect_errno;
 mysqli_close($mysqli);
