<?php
// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se o arquivo foi enviado sem erros
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        // Diretório para armazenar os arquivos (certifique-se de ter permissões de escrita)
        $uploadDir = 'uploads/';
        
        // Gera um nome único para o arquivo
        $fileName = uniqid('gcode_') . '.gcode';
        
        // Caminho completo para o arquivo
        $filePath = $uploadDir . $fileName;

        // Move o arquivo para o diretório de upload
        if (move_uploaded_file($_FILES['file']['tmp_name'], $filePath)) {
            // Redireciona para a página de visualização com o nome do arquivo
            header("Location: visualizar.php?file=$fileName");
            exit();
        } else {
            echo "Erro ao mover o arquivo para o diretório de upload.";
        }
    } else {
        echo "Erro no upload do arquivo.";
    }
} else {
    echo "Acesso inválido ao script de processamento.";
}
?>
