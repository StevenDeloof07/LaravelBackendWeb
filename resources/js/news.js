const addInputs = document.querySelectorAll('.add-input');
const addSubmit = document.getElementById('submit');

const changeInputs = document.querySelectorAll('.change-input')
const changeSubmit = document.getElementById('submitChange');

const changeNewsItems = document.getElementsByClassName('changeBtn')

const addForm = document.getElementById("addItem")
const changeForm = document.getElementById('changeItem')

const checkInputs = (inputs, submit) => {
    for (let input of inputs) {
    input.addEventListener('blur', () => {
            let allFilled = true;
            for (let input of inputs) {
                if (input.value == "" || input.value == null) { 
                    allFilled = false
                }
                console.log(allFilled)
            }
            submit.disabled = !allFilled;
    })
}
}


checkInputs(addInputs, addSubmit);
checkInputs(changeInputs, changeSubmit);

document.getElementById('cancelChange').addEventListener('click', () => {
    addForm.style.display = "block"
    changeForm.style.display = "none"
})

//Change the form to the change form
for (let button of changeNewsItems) {
    button.addEventListener("click", () => {
        let id = button.id
        
        let newsAttributes = document.getElementsByClassName(id)

        document.getElementById("user_id").value = id;

        document.getElementById('changeTitle').value = newsAttributes[0].innerHTML
        document.getElementById('changeContent').value = newsAttributes[2].innerHTML

        console.log(newsAttributes)

        addForm.style.display = "none"
        changeForm.style.display = "block"
    })
}
