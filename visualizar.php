<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Visualização do Arquivo .gcode</title>
</head>
<body>

  <h2>Visualização do Arquivo .gcode</h2>

  <?php
    require_once "GCode.php";
    include "mesh.php";
    include "renderizador.php";

    // Verifica se o arquivo existe
    if (!isset($_GET['file']) || !file_exists($_GET['file'])) {
      echo "O arquivo <b>{$_GET['file']}</b> não existe.";
      exit;
    }

    // Carrega o arquivo .gcode
    $fileName = $_GET['file'];
    $gcode = new GCode($fileName);

    // Obtém a geometria do arquivo GCode
    $geometria = $gcode->getGeometria();

    // Cria um objeto Mesh a partir da geometria
    $mesh = new Mesh($geometria[0], $geometria[1]);

    // Cria um objeto Renderizador
    $renderizador = new Renderizador($mesh);

    // Obtém o HTML da visualização
    $html = $renderizador->renderizarEmHtml();

    // Exibe a visualização
    echo $html;
  ?>

  <button onclick="rotateMesh()">Girar</button>

  <script>
    function rotateMesh() {
      // Gira a visualização em 90 graus
      $renderizador->rotate(90);
    }
  </script>

</body>
</html>
