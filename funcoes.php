<?php
// Função de ler o arquivo, Se o arquivo existir retona o mesmo.
// Variável linha recebe o arquivo da variável arquivo, ignora novas linhas e pula linhas vazias.
function ler($arquivo) {
    if (!file_exists($arquivo)) return [];
    $linhas = file($arquivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    return array_map(fn($l) => explode('|', $l), $linhas);
}

// Função salvar recebe arquivos e dados.
function salvar($arquivo, $dados) {
    $linhas = array_map(fn($d) => implode('|', $d), $dados);
    file_put_contents($arquivo, implode("\n", $linhas));
}
?>
