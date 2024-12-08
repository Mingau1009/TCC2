const tbody = document.querySelector("tbody");
const descItem = document.querySelector("#desc");
const amount = document.querySelector("#amount");
const type = document.querySelector("#type");
const month = document.querySelector("#month");  // Referência ao campo de mês
const btnNew = document.querySelector("#btnNew");

const incomes = document.querySelector(".incomes");
const expenses = document.querySelector(".expenses");
const total = document.querySelector(".total");

let items = getItensBD();  // Inicializando items com os dados do localStorage

btnNew.onclick = () => {
  // Verificando se todos os campos foram preenchidos
  if (descItem.value === "" || amount.value === "" || type.value === "" || month.value === "") {
    return alert("Preencha todos os campos!");
  }

  // Adicionando o novo item
  items.push({
    desc: descItem.value,
    amount: parseFloat(amount.value).toFixed(2),  // Garantindo que o valor seja numérico e com 2 casas decimais
    type: type.value,
    month: month.value,  // Incluindo o mês
  });

  setItensBD();  // Atualizando o localStorage
  loadItens();   // Recarregando os itens na tabela

  // Limpando os campos após adicionar
  descItem.value = "";
  amount.value = "";
  type.value = "Entrada";  // Definindo o tipo de item como "Entrada" após adicionar
  month.value = "Janeiro";  // Definindo o mês padrão após adicionar
};

function deleteItem(index) {
  items.splice(index, 1); // Removendo o item
  setItensBD();            // Atualizando o localStorage
  loadItens();             // Recarregando os itens na tabela
}

function insertItem(item, index) {
  let tr = document.createElement("tr");

  tr.innerHTML = `
    <td>${item.desc}</td>
    <td>R$ ${item.amount}</td>
    <td class="columnMonth">${item.month}</td>  <!-- Exibindo o mês -->
    <td class="columnType">${
      item.type === "Entrada"
        ? '<i class="bx bxs-chevron-up-circle"></i>'  // Ícone de entrada
        : '<i class="bx bxs-chevron-down-circle"></i>' // Ícone de saída
    }</td>
    <td class="columnAction">
      <button onclick="deleteItem(${index})"><i class='bx bx-trash'></i></button>  <!-- Lixeira no final -->
    </td>
  `;

  tbody.appendChild(tr);  // Adicionando a linha na tabela
}

function loadItens() {
  tbody.innerHTML = ""; // Limpando o conteúdo da tabela

  // Verifica se existe algum item no storage e renderiza
  items.forEach((item, index) => {
    insertItem(item, index);  // Inserindo cada item na tabela
  });

  getTotals();  // Atualizando totais após carregar os itens
}

function getTotals() {
  const amountIncomes = items
    .filter((item) => item.type === "Entrada")
    .map((transaction) => Number(transaction.amount));

  const amountExpenses = items
    .filter((item) => item.type === "Saída")
    .map((transaction) => Number(transaction.amount));

  const totalIncomes = amountIncomes
    .reduce((acc, cur) => acc + cur, 0)
    .toFixed(2);

  const totalExpenses = Math.abs(
    amountExpenses.reduce((acc, cur) => acc + cur, 0)
  ).toFixed(2);

  const totalItems = (totalIncomes - totalExpenses).toFixed(2);

  incomes.innerHTML = totalIncomes;
  expenses.innerHTML = totalExpenses;
  total.innerHTML = totalItems;
}

// Função para obter os itens do localStorage
const getItensBD = () => {
  // Se o localStorage estiver vazio, retorna um array vazio, senão retorna o conteúdo
  return JSON.parse(localStorage.getItem("db_items")) ?? [];
};

// Função para salvar os itens no localStorage
const setItensBD = () =>
  localStorage.setItem("db_items", JSON.stringify(items));

// Carregando os itens quando a página for carregada
loadItens();  
