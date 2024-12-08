<?php include("../Classe/Conexao.php") ?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <title>Área de Cadastro de Exercício</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<br>
    <div class="text-end">
        <button class="btn btn-success botao-cadastrar" data-bs-toggle="modal" data-bs-target="#cadastrar">
            CADASTRAR
        </button>
    </div>
    
    

    <table class="table table-striped table-hover mt-3 text-center table-bordered">
        <thead>
            <tr>
                <th>Aluno</th>
                <th>Nome da Ficha</th>
                <th>Ajustes</th>
            </tr>
        </thead>
        <tbody id="data">
        <?php $fichas = Db::conexao()->query("SELECT `ficha`.*, `aluno`.`nome` AS aluno_nome FROM `ficha` INNER JOIN `aluno` ON `aluno`.`id` = `ficha`.`aluno_id`")->fetchAll(PDO::FETCH_OBJ); ?>
            <?php foreach ($fichas as $ficha) { ?>
                <tr>
                    <td><?php echo $ficha->aluno_nome; ?></td>
                    <td><?php echo $ficha->nome; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

<?php $alunos = Db::conexao()->query("SELECT * FROM `aluno` ORDER BY `nome` ASC")->fetchAll(PDO::FETCH_OBJ);?>
<?php $exercicios = Db::conexao()->query("SELECT * FROM `exercicio` ORDER BY `nome` ASC")->fetchAll(PDO::FETCH_OBJ);?>

<form method="POST" id="formulario-cadastrar-ficha">
    <div class="modal fade" id="cadastrar" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">FICHA DE TREINO</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label>ALUNO</label>
                            <select name="aluno_id" class="form-control">
                                <option value="">SELECIONE...</option>
                                <?php foreach($alunos as $aluno) { ?>
                                    <option value="<?php echo $aluno->id; ?>"><?php echo $aluno->nome; ?></option>
                                <?php } ?>
                            </select>
                        </div>
    
                        <div class="col-md-6">
                            <label>NOME DA FICHA</label>
                            <input type="text" name="nome" class="form-control" required>
                        </div>
    
                        <div class="col-md-6">
                            <label>DIA DO TREINO</label>
                            <select class="form-control" name="dia_treino" required>
                                <option value="">SELECIONE...</option>
                                <option value="SEGUNDA">Segunda</option>
                                <option value="TERCA">Terça</option>
                                <option value="QUARTA">Quarta</option>
                                <option value="QUINTA">Quinta</option>
                                <option value="SEXTA">Sexta</option>
                                <option value="SABADO">Sábado</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mt-2 bg-light pt-2 pb-2">
                        <div class="col-md-12">
                            <label>EXERCÍCIO</label>
                            <select name="exercicio_id" class="form-control">
                                <option data-nome="" value="">SELECIONE...</option>
                                <?php foreach($exercicios as $exercicio) { ?>
                                    <option data-nome="<?php echo $exercicio->nome; ?>" value="<?php echo $exercicio->id ?>"><?php echo $exercicio->nome; ?></option>
                                <?php } ?>
                            </select>
                        </div>
    
                        <div class="col-md-6">
                            <label>Nº SÉRIES</label>
                            <input type="number" name="num_series" class="form-control" required>
                        </div>
    
                        <div class="col-md-6">
                            <label>Nº REPETIÇÕES</label>
                            <input type="number" name="num_repeticoes" class="form-control" required>
                        </div>
    
                        <div class="col-md-12">
                            <label>TEMPO DESCANO</label>
                            <div class="input-group">
                                <input type="number" name="tempo_descanso" class="form-control" required>
                                <div class="input-group-pprend">
                                    <button type="button" class="btn btn-primary botao-cadastro-ficha-lista-exercicios">ADICIONAR EXERCÍCIO</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <table class="table table-sm table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>EXERCÍCIO</th>
                                        <th>Nº SÉRIES</th>
                                        <th>Nº REPETIÇÕES</th>
                                        <th>TEMPO DESCANO</th>
                                    </tr>
                                </thead>
                                <tbody id="cadastro-ficha-lista-exercicios"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">FECHAR</button>
                    <button type="submit" class="btn btn-success submit">CADASTRAR</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="app.js"></script>
    
</body>
</html>
