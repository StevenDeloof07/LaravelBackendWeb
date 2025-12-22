const userName = document.getElementById('name')
const mail = document.getElementById('email')
const password = document.getElementById('password')
const password_confirmation = document.getElementById('password_confirmation')
const formSubmit = document.getElementById('formSubmit')

const feedbackMessage = document.getElementById('feedBackMessage')


userName.addEventListener('blur', () => {
    if (userName.value == "") feedbackMessage.innerHTML = "Vul een naam in"
    else feedbackMessage.innerHTML = "";
    console.log(feedbackMessage)
    checkData()
})

mail.addEventListener('blur', () => {
    if (mail.value == "") feedbackMessage.innerHTML= "Vul een mail in"
    else feedbackMessage.value = "";
    checkData()
})

password.addEventListener('blur', () => {
    checkPasswords()
    checkData()
})
password_confirmation.addEventListener('blur', () => {
    checkPasswords()
    checkData()
})

password_confirmation.addEventListener('blur', () => { checkPasswords; checkData });


const checkPasswords = () => {
    if (password.value.length < 8) {
        feedbackMessage.innerHTML = "Geef een wachtwoord in met meer dan 8 karakters"
        return false;
    }
    else if (password.value != password_confirmation.value ) {
        feedbackMessage.innerHTML = "Wachtwoord bevestiging moet hetzelfde zijn als het wachtwoord"
        return false
    }
    feedbackMessage.innerHTML = ""
    return true;
}

const checkData = () => {
    if (userName.value != "" && mail.value != "" && password.value != "" && password_confirmation != "") {
        if (checkPasswords()) {
            formSubmit.disabled = false
        }
    }
    else formSubmit.disabled = true
}