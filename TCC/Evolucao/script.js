const beforeInput = document.getElementById('beforeInput');
const afterInput = document.getElementById('afterInput');
const beforeImg = document.getElementById('beforeImg');
const afterImg = document.getElementById('afterImg');
const uploadBtn = document.getElementById('uploadBtn');

uploadBtn.addEventListener('click', () => {
    const beforeFile = beforeInput.files[0];
    const afterFile = afterInput.files[0];
    const beforeReader = new FileReader();
    const afterReader = new FileReader();

    if (beforeFile) {
        beforeReader.onload = () => {
            beforeImg.src = beforeReader.result; 
        }
        beforeReader.readAsDataURL(beforeFile);
    }

    if (afterFile) {
        afterReader.onload = () => {
            afterImg.src = afterReader.result; 
        }
        afterReader.readAsDataURL(afterFile);
    }
    
});

