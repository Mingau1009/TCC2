$(document).ready(function() {
    const form = document.getElementById("myForm");
    const userName = document.getElementById("nomeExercicio"); // Nome do Exercício
    const exerciseCategory = document.getElementById("categoriaExercicio"); // Categoria do Exercício
    const exerciseSeries = document.getElementById("numeroSeries"); // Número de Séries
    const exerciseReps = document.getElementById("numeroRepeticoes"); // Número de Repetições
    const submitBtn = document.querySelector(".submit");
    const userInfo = document.getElementById("data");
    const modalTitle = document.querySelector("#userForm .modal-title");
    const newUserBtn = document.querySelector(".newUser");


    let getData = localStorage.getItem('exerciseData') ? JSON.parse(localStorage.getItem('exerciseData')) : [];
    let isEdit = false;
    let editId = false;

    // showInfo();

    // newUserBtn.addEventListener('click', resetForm);
    // form.addEventListener('submit', handleSubmit);

    function resetForm() {
        submitBtn.innerText = 'Salvar';
        modalTitle.innerText = "Cadastrar Novo Exercício";
        isEdit = false;
        form.reset();
    }

    function mostrarCampos() {
        var exercicioSelecionado = document.getElementById("nomeExercicio").value;
        var campoSeries = document.getElementById("campoSeries");
        var campoRepeticoes = document.getElementById("campoRepeticoes");
        var campoDescanso = document.getElementById("campoDescanso");
    
        // Verifique se um exercício foi selecionado
        if (exercicioSelecionado !== "") {
            // Mostrar os campos
            campoSeries.style.display = "block";
            campoRepeticoes.style.display = "block";
            campoDescanso.style.display = "block";
        } else {
            // Esconder os campos se nada for selecionado
            campoSeries.style.display = "none";
            campoRepeticoes.style.display = "none";
            campoDescanso.style.display = "none";
        }
    }
    

    function showInfo() {
        userInfo.innerHTML = '';
        getData.forEach((element, index) => {
            const row = document.createElement('tr');
            row.classList.add('exerciseDetails');
            row.innerHTML = `
                <td>${element.userName}</td>
                <td>${element.exerciseCategory}</td>
                <td>${element.exerciseSeries}</td>
                <td>${element.exerciseReps}</td>
                <td>
                    <button class="btn btn-primary" onclick="editInfo(${index})" data-bs-toggle="modal" data-bs-target="#userForm"><i class="bi bi-pencil-square"></i></button>
                    <button class="btn btn-danger" onclick="deleteInfo(${index})"><i class="bi bi-trash"></i></button>
                </td>
            `;
            userInfo.appendChild(row);
        });
    }

    window.editInfo = function editInfo(index) {
        const element = getData[index];
        isEdit = true;
        editId = index;
        userName.value = element.userName;
        exerciseCategory.value = element.exerciseCategory;
        exerciseSeries.value = element.exerciseSeries;
        exerciseReps.value = element.exerciseReps;
        submitBtn.innerText = "Atualizar";
        modalTitle.innerText = "Ajustar Cadastro de Exercício";
    };

    window.deleteInfo = function deleteInfo(index) {
        getData.splice(index, 1);
        localStorage.setItem("exerciseData", JSON.stringify(getData));
        showInfo();
    };

    function handleSubmit(e) {
        e.preventDefault();

        const information = {
            userName: userName.value,
            exerciseCategory: exerciseCategory.value,
            exerciseSeries: exerciseSeries.value,
            exerciseReps: exerciseReps.value
        };

        if (!isEdit) {
            getData.push(information);
        } else {
            isEdit = false;
            getData[editId] = information;
        }

        localStorage.setItem('exerciseData', JSON.stringify(getData));
        submitBtn.innerText = "Salvar";
        modalTitle.innerHTML = "Cadastrar Novo Exercício";
        showInfo();
        resetForm();
    }
    $("#nomeExercicio").on("change", function(){
        mostrarCampos();
    });
    
});

