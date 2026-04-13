<?php
include 'funcoes.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $perguntas = ler('perguntas.txt');
    $nova = [
        time(), 
        $_POST['tipo'], 
        $_POST['enunciado'], 
        $_POST['op1'] ?? '', $_POST['op2'] ?? '', $_POST['op3'] ?? '', $_POST['op4'] ?? '', 
        $_POST['resposta']
    ];
    $perguntas[] = $nova;
    salvar('perguntas.txt', $perguntas);
    header('Location: listar_perguntas.php');
}
?>
<form method="POST">
    Tipo: <select name="tipo"><option value="multipla">Múltipla</option><option value="texto">Texto</option></select><br>
    Enunciado: <input type="text" name="enunciado" required><br>
    Opções (preencha se for múltipla):<br>
    A: <input type="text" name="op1"> B: <input type="text" name="op2"><br>
    C: <input type="text" name="op3"> D: <input type="text" name="op4"><br>
    Resposta Correta (ou modelo de texto): <input type="text" name="resposta"><br>
    <button type="submit">Salvar Pergunta</button>
</form>
