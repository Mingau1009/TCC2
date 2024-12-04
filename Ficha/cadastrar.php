<?php

include("../Classe/Conexao.php");

$aluno = isset($_POST["nome"]) ? $_POST["nome"] : NULL;
$nomeFicha = isset($_POST["nomeFicha"]) ? $_POST["nomeFicha"] : NULL;
$dia_treino = isset($_POST["dia"]) ? $_POST["dia"] : NULL;
$nome_exercicio = isset($_POST["exercicio"]) ? $_POST["exercicio"] : NULL;
$num_series = isset($_POST["series"]) ? $_POST["series"] : NULL;
$num_repeticoes = isset($_POST["repeticoes"]) ? $_POST["repeticoes"] : NULL;
$tempo_descanso = isset($_POST["descanso"]) ? $_POST["descanso"] : NULL;

$sql = ("INSERT INTO `ficha` 
    (
        `aluno`, 
        `nomeFicha`, 
        `dia_treino`,
        `nome_exercicio`, 
        `num_series`, 
        `num_repeticoes`,
        `tempo_descanso`
    ) 
    VALUES 
    (
        :aluno,
        :nomeFicha,
        :dia_treino,
        :nome_exercicio,
        :num_series,
        :num_repeticoes,
        :tempo_descanso
)");

$executar = Db::conexao()->prepare($sql);

$executar->bindValue(":aluno", $aluno, PDO::PARAM_STR);
$executar->bindValue(":nomeFicha", $nomeFicha, PDO::PARAM_STR);
$executar->bindValue(":dia_treino", $dia_treino, PDO::PARAM_STR);
$executar->bindValue(":nome_exercicio", $nome_exercicio, PDO::PARAM_STR);
$executar->bindValue(":num_series", $num_series, PDO::PARAM_INT);
$executar->bindValue(":num_repeticoes", $num_repeticoes, PDO::PARAM_INT);
$executar->bindValue(":tempo_descanso", $tempo_descanso, PDO::PARAM_INT);


$executar->execute();

header("Location: index.php");