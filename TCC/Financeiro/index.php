<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="style.css">
  <style>
    .newItem {
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 10px;
    }

    .newItem div {
      flex: 1;
    }

    .newItem .divDesc,
    .newItem .divAmount,
    .newItem .divMonth {
      display: flex;
      flex-direction: column;
    }

    /* Reduzindo o tamanho do campo tipo */
    .newItem .divType,
    .newItem .divMonth {
      display: flex;
      flex-direction: column;
      width: 100px; /* Tamanho reduzido para o campo Tipo e Mês */
    }

    /* Ajustando para que os campos Tipo e Mês fiquem lado a lado */
    .newItem .divType, .newItem .divMonth {
      flex: 0 0 120px; /* Ajusta o tamanho dos dois campos */
    }

    .buttons {
      display: flex;
      gap: 10px;
    }

    /* Ajustando a largura dos campos */
    .newItem div {
      flex: 1;
      min-width: 120px; /* Garantindo um tamanho mínimo para os campos */
    }

    .divType select,
    .divMonth select {
      width: 100%; /* Fazendo o select ocupar toda a largura disponível */
    }
  </style>
</head>
<body>
  <main>
    <div class="resume">
      <div>
        Entradas: R$
        <span class="incomes">0.00</span>
      </div>
      <div>
        Saídas: R$
        <span class="expenses">0.00</span>
      </div>
      <div>
        Total: R$
        <span class="total">0.00</span>
      </div>
    </div>
    <div class="newItem">
      <div class="divDesc">
        <label for="desc">Descrição</label>
        <input type="text" id="desc">
      </div>
      <div class="divAmount">
        <label for="amount">Valor</label>
        <input type="number" id="amount">
      </div>
      <div class="divMonth">
        <label for="month">Mês</label>
        <select id="month">
          <option>Janeiro</option>
          <option>Fevereiro</option>
          <option>Março</option>
          <option>Abril</option>
          <option>Maio</option>
          <option>Junho</option>
          <option>Julho</option>
          <option>Agosto</option>
          <option>Setembro</option>
          <option>Outubro</option>
          <option>Novembro</option>
          <option>Dezembro</option>
        </select>
      </div>
      <div class="divType">
        <label for="type">Tipo</label>
        <select id="type">
          <option>Entrada</option>
          <option>Saída</option>
        </select>
      </div>
      <div class="buttons">
        <button id="btnNew">Incluir</button>
        <button id="btnGeneratePDF">GERAR PDF</button>
      </div>
    </div>
    <div class="divTable">
      <table>
        <thead>
          <tr>
            <th class="columnDescription">Descrição</th>
            <th class="columnAmount">Valor</th>
            <th class="columnMonth">Mês</th> <!-- Coluna para o mês -->
            <th class="columnType">Tipo</th>
            <th class="columnAction"></th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
  </main>  

  <script src="script.js"></script>
</body>
</html>
