<?php

include("../Classe/Conexao.php");

$nome = isset($_POST["nome"]) ? $_POST["nome"] : NULL;
$data_nascimento = isset($_POST["data_nascimento"]) ? $_POST["data_nascimento"] : NULL;
$telefone = isset($_POST["telefone"]) ? $_POST["telefone"] : NULL;
$endereco = isset($_POST["endereco"]) ? $_POST["endereco"] : NULL;
$frequencia = isset($_POST["frequencia"]) ? $_POST["frequencia"] : NULL;
$objetivo = isset($_POST["objetivo"]) ? $_POST["objetivo"] : NULL;
$data_matricula = isset($_POST["data_matricula"]) ? $_POST["data_matricula"] : NULL;

$sql = ("INSERT INTO `aluno` 
    (
        `nome`, 
        `data_nascimento`, 
        `telefone`, 
        `endereco`, 
        `frequencia`, 
        `objetivo`, 
        `data_matricula`
    ) 
    VALUES 
    (
        :nome,
        :data_nascimento,
        :telefone,
        :endereco,
        :frequencia,
        :objetivo,
        :data_matricula
)");

$executar = Db::conexao()->prepare($sql);

$executar->bindValue(":nome", $nome, PDO::PARAM_STR);
$executar->bindValue(":data_nascimento", $data_nascimento, PDO::PARAM_STR);
$executar->bindValue(":telefone", $telefone, PDO::PARAM_STR);
$executar->bindValue(":endereco", $endereco, PDO::PARAM_STR);
$executar->bindValue(":frequencia", $frequencia, PDO::PARAM_INT);
$executar->bindValue(":objetivo", $objetivo, PDO::PARAM_STR);
$executar->bindValue(":data_matricula", $data_matricula, PDO::PARAM_STR);

$executar->execute();

header("Location: index.php");