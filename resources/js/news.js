console.log('e')
    const inputs = document.querySelectorAll('input');
    const submit = document.getElementById('submit');

    console.log('e');
    for (let input of inputs) {
        input.addEventListener('blur', () => {
            let allFilled = true;
            for (let input of inputs) {
                if (input.value == "" || input.value == null) { 
                    allFilled = false
                    console.log(input.value)
                }
            }
            submit.disabled = !allFilled;
        })
    }
