input = document.getElementById('input') || null;
inputBox = document.getElementById('input-box') || null;
form = document.getElementById('form') || null;
errMsg = document.getElementById('err-msg') || null;

function addPinNumber(number) {
    if(input && input.value.length < 4) {
        errMsg.classList.remove('error');
        input.value += number;
        inputBox.innerHTML = '*' + inputBox.textContent.slice(0, -1);
    }
}

function deletePinNumber() {
    if(input) {
        errMsg.classList.remove('error');
        input.value = input.value.slice(0, -1);
        inputBox.textContent = inputBox.textContent.substring(1) + '.';
    }
}

function addNumber(number) {
    if(input) {
        if(number === '.' && inputBox.textContent.includes('.') ) return; 
        
        errMsg.classList.remove('error');
        input.value += number;
        inputBox.textContent += number;
    }
}

function deleteNumber() {
    if(input) {
        errMsg.classList.remove('error');
        input.value = input.value.slice(0, -1);
        inputBox.textContent = inputBox.textContent.slice(0, -1);
    }
}

function accept() {
    if(form)
        form.submit()
}