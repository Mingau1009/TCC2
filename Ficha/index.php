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

    <section class="p-3">
        <div class="d-flex justify-content-between align-items-center">
            <div class="col-4">
                <button class="btn btn-success newUser" data-bs-toggle="modal" data-bs-target="#userForm">
                    Cadastrar Ficha
                </button>
            </div>
        </div>

        <br>
        <div class="row mb-3">
        <div class="col-12 text-start">
            <div class="input-group short-input">
                <span class="input-group-text" id="basic-addon1">
                    <i class="bi bi-search"></i> <!-- Ícone de lupa -->
                </span>
                <input type="text" class="form-control search-input" placeholder="Buscar por funcionário..." aria-label="Buscar por funcionário..." aria-describedby="basic-addon1">
                
            </div>
        </div>
    </div>
    </section>

    <br>

    <div class="row">
        <div class="col-12">
            <table class="table table-striped table-hover mt-3 text-center table-bordered">
                <thead>
                    <tr>
                        <th>Aluno</th>
                        <th>Nome da Ficha</th>
                        <th>Ajustes</th>
                    </tr>
                </thead>
                <tbody id="data">
                <?php $fichas = Db::conexao()->query("SELECT * FROM `ficha`")->fetchAll(PDO::FETCH_OBJ); ?>
                    <?php foreach ($fichas as $ficha) { ?>
                        <tr>
                            <td><?php echo $ficha->aluno; ?></td>
                            <td><?php echo $ficha->nomeFicha; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

<!-- Modal de Cadastro de Exercício -->
<form method="POST" action="cadastrar.php">
    <div class="modal fade" id="userForm">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ficha de Matrícula do Aluno</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <div class="inputField">
                        <div class="mb-3">
                        <label for="nomeAluno" class="form-label">Aluno</label>
                        <input type="text" name="nome" class="form-control" id="nomeAluno" required>
                    </div>
                    <div class="mb-3">
                        <label for="nomeFicha" class="form-label">Nome da Ficha</label>
                        <input type="text" name="nomeFicha" class="form-control" id="nomeFicha" required>
                    </div>
                    <div class="mb-3">
                        <label for="diaTreino" class="form-label">Dia do Treino</label>
                        <select class="form-control" name="dia" id="diaTreino" required>
                            <option value="">Selecione o dia</option>
                            <option value="Segunda">Segunda</option>
                            <option value="Terça">Terça</option>
                            <option value="Quarta">Quarta</option>
                            <option value="Quinta">Quinta</option>
                            <option value="Sexta">Sexta</option>
                            <option value="Sábado">Sábado</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nomeExercicio" class="form-label">Nome do Exercício</label>
                        <select name="exercicio" class="form-control" id="nomeExercicio">
                            <option value="">Selecione o exercício</option>
                            <?php
                                $query = Db::conexao()->query("SELECT id, nome FROM exercicio ORDER BY nome ASC");
                                $exercicios = $query->fetchAll(PDO::FETCH_ASSOC);

                                foreach($exercicios as $option) {
                            ?>
                                <option value="<?php echo $option['id'] ?>"><?php echo htmlspecialchars($option['nome']) ?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>

                    <div id="campoSeries" class="mb-3" style="display: none;">
                        <label for="numeroSeries" class="form-label">Número de Séries</label>
                        <input type="number" name="series" class="form-control" id="numeroSeries" min="2" max="5" required>
                    </div>

                    <div id="campoRepeticoes" class="mb-3" style="display: none;">
                        <label for="numeroRepeticoes" class="form-label">Número de Repetições</label>
                        <input type="number" name="repeticoes" class="form-control" id="numeroRepeticoes" min="7" max="30" required>
                    </div>

                    <div id="campoDescanso" class="mb-3" style="display: none;">
                        <label for="tempoDescanso" class="form-label">Tempo de Descanso</label>
                        <input type="number" name="descanso" class="form-control" id="tempoDescanso" min="7" max="30" required>
                    </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-success submit">Cadastrar</button>
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
