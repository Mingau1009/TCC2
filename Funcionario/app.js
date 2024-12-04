// Seletores dos campos do formulário
var form = document.getElementById("myForm"),
    imgInput = document.querySelector(".img"),
    file = document.getElementById("imgInput"),
    fullName = document.getElementById("fullName"),
    birthDate = document.getElementById("birthDate"),
    phone = document.getElementById("phone"),
    address = document.getElementById("address"),
    availableShift = document.getElementById("availableShift"),  
    settings = document.getElementById("settings"), 
    submitBtn = document.querySelector(".submit"),
    userInfo = document.getElementById("data"),
    modalTitle = document.querySelector("#userForm .modal-title"),
    newUserBtn = document.querySelector(".newUser");

let getData = localStorage.getItem('userProfile') ? JSON.parse(localStorage.getItem('userProfile')) : [];
let isEdit = false, editId;

showInfo(); 

newUserBtn.addEventListener('click', () => {
    submitBtn.innerText = 'cadastrar';
    modalTitle.innerText = "cadastrar de Funcionário";
    isEdit = false;
    imgInput.src = "./image/Profile Icon.webp";
    form.reset();
});

function showInfo(dataToShow = getData) {
    userInfo.innerHTML = '';
    dataToShow.forEach((element, index) => {
        let createElement = `<tr class="employeeDetails">
            <td><img src="${element.picture}" alt="" width="50" height="50"></td>
            <td>${element.fullName}</td>
            <td>${formatDate(element.birthDate)}</td>
            <td>${element.phone}</td>
            <td>${element.address}</td>
            <td>${element.availableShift}</td>  <!-- Turno Disponível -->
            <td>${element.settings}</td>  <!-- Ajustes -->
            <td>
                <button class="btn btn-success" onclick="readInfo(${index})" data-bs-toggle="modal" data-bs-target="#readData"><i class="bi bi-eye"></i></button>
                <button class="btn btn-primary" onclick="editInfo(${index})" data-bs-toggle="modal" data-bs-target="#userForm"><i class="bi bi-pencil-square"></i></button>
                <button class="btn btn-danger" onclick="deleteInfo(${index})"><i class="bi bi-trash text-white"></i></button>
            </td>
        </tr>`;
        userInfo.innerHTML += createElement;
    });
}

file.onchange = function () {
    if (file.files[0].size < 1000000) {
        var fileReader = new FileReader();
        fileReader.onload = function (e) {
            imgInput.src = e.target.result;
        }
        fileReader.readAsDataURL(file.files[0]);
    } else {
        alert("Este arquivo é muito grande!");
    }
}

function readInfo(index) {
    const userData = getData[index];

    document.querySelector('.showImg').src = userData.picture;
    document.querySelector('#showFullName').value = userData.fullName;
    document.querySelector("#showBirthDate").value = formatDate(userData.birthDate);
    document.querySelector("#showPhone").value = userData.phone;
    document.querySelector("#showAddress").value = userData.address;
    document.querySelector("#showAvailableShift").value = userData.availableShift; 
    document.querySelector("#showSettings").value = userData.settings; 
}

function editInfo(index) {
    isEdit = true;
    editId = index;
    const userData = getData[index];

    imgInput.src = userData.picture;
    fullName.value = userData.fullName;
    birthDate.value = userData.birthDate;
    phone.value = userData.phone;
    address.value = userData.address;
    availableShift.value = userData.availableShift;  
    settings.value = userData.settings;  

    submitBtn.innerText = "Atualizar";
    modalTitle.innerText = "Atualizar Cadastro";
}

// Função para deletar um registro
function deleteInfo(index) {
    getData.splice(index, 1);
    localStorage.setItem("userProfile", JSON.stringify(getData));
    showInfo();
}

// Função para processar o formulário
form.addEventListener('submit', (e) => {
    e.preventDefault();

    const information = {
        picture: imgInput.src === undefined ? "./image/Profile Icon.webp" : imgInput.src,
        fullName: fullName.value,
        birthDate: birthDate.value,
        phone: phone.value,
        address: address.value,
        availableShift: availableShift.value,  
        settings: settings.value  
    };

    if (!isEdit) {
        getData.push(information);
    } else {
        isEdit = false;
        getData[editId] = information;
    }

    localStorage.setItem('userProfile', JSON.stringify(getData));
    submitBtn.innerText = "cadastrar";
    modalTitle.innerHTML = "Cadastro de Funcionário";

    showInfo();
    form.reset();
    imgInput.src = "./image/Profile Icon.webp";
});

