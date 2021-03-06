<?php

session_start();
header("Content-Type: text/html; charset=utf-8");
$servername = "db";
$usernames = "root";
$passwords = "123";
$dbname = "conpresp_db";
// Create connection
$conn = mysqli_connect($servername, $usernames, $passwords, $dbname) or die('Erro ao conectar');
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
  $idd = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
  $sql = "SELECT * from imovel where id = '$idd'";

  $result = mysqli_query($conn, $sql);

  $foto = "logo_1.png";

  $options = new options();
  $options->setIsRemoteEnabled(true);
  $pdf = new Dompdf($options);
  ob_start();
?>
  <!DOCTYPE html>
  <html>

  <head>
    <style>
      #customers {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;

      }

      #customers td,
      #customers th {
        border: 1px solid #ddd;
        padding: 2px;
      }

      #customers tr:nth-child(even) {
        background-color: #f2f2f2;
      }

      #customers tr:hover {
        background-color: #ddd;
      }

      #customers th {
        text-align: left;
        background-color: #595959;
        color: white;

      }
    </style>
  </head>

  <body>
    <?php
    while ($dados = mysqli_fetch_assoc($result)) {

      $mostrarData = '';
      $dados['dataConstrucao'] != '' ? $mostrarData = $dados['dataAproximada'] === 'datasim' ? 'c' : '' : '';
    ?>

      <table id="customers">
        <tr>
          <th>Responsável pelo Preenchimento</th>
          <th>Grupo</th>
        </tr>
        <tr>
          <td><?php echo $dados['responsavelPreenchimento'] ?></td>
          <td><?php echo $dados['grupoTipoEquipe'] ?></td>
        </tr>
      </table>
      <table id="customers">
        <tr>
          <th style="text-align: center;">Dados Gerais</th>
        </tr>
      </table>
      <table id="customers">
        <tr>
          <th>Item na Resolução</th>
          <th>Denominação</th>
          <th>Classificação</th>
        </tr>
        <tr>
          <td><?php echo $dados['itemResolucao'] ?></td>
          <td><?php echo $dados['denominacao'] ?></td>
          <td><?php echo $dados['classificacao'] ?></td>
        </tr>
      </table>
      <table id="customers">
        <tr>
          <th>Uso Atual</th>
          <th>Propriedade</th>
          <th>Uso Original</th>
        </tr>
        <tr>
          <td><?php echo $dados['usoAtual'] ?></th>
          <td><?php echo $dados['propriedade'] ?></td>
          <td><?php echo $dados['terreo'] ?></td>
        </tr>
      </table>
      <table id="customers">
        <tr>
          <th style="text-align: center;">Tombamento</th>
        </tr>
      </table>
      <table id="customers">
        <tr>
          <th>Resolução Conpresp</th>
          <th>A.T</th>
          <th>Resolução Condephaat</th>
          <th>A.T</th>
          <th>Resolução Iphan</th>
          <th>A.T</th>
        </tr>
        <tr>
          <td><?php echo $dados['resolucaoTombamento'] ?></td>
          <td><?php echo $dados['anoConpresp'] ?></td>
          <td><?php echo $dados['resolucaoCondephaat'] ?></td>
          <td><?php echo $dados['anoCondephaat'] ?></td>
          <td><?php echo $dados['resolucaoIphan'] ?></td>
          <td><?php echo $dados['anoIphan'] ?></td>
        </tr>
      </table>
      <table id="customers">
        <tr>
          <th style="text-align: center;">Endereço</th>
        </tr>
      </table>
      <table id="customers">
        <tr>
          <th>Logradouro</th>
          <th>Número</th>
        </tr>
        <tr>
          <td><?php echo $dados['logradouro'] ?></td>
          <td><?php echo $dados['numeroEndereco'] ?></td>
        </tr>
      </table>
      <table id="customers">
        <tr>
          <th>Distrito</th>
          <th>Prefeitura Regional</th>
          <th style="width: 15%;">Setor</th>
          <th style="width: 15%;">Quadra</th>
          <th style="width: 15%;">Lote</th>
        </tr>
        <tr>
          <td><?php echo $dados['distrito'] ?></td>
          <td><?php echo $dados['prefeituraRegional'] ?></td>
          <td><?php echo $dados['setor'] ?></td>
          <td><?php echo $dados['quadra'] ?></td>
          <td><?php echo $dados['lote'] ?></td>
        </tr>
      </table>
      <table id="customers">
        <tr>
          <th style="text-align: center;">Ficha Ténica</th>
        </tr>
      </table>
      <table id="customers">
        <tr>
          <th style="width: 52%;">Autor Projeto Original</th>
          <th>Construtor</th>
        </tr>
        <tr>
          <td><?php echo $dados['autorOriginal'] ?></td>
          <td><?php echo $dados['construtor'] ?></td>
        </tr>
      </table>
      <table id="customers">
        <tr>
          <th style="width:40%">Data de Construção</th>
          <th>Estilo Arquitetônico</th>
          <th>Técnica Construtiva</th>
        </tr>
        <tr>
          <td><?php echo $dados['dataConstrucao'] . ' ' ?> <i><?php echo $mostrarData ?></i></td>
          <td><?php echo $dados['estiloArquitetonico'] ?></td>
          <td><?php echo $dados['tecnicaConstrutiva'] ?></td>
        </tr>
      </table>
      <table id="customers">
        <tr>
          <th>Número de Pavimentos</th>
          <th>Área do lote</th>
          <th>Área construída</th>
          <th>Grau de Tombamento</th>
          <th>Grau de alteração</th>
          <th>Estado de Conservação</th>
        </tr>
        <tr>
          <td><?php echo $dados['numeroPavimentos'] ?></td>
          <td><?php echo $dados['areaLote'] ?></td>
          <td><?php echo $dados['areaConstruida'] ?></td>
          <td><?php echo $dados['grauTombamento'] ?></td>
          <td><?php echo $dados['grauAlteracao'] ?></td>
          <td><?php echo $dados['grauEstadoConservacao'] ?></td>
        </tr>
      </table>
      <table id="customers">
        <tr>
          <th style="text-align: center;">Descrição</th>
        </tr>
      </table>
      <table id="customers">
        <tr>
          <th>Dados Históricos</th>
          <th>Dados Arquitetônico</th>
        </tr>
        <tr>
          <td><?php echo $dados['dadosHistoricos'] ?></td>
          <td><?php echo $dados['dadosArquitetonicos'] ?></td>
        </tr>
      </table>
      <table id="customers">
        <tr>
          <th style="width: 50%;">Dados de Ambiência</th>
          <th style="width: 50%;">Fontes Bibliográficas</th>
        </tr>
        <tr>
          <td><?php echo $dados['dadosAmbiencia'] ?></td>
          <td><?php echo $dados['fontesBibliograficas'] ?></td>
        </tr>
        <tr>
          <th>Outras Informações</th>
          <th>observações</th>
        </tr>
        <tr>
          <td><?php echo $dados['outrasInformacoes'] ?></td>
          <td><?php echo $dados['observacoes'] ?></td>
        </tr>
      </table>
      <table id="customers">
        <tr>
          <th style="text-align: center;">Documentação Fotográfica</th>
        </tr>
      </table>
      <table id="customers">
        <tr>
          <td>
            <?php if (isset($dados['documentacaoFotografica']) && $dados['documentacaoFotografica'] != null && $dados['documentacaoFotografica'] != ' ') {   ?>
              <img src="http://conpresp-api.test/imgFotografica/img1/<?php echo $dados['documentacaoFotografica'] ?>" width="200px" height="100px" />
            <?php } ?>
          </td>
          <td>
            <?php if (isset($dados['documentacaoFotografica2']) && $dados['documentacaoFotografica2'] != null && $dados['documentacaoFotografica2'] != ' ') {   ?>
              <img src="http://conpresp-api.test/imgFotografica/img2/<?php echo $dados['documentacaoFotografica2'] ?>" width="200px" height="100px" />
            <?php } ?>
          </td>
          <td>
            <?php if (isset($dados['documentacaoFotografica3']) && $dados['documentacaoFotografica3'] != null && $dados['documentacaoFotografica3'] != ' ') {   ?>
              <img src="http://conpresp-api.test/imgFotografica/img3/<?php echo $dados['documentacaoFotografica3'] ?>" width="200px" height="100px" />
            <?php } ?>
          </td>
        </tr>
      </table>

      <table id="customers">
        <tr>
          <th style="text-align: center;">Documentação Gráfica</th>
        </tr>
      </table>
      <table id="customers">
        <tr>
          <td>
            <?php if (isset($dados['documentacaoGrafica']) && $dados['documentacaoGrafica'] != null && $dados['documentacaoGrafica'] != ' ') {   ?>
              <img src="http://conpresp-api.test/imgGrafica/img1/<?php echo $dados['documentacaoGrafica'] ?>" width="200px" height="100px" />
            <?php } ?>
          </td>
          <td>
            <?php if (isset($dados['documentacaoGrafica2']) && $dados['documentacaoGrafica2'] != null && $dados['documentacaoGrafica2'] != ' ') {   ?>
              <img src="http://conpresp-api.test/imgGrafica/img2/<?php echo $dados['documentacaoGrafica2'] ?>" width="200px" height="100px" />
            <?php } ?>
          </td>
          <td>
            <?php if (isset($dados['documentacaoGrafica3']) && $dados['documentacaoGrafica3'] != null && $dados['documentacaoGrafica3'] != ' ') {   ?>
              <img src="http://conpresp-api.test/imgGrafica/img3/<?php echo $dados['documentacaoGrafica3'] ?>" width="200px" height="100px" />
            <?php } ?>
          </td>
        </tr>
      </table>
    <?php } ?>

  </body>

  </html>

<?php

  $html = ob_get_clean();

  $pdf->loadHtml($html);

  $pdf->setPaper('A4', 'landscape');
  $pdf->render();

  $pdf->stream("relatorio.pdf", array("Attachment" => false));
}
?>