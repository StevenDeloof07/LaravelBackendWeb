const changeButtons = document.getElementsByClassName('changeQuestion');
console.log('e')

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
    const accepted = confirm("Ben je er zeker van dat je deze cattegorie wil verwijderen? Alle gelinkte gebruikers zullen mee verwijdert worden");

    if (!accepted) event.preventDefault();
})