function formatDate(dateString) {
    if (!dateString) return "";
    const dateParts = dateString.split('-');
    return `${dateParts[2]}/${dateParts[1]}/${dateParts[0]}`;
}


function generatePDF() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();
    const checkboxes = document.querySelectorAll('input[name="selectStudent"]:checked');
    let y = 30; // Posição Y inicial

    if (checkboxes.length === 0) {
        alert("Por favor, selecione pelo menos um aluno.");
        return;
    }

    // Função para adicionar a imagem e dados do aluno com retângulos
    const addStudentData = (index) => {
        const userData = getData[index];

        // Adicionando a imagem do aluno em um quadrado 60x60 antes dos campos
        if (userData.picture) {
            const img = new Image();
            img.src = userData.picture;
            img.onload = function() {
                doc.setDrawColor(0);  // Cor da borda
                doc.rect(10, y, 50, 50);  // Desenha quadrado 60x60 para a imagem
                doc.addImage(img, 'JPEG', 10, y, 60, 60); // Posicionar imagem no quadrado
                y += 70; // Espaçamento após a imagem e borda

                // Adicionar os campos após a imagem
                addFields();
            };
        } else {
            // Caso não tenha imagem, apenas adiciona os campos
            addFields();
        }

        // Função interna para adicionar campos com retângulos
        function addFields() {
            doc.setFontSize(11);
            const fields = [
                `Nome: ${userData.employeeName}`,
                `Data de Nascimento: ${formatDate(userData.birthDate)}`,
                `Telefone: ${userData.phone}`,
                `Endereço: ${userData.address}`,
                `Frequência: ${userData.frequency}`,
                `Objetivo: ${userData.objective}`,
                `Data de Início: ${formatDate(userData.startDate)}`
            ];

            fields.forEach(field => {
                doc.setDrawColor(0);
                doc.rect(10, y, 190, 10);  // Desenha retângulo em volta de cada campo
                doc.text(field, 15, y + 7);  // Texto dentro do retângulo
                y += 14 ; // Espaçamento entre os campos
            });

            y += 450; // Espaçamento entre os alunos

            // Adiciona uma nova página se a altura máxima for atingida
            if (y > 270) {
                doc.addPage();
                y = 10;
            }
        }
    };

    // Itera sobre os checkboxes selecionados e adiciona os dados
    checkboxes.forEach((checkbox) => {
        const index = checkbox.value;
        addStudentData(index);
    });

    // Salva o PDF após adicionar todos os alunos
    setTimeout(() => {
        doc.save("matriculas.pdf");
    }, 500); // Atraso para garantir que todas as imagens sejam carregadas
}


function formatDate(dateString) {
    if (!dateString) return "";
    const dateParts = dateString.split('-');
    return `${dateParts[2]}/${dateParts[1]}/${dateParts[0]}`; // formatando como DD/MM/YYYY
}

function calculateAge(birthDate) {
    const birth = new Date(birthDate);
    const today = new Date();
    let age = today.getFullYear() - birth.getFullYear();
    const monthDifference = today.getMonth() - birth.getMonth();
    if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < birth.getDate())) {
        age--;
    }
    return age;
}

// Função para selecionar todos os checkboxes
selectAllCheckbox.addEventListener('change', (event) => {
    const checkboxes = document.querySelectorAll('input[name="selectStudent"]');
    checkboxes.forEach(checkbox => {
        checkbox.checked = event.target.checked;
    });
});

// Adiciona a função para salvar e carregar os dados
showInfo();

// Função para lidar com o evento de mudança do filtro
document.getElementById('filterSelect').addEventListener('change', (event) => {
    const filterType = event.target.value;
    if (filterType) {
        filterStudents(filterType);
    } else {
        showInfo(); // Exibir todos os alunos se nenhum filtro estiver selecionado
    }
});

// Função para filtrar alunos
function filterStudents(type) {
    const rows = document.querySelectorAll('#data tr');
    const students = Array.from(rows).map(row => {
        const matriculaDate = new Date(row.cells[8].innerText.split('/').reverse().join('-')); // Conversão para Date
        return { element: row, matriculaDate: matriculaDate };
    });

    // Ordenar alunos com base no tipo de filtro
    students.sort((a, b) => {
        return type === 'recent' 
            ? b.matriculaDate - a.matriculaDate // Últimos alunos (decrescente)
            : a.matriculaDate - b.matriculaDate; // Primeiros alunos (crescente)
    });

    // Limpar tabela
    const tbody = document.getElementById('data');
    tbody.innerHTML = '';

    // Adicionar alunos ordenados de volta à tabela
    students.forEach(student => {
        tbody.appendChild(student.element);
    });
}
