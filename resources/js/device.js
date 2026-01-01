const device_name = document.getElementById('name')
const release_date = document.getElementById('release_date')
const description = document.getElementById('description')
const picture = document.getElementById('picture')

const form = document.getElementById('addDevice')
const error_message = document.getElementById('add-error')




form.addEventListener('submit', (e) => {
    if (device_name.value == '' || release_date.value == '' || description.value == '' || picture.value == '') {
        e.preventDefault()
        error_message.innerHTML = "Vul alle waarden in"
    }
})