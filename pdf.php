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

$html = '
        <html>
        <head>
        </head>
        <body>
        <h1 style="font-family: Arial, Helvetica, sans-serif; text-align: center">Usuários - Gerar PDF</h1>
        <table width="100%" style="height:30.00pt;mso-height-source:userset;mso-height-alt:600;border:2.0pt solid #000; margin-top:50px">
        <thead>
        <tr>
        <td style="background-color: black; color: white;font-family: Arial, Helvetica, sans-serif;height:30px"> ID </td>
        <td style="background-color: black; color: white;font-family: Arial, Helvetica, sans-serif;"> Perfil </td>
        <td style="background-color: black; color: white;font-family: Arial, Helvetica, sans-serif;"> Nome </td>
        <td style="background-color: black; color: white;font-family: Arial, Helvetica, sans-serif;"> Email </td>
        <td style="background-color: black; color: white;font-family: Arial, Helvetica, sans-serif;"> Status </td>
        </td>
        </thead>';

$consulta = "SELECT * from users";
$resultado = mysqli_query($conn,$consulta);

while($dados = mysqli_fetch_assoc($resultado)){
   $html .= '<tbody>';
   $html .= '<tr><td style="text-align: left;font-family: Arial, Helvetica, sans-serif;">'. $dados['id'] . "</td>";
   $html .= '<td style="text-align: left;font-family: Arial, Helvetica, sans-serif;">'. $dados['perfil'] . "</td>";
   $html .= '<td style="text-align: left;font-family: Arial, Helvetica, sans-serif;">'. $dados['username'] . "</td>";
   $html .= '<td style="text-align: left;font-family: Arial, Helvetica, sans-serif;">'. $dados['email'] . "</td>";
   $html .= '<td style="text-align: left;font-family: Arial, Helvetica, sans-serif;">'.$dados['status'] . "</td></tr></tbody>";
}

$html .= '</table>';
$html .= '
        <table width="100%" style="height:30.00pt;mso-height-source:userset;mso-height-alt:600;border:2.0pt solid #000; margin-top:50px">
        <thead>
        <tr>
        <td style="background-color: black; color: white;font-family: Arial, Helvetica, sans-serif;height:30px"> ID </td>
        <td style="background-color: black; color: white;font-family: Arial, Helvetica, sans-serif;"> Perfil </td>
        <td style="background-color: black; color: white;font-family: Arial, Helvetica, sans-serif;"> Nome </td>
        <td style="background-color: black; color: white;font-family: Arial, Helvetica, sans-serif;"> Email </td>
        <td style="background-color: black; color: white;font-family: Arial, Helvetica, sans-serif;"> Status </td>
        </td>
        </thead>';
        $consulta2 = "SELECT * from users";
$resultado2 = mysqli_query($conn,$consulta2);

while($dados2 = mysqli_fetch_assoc($resultado2)){
   $html .= '<tbody>';
   $html .= '<tr><td style="text-align: left;font-family: Arial, Helvetica, sans-serif;">'. $dados2['id'] . "</td>";
   $html .= '<td style="text-align: left;font-family: Arial, Helvetica, sans-serif;">'. $dados2['perfil'] . "</td>";
   $html .= '<td style="text-align: left;font-family: Arial, Helvetica, sans-serif;">'. $dados2['username'] . "</td>";
   $html .= '<td style="text-align: left;font-family: Arial, Helvetica, sans-serif;">'. $dados2['email'] . "</td>";
   $html .= '<td style="text-align: left;font-family: Arial, Helvetica, sans-serif;">'.$dados2['status'] . "</td></tr></tbody>";
}
$html .= '</table>';
$html .= '</body>';
$html .= '</html>';

use Dompdf\Dompdf;

require_once 'dompdf/autoload.inc.php';

$pdf = new Dompdf();

$pdf -> loadHtml($html);

$pdf -> render();

$pdf -> stream("relatorio.pdf",array ("Attachment" => false));

?>