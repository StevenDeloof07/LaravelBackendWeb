const changeButtons = document.getElementsByClassName('changeQuestion');


document.getElementById('add_category_form').addEventListener('submit', (e) => {
    if (document.getElementById('add_category_name').value == '') {
        e.preventDefault()
        document.getElementById('add_category_error').innerHTML = "geef de nieuwe categorie een naam."
    }
})


document.getElementById('change_category_form').addEventListener('submit', e => {
    if (document.getElementById('change_category_name').value == '') {
        e.preventDefault()
        document.getElementById('change_category_error').innerHTML = "geef een naam mee"
    }
})

document.getElementById('add_question_form').addEventListener('submit', e => {
    if (document.getElementById('add_question').value == '' || document.getElementById('add_anwser').value == '') {
        e.preventDefault()
        document.getElementById('add_question_error').innerHTML = "Geef alle waarden mee"
    }
})

document.getElementById('changeQuestion').addEventListener('submit', e => {
    if (document.getElementById('changeQuestionValue').value == '' || document.getElementById('changeAnwserValue').value == '') {
        e.preventDefault()
        document.getElementById('change_question_error').innerHTML = "Geef alle waarden mee"
    }
})

for (let button of changeButtons) {
    button.addEventListener('click', () => {
        document.getElementById('changeQuestion').style.display = 'block'

        const categoryId = button.classList[1].substring(8)

        const id = button.id;

        document.getElementById('changeQuestionId').value = id;

        const elements = document.getElementsByClassName(id);
        document.getElementById('changeQuestionValue').value = elements[0].innerHTML
        document.getElementById('changeAnwserValue').value = elements[1].innerHTML

        document.getElementById('change_category').value = categoryId;
    })
}
//Add an event listener to double check deletion
//code taken from https://www.delftstack.com/howto/javascript/prevent-form-submit-javascript/
//prompt code taken from https://www.w3schools.com/jsref/met_win_confirm.asp
document.getElementById('deleteCategory').addEventListener('submit', (event) => {
    const accepted = confirm("Ben je er zeker van dat je deze categorie wil verwijderen? Alle gelinkte gebruikers zullen mee verwijdert worden");

    if (!accepted) event.preventDefault();
})

for (let remove_question_form of document.getElementsByClassName('removeQuestion')) {
    remove_question_form.addEventListener('submit', e => {
        const accepted = confirm("Ben je er zeker van dat je deze vraag wil verwijderen?");

    if (!accepted) e.preventDefault();
    })
}