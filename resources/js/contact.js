const forms = document.querySelectorAll('form');

for (let form of forms) {
    form.addEventListener('submit', (e) => {
        let anwser = prompt("Geef een antwoord op deze vraag:")

        if (anwser != "") {
            console.log(form.elements)
            form.elements[2].value= anwser;
        }
        else e.preventDefault()
    })
}