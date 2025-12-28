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