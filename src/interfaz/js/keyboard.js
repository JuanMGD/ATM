input = document.getElementById('input') || null;
form = document.getElementById('form') || null;

function addNumbers(number) {
    if(input && (input.value.length < 4 || input.classList.contains('money'))) 
        input.value += number
}

function deleteNumber() {
    if(input) 
        input.value = input.value.slice(0, -1)
}

function sumbit() { 
    if(form) 
        form.sumbit()
}