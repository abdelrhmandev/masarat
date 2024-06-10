window.onload = function () {
    const notification = document.getElementById('notification')
    if (notification) {
        setTimeout(popNotification, 3000)
        function popNotification() {
            document.getElementById('notification').classList.add('hidden')
        }
    }
}

function validationFillForm() {
    let personal_id = $('#personal_id').val()
    let confirmation_code = $('#confirmation_code').val()
    if (personal_id && confirmation_code) {
        let url = '/fill/' + personal_id + '/' + confirmation_code
        location.href = url
    }
}
