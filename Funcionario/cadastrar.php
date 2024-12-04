<?php

include("../Classe/Conexao.php");

$nome = isset($_POST["name"]) ? $_POST["name"] : NULL;
$data_nascimento = isset($_POST["sdate"]) ? $_POST["sdate"] : NULL;
$telefone = isset($_POST["telefone"]) ? $_POST["telefone"] : NULL;
$endereco = isset($_POST["address"]) ? $_POST["address"] : NULL;
$turno_disponivel = isset($_POST["frequency"]) ? $_POST["frequency"] : NULL;


$sql = ("INSERT INTO `funcionario` 
    (
        `nome`, 
        `data_nascimento`, 
        `telefone`, 
        `endereco`, 
        `turno_disponivel`
    ) 
    VALUES 
    (
        :nome,
        :data_nascimento,
        :telefone,
        :endereco,
        :turno_disponivel
)");

$executar = Db::conexao()->prepare($sql);

$executar->bindValue(":nome", $nome, PDO::PARAM_STR);
$executar->bindValue(":data_nascimento", $data_nascimento, PDO::PARAM_STR);
$executar->bindValue(":telefone", $telefone, PDO::PARAM_STR);
$executar->bindValue(":endereco", $endereco, PDO::PARAM_STR);
$executar->bindValue(":turno_disponivel", $turno_disponivel, PDO::PARAM_STR);

$executar->execute();

header("Location: index.php");