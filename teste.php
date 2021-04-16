<?php

session_start();
header("Content-Type: text/html; charset=utf-8");
$servername = "localhost";
$usernames = "root";
$passwords = "";
$dbname = "conpresp_db";
// Create connection
$conn= mysqli_connect($servername, $usernames, $passwords, $dbname) or die('Erro ao conectar');
// Check connection

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

use Dompdf\Dompdf;
use Dompdf\Options;
require_once 'dompdf/autoload.inc.php';

if (!mysqli_set_charset($conn, "utf8mb4")) {
    printf("Error loading character set utf8mb4: %s\n", mysqli_error($conn));
    exit();
} else {
$sql = "select * from users";

$result = $conn->query($sql);

$foto = "logo_1.png";

$options = new options ();
$options -> setIsRemoteEnabled (true);
$pdf = new Dompdf($options);
ob_start();
?>
<html>

<head>
</head>

<body>
    <div class="container">
    <input type="text" value="Caio"/>
            <table class="myTable">
                <thead >
                    <tr>
                        <th class="head" style="width: 8%;">#</th>
                        <th class="head">Nome</th>
                        <th class="head">Email</th>
                        <th class="head">Perfil</th>
                        <th class="head">Status</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($dado = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <th class="result"><?php echo $dado['id']; ?></th>
                            <td class="result" ><?php echo $dado['username']; ?></td>
                            <td class="result" ><?php echo $dado['email']; ?></td>
                            <td class="result"><?php echo $dado['perfil']; ?></td>
                            <td class="result"><?php echo $dado['status']; ?></td>
                        </tr>
                </tbody>
            <?php } ?>
            </table>

            <img src="http://conpresp-api.test/img/<?php echo $foto ?>" width="100px" height="100px" style="margin-top: 100px;"></img>
            <style>
            .myTable {
                border-collapse: collapse;
                width: 100%;
            }

            .head {
                background-color: black;
                color: white;
                font-family: Arial, Helvetica, sans-serif;
                text-align: left;
            }

            .result {
                text-align: left;
            }
            </style>

        </div>
</body>

</html>

<!-- <!DOCTYPE html>
<html>
<head>
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #333;
  color: white;
}
</style>
</head>
<body>

<table id="customers">
  <tr>
    <th>Company</th>
    <th>Contact</th>
    <th>Country</th>
  </tr>
  <tr>
    <td>Alfreds Futterkiste</td>
    <td>Maria Anders</td>
    <td>Germany</td>
  </tr>
  <tr>
    <td>Berglunds snabbköp</td>
    <td>Christina Berglund</td>
    <td>Sweden</td>
  </tr>
  <tr>
    <td>Centro comercial Moctezuma</td>
    <td>Francisco Chang</td>
    <td>Mexico</td>
  </tr>
  <tr>
    <td>Ernst Handel</td>
    <td>Roland Mendel</td>
    <td>Austria</td>
  </tr>
  <tr>
    <td>Island Trading</td>
    <td>Helen Bennett</td>
    <td>UK</td>
  </tr>
  <tr>
    <td>Königlich Essen</td>
    <td>Philip Cramer</td>
    <td>Germany</td>
  </tr>
  <tr>
    <td>Laughing Bacchus Winecellars</td>
    <td>Yoshi Tannamuri</td>
    <td>Canada</td>
  </tr>
  <tr>
    <td>Magazzini Alimentari Riuniti</td>
    <td>Giovanni Rovelli</td>
    <td>Italy</td>
  </tr>
  <tr>
    <td>North/South</td>
    <td>Simon Crowther</td>
    <td>UK</td>
  </tr>
  <tr>
    <td>Paris spécialités</td>
    <td>Marie Bertrand</td>
    <td>France</td>
  </tr>
</table>

</body>
</html> -->

<?php

$html = ob_get_clean();

$pdf->loadHtml($html);

$pdf -> setPaper('A4', 'landscape');
$pdf->render();

$pdf->stream("relatorio.pdf", array("Attachment" => false));
        }  
?>