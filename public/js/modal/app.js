function validatefilesize(file) { 
    var file_size = $('#'+file)[0].files[0].size;
    if(file_size > 5097152) {                        
        $('.validation-file-size-modal').show();
        $('#close-validation-size-modal').click(function () { 
            $('.validation-file-size-modal').hide();
            $(':input[type="submit"]').prop('disabled', true);
            $(':input[type="submit"]').addClass("cursor-not-allowed");        
        });
    } else {
        $(':input[type="submit"]').prop('disabled', false);
        $(':input[type="submit"]').removeClass("cursor-not-allowed");    
        return true;      
    }
}

document.addEventListener('DOMContentLoaded', function () {
    // Generic Modal JS Handler
    let modalDataId
    const show_modal = document.querySelector('.show-the-modal')
    const close_modal = document.querySelector('.close-the-modal')

    if (show_modal) {
        $('.show-the-modal').click(function () {
            modalDataId = $(this).attr('data-id')
            console.log(modalDataId)
            $('.show-' + modalDataId + '-general').show()
            $('.general-' + modalDataId + '-modal').show()
        })
    }

    if (close_modal) {
        $('.close-the-modal').click(function () {
            modalDataId = $(this).attr('close-data-id')
            $('.show-' + modalDataId + '-general').hide()
            $('.general-' + modalDataId + '-modal').hide()
        })
    }
    // End Generic Modal JS Handler

    // Provider Modal JS Handler
    const closeProviderModal = document.querySelectorAll(
        '.close-Provider-modal'
    )
    const showProvider = document.querySelector('.show-provider-modal')
    const provider_modal = document.querySelector('.provider-modal')
    if (showProvider) {
        showProvider.addEventListener('click', function () {
            provider_modal.classList.remove('hidden')
        })
    }

    closeProviderModal.forEach((close) => {
        close.addEventListener('click', function () {
            if (provider_modal) {
                provider_modal.classList.add('hidden')
            }
        })
    })
    // End Provider Modal JS Handler

    // Reactive Modal JS Handler
    let that
    let personal_id
    const showReactiveModal = document.querySelector('.show-reactive-modal')
    const reactive_modal = document.getElementsByClassName('reactive-modal')
    const closeReactiveModal = document.querySelectorAll(
        '.close-reactive-modal'
    )
    if (showReactiveModal) {
        $('.show-reactive-modal').click(function () {
            that = $(this)
            personal_id = that.attr('personal-id-data')
            $('#personal-id-data').val(personal_id)
            reactive_modal[0].classList.remove('hidden')
        })
    }

    closeReactiveModal.forEach((close) => {
        close.addEventListener('click', function () {
            reactive_modal[0].classList.add('hidden')
        })
    })
    // End Reactive Modal JS Handler

    // User Modal JS Handler
    const closeUserModal = document.querySelectorAll('.close-user-modal')
    const showUser = document.querySelector('.show-user-modal')
    const user_modal = document.querySelector('.user-modal')
    if (showUser) {
        showUser.addEventListener('click', function () {
            user_modal.classList.remove('hidden')
        })
    }

    closeUserModal.forEach((close) => {
        close.addEventListener('click', function () {
            if (user_modal) {
                user_modal.classList.add('hidden')
            }
        })
    })
    // End User Modal JS Handler
})

/////////////////////////
    // CompletedInts Modal JS Handler
    const closeCompletedIntsModal = document.querySelectorAll(
        '.close-CompletedInts-modal'
    )
    const showCompletedInts = document.querySelector('.show-CompletedInts-modal')
    const CompletedInts_modal = document.querySelector('.CompletedInts-modal') 
    CompletedInts_modal.classList.remove('hidden');    
    closeCompletedIntsModal.forEach((close) => {
        close.addEventListener('click', function () {
            if (CompletedInts_modal) {
                CompletedInts_modal.classList.add('hidden')
            }
        })
    })