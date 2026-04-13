<?php
// Inclui o arquivo com as funções.
include 'funcoes.php';
// Variável Perguntas recebe o resultado da função ler com perguntas.txt
$perguntas = ler('perguntas.txt');

if (isset($_GET['excluir'])) {
    $id = $_GET['excluir'];
    $perguntas = array_filter($perguntas, fn($p) => $p[0] != $id);
    salvar('perguntas.txt', $perguntas);
    header('Location: listar_perguntas.php');
}

// Título com a Lista de Perguntas em HTML.
echo "<h2>Lista de Perguntas</h2><table border='1'>";
foreach ($perguntas as $p) {
    echo "<tr>
            <td>$p[2] ($p[1])</td>
            <td>
                <a href='alterar_pergunta.php?id=$p[0]'>Alterar</a> | 
                <a href='?excluir=$p[0]'>Excluir</a>
            </td>
          </tr>";
}
echo "</table>";
?>
