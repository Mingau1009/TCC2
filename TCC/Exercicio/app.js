document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById("myForm");
    const userName = document.getElementById("exerciseName");
    const exerciseType = document.getElementById("exerciseType");
    const exerciseGroup = document.getElementById("exerciseGroup");
    const submitBtn = document.querySelector(".submit");
    const userInfo = document.getElementById("data");
    const modalTitle = document.querySelector("#userForm .modal-title");
    const newUserBtn = document.querySelector(".newUser");

    let getData = localStorage.getItem('userProfile') ? JSON.parse(localStorage.getItem('userProfile')) : [];
    let isEdit = false, editId;

    showInfo();

    newUserBtn.addEventListener('click', resetForm);
    form.addEventListener('submit', handleSubmit);

    function resetForm() {
        submitBtn.innerText = 'SALVAR';
        modalTitle.innerText = "Cadastro de exercício";
        isEdit = false;
        form.reset();
    }

    function showInfo() {
        userInfo.innerHTML = '';
        getData.forEach((element, index) => {
            const row = document.createElement('tr');
            row.classList.add('employeeDetails');
            row.innerHTML = `
                <td>${element.userName}</td>
                <td>${element.exerciseType}</td>
                <td>${element.exerciseGroup}</td>
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
        exerciseType.value = element.exerciseType;
        exerciseGroup.value = element.exerciseGroup;
        submitBtn.innerText = "SALVAR";
        modalTitle.innerText = "Ajustar cadastro";
    };

    window.deleteInfo = function deleteInfo(index) {
        getData.splice(index, 1);
        localStorage.setItem("userProfile", JSON.stringify(getData));
        showInfo();
    };

    function handleSubmit(e) {
        e.preventDefault();

        const information = {
            userName: userName.value,
            exerciseType: exerciseType.value,
            exerciseGroup: exerciseGroup.value
        };

        if (!isEdit) {
            getData.push(information);
        } else {
            isEdit = false;
            getData[editId] = information;
        }

        localStorage.setItem('userProfile', JSON.stringify(getData));
        submitBtn.innerText = "SALVAR";
        modalTitle.innerHTML = "Cadastro de exercício";
        showInfo();
        resetForm();
    }
});

