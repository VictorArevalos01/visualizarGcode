<?php
public function renderizarEmHtml() {
    // Cria um elemento SVG
    $svg = new DOMDocument();
    $svg->appendChild($svg->createElement("svg"));
  
    // Adiciona a geometria ao SVG
    $this->adicionarGeometria($svg);
  
    // Obtém o código HTML do SVG
    $html = $svg->saveXML();
  
    return $html;
  }
  
  private function adicionarGeometria($svg) {
    // Adiciona os vértices ao SVG
    foreach ($this->vertices as $vertice) {
      $ponto = $svg->createElement("circle");
      $ponto->setAttribute("cx", $vertice[0]);
      $ponto->setAttribute("cy", $vertice[1]);
      $ponto->setAttribute("r", 1);
      $svg->documentElement->appendChild($ponto);
    }
  
    // Adiciona as faces ao SVG
    foreach ($this->faces as $face) {
      $linha = $svg->createElement("polygon");
      $linha->setAttribute("points", implode(",", $face));
      $svg->documentElement->appendChild($linha);
    }
  }
?>