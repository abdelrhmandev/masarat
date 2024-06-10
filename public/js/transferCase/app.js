document.addEventListener('DOMContentLoaded', function () {
    const pushAbove = document.getElementById('push-above')
    const pushPage = document.getElementById('push-page')
    const custom = document.getElementById('custom')
    const checkboxes = document.querySelectorAll('input[type="checkbox"]')

    pushAbove.addEventListener('click', function () {
        custom.classList.add('hidden')
        custom.classList.remove('required')

        for (let i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = ''
        }
    })

    pushPage.addEventListener('click', function () {
        custom.classList.add('hidden')
        custom.classList.remove('required')

        for (let i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = 'checked'
        }
    })
})
