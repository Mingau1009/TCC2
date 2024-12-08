<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMF77I0n4h/jV+YjDgbU6euj4AkTW8nKmJmMy" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/af6fbadd15.js" crossorigin="anonymous"></script>
    <title>Área de cadastro de exercício</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include("../Classe/Conexao.php") ?>
<section class="p-3">
    <!-- Linha para o botão de Adicionar Exercício -->
    <div class="row mb-3">
        <div class="col-12">
            <button class="btn btn-success newUser" data-bs-toggle="modal" data-bs-target="#userForm">
                <i style='font-size:20px' class='fas'>&#xf44b;</i> Adicionar Exercício 
            </button>
        </div>
    </div>
    
    <!-- Linha para a barra de busca, agora abaixo do botão -->
    <div class="row mb-3">
        <div class="col-12 text-start">
            <div class="input-group short-input">
                <span class="input-group-text" id="basic-addon1">
                    <i class="bi bi-search"></i> <!-- Ícone de lupa -->
                </span>
                <input type="text" class="form-control search-input" placeholder="Buscar por exercício..." aria-label="Buscar por exercício..." aria-describedby="basic-addon1">
            </div>
        </div>
    </div>
</section>

<br>

<style>
    .short-input {
        width: 800px !important;  /* Ajusta a largura da barra de busca */
        max-width: 100%;  /* Garante que não ultrapasse o limite da tela */
    }

    .input-group {
        max-width: 545px;  /* Limita a largura máxima do input-group */
    }

    .search-input {
        max-width: 545px;  /* Garante que o campo de busca ocupe toda a largura disponível */
    }
</style>


        <div class="row">
            <div class="col-12">
                <table class="table table-striped table-hover mt-3 text-center table-bordered">
                    <thead>
                        <tr>
                            <th>Nome do exercício</th>
                            <th>Tipo</th>
                            <th>Grupo</th>
                            <th>Configurações</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $exercicios = Db::conexao()->query("SELECT * FROM `exercicio`")->fetchAll(PDO::FETCH_OBJ); ?>
                    <?php foreach ($exercicios as $exercicio) { ?>
                        <tr>
                            <td><?php echo $exercicio->nome; ?></td>
                            <td><?php echo $exercicio->tipo_exercicio; ?></td>
                            <td><?php echo $exercicio->grupo_muscular; ?></td>
                            
                        </tr>
                    <?php } ?>
                </tbody>
                </table>
            </div>
        </div>
    </section>

    <div class="modal fade" id="userForm">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Cadastro de exercício</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form method="POST" action="cadastrar.php">
                    <div class="modal-body">
                        <div class="inputField">
                            <div class="mb-3">
                                <label for="exerciseName" class="form-label">Nome do exercício:</label>
                                <input type="text" id="exerciseName" name="nome" class="form-control small-input" required>
                            </div>
                            <div class="mb-3">
                                <label for="exerciseType" class="form-label">Escolha o tipo de treino:</label>
                                <select  name="exercicio" id="exerciseType" class="form-select small-select" required>
                                    <option value="" disabled selected>Selecione o tipo de treino</option>
                                    <option value="musculacao">Musculação</option>
                                    <option value="cardio">Cardio</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exerciseGroup"  class="form-label">Grupo:</label>
                                <select name="grupo" id="exerciseGroup" class="form-select small-select" required>
                                    <option value="" disabled selected>Selecione o tipo de treino</option>
                                    <option value="abdômen">Abdômen</option>
                                    <option value="cardio">Cardio</option>
                                    <option value="dorsal">Dorsal</option>
                                    <option value="membros interiores">Membros Interiores</option>
                                    <option value="membros superiores">Membros Superiores</option>
                                    <option value="biceps">Biceps</option>
                                    <option value="tríceps">Tríceps</option>
                                    <option value="peitoral">Peitoral</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">FECHAR</button>
                    <button type="submit" class="btn btn-success submit">SALVAR</button>
                </div>
                </form>
               
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="app.js"></script>
</body>
</html>
