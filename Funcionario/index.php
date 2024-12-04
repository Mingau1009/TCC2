<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <title>Cadastro de funcionário</title>
    
    <style>
        .btn-custom {
            background-color: #3f8f31; /* Cor verde para os filtros */
            color: white; /* Cor do texto */
            border: none; /* Remove a borda padrão */
            padding: 10px 15px; /* Ajusta o padding */
            border-radius: 5px; /* Arredonda os cantos */
            cursor: pointer; /* Muda o cursor ao passar o mouse */
        }

        .btn-custom:hover,
        .btn-custom:active,
        .btn-custom:focus {
            background-color: #3f8f31; /* Mantém a mesma cor verde no hover */
            outline: none; /* Remove o contorno padrão ao clicar */
        }

        .pdf-button {
            background-color: #dc3545; /* Cor vermelha para o botão de gerar PDF */
            color: white; /* Cor do texto */
            border: none; /* Remove a borda padrão */
            padding: 10px 15px; /* Ajusta o padding */
            border-radius: 5px; /* Arredonda os cantos */
            cursor: pointer; /* Muda o cursor ao passar o mouse */
            margin-left: 10px; /* Margem esquerda para espaçamento */
        }

        .pdf-button:hover,
        .pdf-button:active,
        .pdf-button:focus {
            background-color: #dc3545; /* Tom mais escuro de vermelho para hover */
            outline: none; /* Remove o contorno padrão ao clicar */
        }

        /* Estilo para o fundo das opções do filtro */
        .filtro-opcoes {
            background-color: white; /* Define o fundo como branco */
            border-radius: 10px; /* Arredonda os cantos, se desejado */
            padding: 15px; /* Adiciona espaçamento interno */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2); /* Adiciona sombra para destaque */
        }
    </style>
</head>
<body>
<?php include("../Classe/Conexao.php") ?>
<section class="p-3">
<!-- Linha para os botões -->
<div class="row mb-3">
    <div class="col-6 text-start">
        <button class="btn btn-success newUser" data-bs-toggle="modal" data-bs-target="#userForm">
            Cadastrar funcionário <i class="bi bi-person-arms-up"></i>
        </button>
    </div>
    <div class="col-6 text-end">
        <button class="btn btn-secondary btn-custom pdf-button" onclick="generatePDF()" style="margin-right: 5px;">
            <i class="bi bi-file-earmark-pdf"></i> Gerar PDF
        </button>
    </div>
</div>


    <!-- Linha para a barra de busca -->
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
                        <th>Nome Completo</th>
                        <th>Data de Nascimento</th>
                        <th>Telefone</th>
                        <th>Endereço</th>
                        <th>Turno Disponível</th>
                        <th>Ajustes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $funcionarios = Db::conexao()->query("SELECT * FROM `funcionario`")->fetchAll(PDO::FETCH_OBJ); ?>
                    <?php foreach ($funcionarios as $funcionario) { ?>
                        <tr>
                            <td><?php echo $funcionario->nome; ?></td>
                            <td>
                                <?php if($funcionario->data_nascimento) { ?>
                                    <?php echo date('d/m/Y', strtotime($funcionario->data_nascimento)); ?>
                                <?php } else { ?>
                                    --
                                <?php } ?>
                            </td>
                            <td><?php echo $funcionario->telefone; ?></td>
                            <td><?php echo $funcionario->endereco; ?></td>
                            <td><?php echo $funcionario->turno_disponivel; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- Modal de Cadastro -->

    <div class="modal fade" id="userForm">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ficha de Cadastro de Funcionário</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <div class="inputField">
                        <div>
                            <label for="name">Nome Completo:</label>
                            <input type="text" name="name" id="name" required>
                        </div>
                        <div>
                            <label for="sdate">Data de Nascimento:</label>
                            <input type="date" name="sdate" id="sdate" required>
                        </div>
                        <div>
                            <label for="telefone">Telefone:</label>
                            <input type="text" name="telefone" id="telefone" required>
                        </div>
                        <div>
                            <label for="address">Endereço:</label>
                            <input type="text" name="address" id="address" required>
                        </div>
                        <div>
                            <label for="frequency">Turno Disponível:</label>
                            <input type="text" name="frequency" id="frequency" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit"  class="btn btn-success submit">cadastrar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Modal de Visualização -->
<div class="modal fade" id="readData">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Cadastro do Funcionário</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <form action="#" id="profileForm">
                    <div class="card imgholder">
                        <img src="./image/Profile Icon.webp" alt="" width="200" height="200" class="showImg">
                    </div>
                    <div class="inputField">
                        <div>
                            <label for="showName">Nome Completo:</label>
                            <input type="text" name="" id="showName" disabled>
                        </div>
                        <div>
                            <label for="showDate">Data de Nascimento:</label>
                            <input type="text" name="" id="showDate" disabled>
                        </div>
                        <div>
                            <label for="showPhone">Telefone:</label>
                            <input type="text" name="" id="showPhone" disabled>
                        </div>
                        <div>
                            <label for="showAddress">Endereço:</label>
                            <input type="text" name="" id="showAddress" disabled>
                        </div>
                        <div>
                            <label for="showShiftAvailable">Turno Disponível:</label>
                            <input type="text" name="" id="showShiftAvailable" disabled>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="app.js"></script>
</body>
</html>
