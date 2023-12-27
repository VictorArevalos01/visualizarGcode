<?php

class GCode {

    private $fileName;
    private $geometria;

    public function __construct($fileName) {
        $this->fileName = $fileName;

        // Verifica se o arquivo existe
        if (!file_exists($this->fileName)) {
            throw new Exception("O arquivo GCode não existe.");
        }

        // Carrega o arquivo GCode
        $this->geometria = $this->carregarArquivo();
    }

    private function carregarArquivo() {
        $geometria = [];

        try {
            $arquivo = fopen($this->fileName, "r");

            if ($arquivo) {
                while (!feof($arquivo)) {
                    $linha = fgets($arquivo);

                    // Adicione a linha à geometria apenas se não estiver vazia
                    if (!empty($linha)) {
                        $geometria[] = $this->parsearLinha($linha);
                    }
                }

                fclose($arquivo);
            } else {
                throw new Exception("Erro ao abrir o arquivo GCode.");
            }
        } catch (Exception $e) {
            throw new Exception("Erro ao carregar arquivo GCode", 1);
        }

        return $geometria;
    }

    private function parsearLinha($linha) {
        $linha = trim($linha);

        // Remove comentários
        $posicaoDoComentario = strpos($linha, "#");
        if ($posicaoDoComentario !== false) {
            $linha = substr($linha, 0, $posicaoDoComentario);
        }

        return $linha;
    }

    public function getGeometria() {
        return $this->geometria;
    }

    public function renderizarEmHtml() {
        // Implemente aqui o código para renderizar a geometria em HTML
    }

    public function validarGeometria() {
        // Implemente aqui o código para validar a geometria
    }
}

?>
