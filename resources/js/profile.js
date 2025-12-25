const changeUserForm = document.getElementById('changeUserForm');
const changeProfileBtn = document.getElementById('changeProfile')
const inputs = document.querySelectorAll('input')
const submitForm = document.getElementById('submitForm')
const feedbackMessage = document.getElementById('feedbackMessage')

changeProfileBtn.addEventListener('click', () => {
    changeUserForm.style.display = 'block'
    changeProfileBtn.style.display = 'none'
})

const checkInputs = () => {
    let allFilled = true 
    for (let input of inputs) {
        if (input.value == "") allFilled = false
    } 
    if (allFilled) {
        feedbackMessage.style.display = "none"
        submitForm.disabled = false
    }
    else { 
        feedbackMessage.style.display = 'block'
        submitForm.disabled = true
    }
}


for (let input of inputs) {
    input.addEventListener('blur', checkInputs)
}