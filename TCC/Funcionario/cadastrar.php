<?php

include("../Classe/Conexao.php");

$nome = isset($_POST["nome"]) ? $_POST["nome"] : NULL;
$data_nascimento = isset($_POST["data_nascimento"]) ? $_POST["data_nascimento"] : NULL;
$telefone = isset($_POST["telefone"]) ? $_POST["telefone"] : NULL;
$endereco = isset($_POST["endereco"]) ? $_POST["endereco"] : NULL;
$turno_disponivel = isset($_POST["turno_disponivel"]) ? $_POST["turno_disponivel"] : NULL;
$data_matricula = isset($_POST["data_matricula"]) ? $_POST["data_matricula"] : NULL;


$sql = ("INSERT INTO `funcionario` 
    (
        `nome`, 
        `data_nascimento`, 
        `telefone`, 
        `endereco`, 
        `turno_disponivel`,
        `data_matricula`
    ) 
    VALUES 
    (
        :nome,
        :data_nascimento,
        :telefone,
        :endereco,
        :turno_disponivel,
        :data_matricula
)");

$executar = Db::conexao()->prepare($sql);

$executar->bindValue(":nome", $nome, PDO::PARAM_STR);
$executar->bindValue(":data_nascimento", $data_nascimento, PDO::PARAM_STR);
$executar->bindValue(":telefone", $telefone, PDO::PARAM_STR);
$executar->bindValue(":endereco", $endereco, PDO::PARAM_STR);
$executar->bindValue(":turno_disponivel", $turno_disponivel, PDO::PARAM_STR);
$executar->bindValue(":data_matricula", $data_matricula, PDO::PARAM_STR);

$executar->execute();

header("Location: index.php");