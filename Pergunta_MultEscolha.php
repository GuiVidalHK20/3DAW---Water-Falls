<?php
include 'funcoes.php';

$erro = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $enunciado = trim($_POST['enunciado'] ?? '');

    if (empty($enunciado)) {
        $erro = "O enunciado não pode estar vazio.";
    } else {
       
        $enunciado = str_replace('|', '-', $enunciado);
        $op1 = str_replace('|', '-', trim($_POST['op1'] ?? ''));
        $op2 = str_replace('|', '-', trim($_POST['op2'] ?? ''));
        $op3 = str_replace('|', '-', trim($_POST['op3'] ?? ''));
        $op4 = str_replace('|', '-', trim($_POST['op4'] ?? ''));
        $resposta = str_replace('|', '-', trim($_POST['resposta'] ?? ''));

       
        if (empty($op1) || empty($op2)) {
            $erro = "Preencha pelo menos as opções A e B.";
        } else {
            $perguntas = ler('perguntas.txt');

            $nova = [
                time(),       // id único baseado no momento atual
                'multipla',   // tipo fixo nesse arquivo
                $enunciado,
                $op1, $op2, $op3, $op4,
                $resposta
            ];

            $perguntas[] = $nova;
            salvar('perguntas.txt', $perguntas);

          
            header('Location: listar_perguntas.php');
            exit; 
        }
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Nova Pergunta - Múltipla Escolha</title>
</head>
<body>
    <h2>Criar Pergunta de Múltipla Escolha</h2>

 
    <?php if ($erro): ?>
        <p style="color:red"><?= $erro ?></p>
    <?php endif; ?>

    <form method="POST">
        <label>Enunciado:</label><br>
        <input type="text" name="enunciado" size="60" required><br><br>

        <label>Opções:</label><br>
        A: <input type="text" name="op1" required>
        B: <input type="text" name="op2" required><br>
        C: <input type="text" name="op3">
        D: <input type="text" name="op4"><br><br>

        <label>Resposta correta (A, B, C ou D):</label>
        <input type="text" name="resposta" maxlength="1" required><br><br>

        <button type="submit">Salvar Pergunta</button>
        <a href="listar_perguntas.php">Cancelar</a>
    </form>
</body>
</html>
