<script>
    function setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays*24*60*60*1000));
        var expires = "expires="+ d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    document.addEventListener("DOMContentLoaded", function() {
        var support_case_id;
        var one_provider;
        var supported_modal_content;

        // Image Modal Viewer JS Handler
        $('.image-show-modal').click(function() {
            form_id = $(this).attr('image-data-id');
            $.ajax({
                type: 'GET',
                url: "{{ route('admin.imagesCasesDir') }}",
                data: {
                    form_id: form_id
                },
                success: function(result) {
                    const supported_modal_content = [];
                    if (result.length === 0) {
                        supported_modal_content.push('<div class="flex-shrink-0 w-full mr-8 text-right"><div class="text-sm font-bold underline text-[#F50057]">لا توجد هناك مرفقات لعرضها في هذا النوع من التدخلات</div></div>');
                        $('#inner-image-content').html(supported_modal_content);
                    }

                    $(result).each(function(key, obj) {
                        supported_modal_content.push('<div class="flex flex-wrap"><div class="w-full p-1 min-h-9 md:p-2"><a @click="$dispatch(\'img-modal\', {  imgModalSrc: \'' + obj + '\' })" class="mx-3 cursor-pointer"><img width="150" height="80" alt=' + obj + ' class="object-cover max-w-sm transition-shadow duration-300 ease-in-out border rounded-lg shadow-none h-28 w-44 hover:shadow-xl" src=' + obj + '></a></div></div>');
                        $('#inner-image-content').html(supported_modal_content);
                    });
                }
            });
            $('.image-modal').show();
        });

        // Supporter Modal
        $('.show-supporter-modal').click(function() {
            support_case_id                 = $(this).attr('data-id');
            $.ajax({type: 'GET',url: "{{ route('admin.supporterDetailsDir') }}",data:{id:support_case_id}, success: function(result) {
                $('#name').html(result.name);
                $('#person_name').html(result.person_name);
                $('#phone').html(result.phone);
                $('#email').html(result.email);
                $('#full_address').html(result.full_address);
            }});
            $('.supporter-modal').show();
        });
        $('.close-the-modal').click(function(){
            $('.supporter-modal').hide('fast');
        });
        // Supporter Modal

        // Transfer Modal
        const close_operation_modal = document.querySelector('.close-operation-modal');
        const hang_operation_modal = document.querySelector('.hang-operation-modal');
        $('.tansfer-single-case').click(function() {
            var that = $(this);
                $.ajax({
                    url: "{{ route('admin.directorIntsExecuted') }}",
                    data: {
                        form_id: [that.attr('data-form-id')],
                        status_id: [that.attr('data-form-status_id')],
                        to_role: that.prev().val()
                    },
                    success: function(result, xhr) {
                        location.reload();
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.responseJSON.error, thrownError);
                    }
                });
        });

        const closehanggedModal = document.querySelector('.close-hang-operation-modal');
        if (closehanggedModal) {
            closehanggedModal.addEventListener('click', function() {
                hang_operation_modal.classList.add('hidden')
            })
        }

        const closeOperationModal = document.querySelector('.close-close-operation-modal');
        if (closeOperationModal) {
            closeOperationModal.addEventListener('click', function() {
                close_operation_modal.classList.add('hidden')
            })
        }
        // Transfer Modal

        // Start update a user details
        var that
        const edit_user_modal = document.querySelector('.edit-user-modal');
        $('.edit-user').click(function() {
            that = $(this)
            $.ajax({
                url: "{{ route('admin.editUserDir') }}",
                data: {
                    id: that.data('id')
                },
                success: function(result) {
                    console.log(result)
                    console.log(result.id)
                    console.log('result.id')
                    $('#id').val(result.id)
                    $('#name').val(result.name)
                    $('#phone').val(result.phone)
                    $('#email').val(result.email)
                    $('#department').val(result.department)

                    if(result.int_housing == 0) {
                        document.getElementById("ints_housing").checked = true;
                    }  else {
                        document.getElementById("ints_housing").checked = false;
                    }

                    if(result.int_direct == 0) {
                        document.getElementById("ints_direct").checked = true;
                    }  else {
                        document.getElementById("ints_direct").checked = false;
                    }

                    if(result.int_health == 0) {
                        document.getElementById("ints_health").checked = true;
                    }  else {
                        document.getElementById("ints_health").checked = false;
                    }

                    if(result.int_job == 0) {
                        document.getElementById("ints_job").checked = true;
                    }  else {
                        document.getElementById("ints_job").checked = false;
                    }

                    if(result.int_logistic == 0) {
                        document.getElementById("ints_logistic").checked = true;
                    }  else {
                        document.getElementById("ints_logistic").checked = false;
                    }

                    edit_user_modal.classList.remove('hidden');
                }
            })
        })

        const closeEditUserModal = document.querySelector('.close-edit-user-modal');
        if (closeEditUserModal) {
            closeEditUserModal.addEventListener('click', function() {
                edit_user_modal.classList.add('hidden')
            })
        }
        // End update a user details

        // Start change user password
        // var that
        const change_password_modal = document.querySelector('.change-password-modal');
        $('.change-password').click(function() {
            ids = $(this)
            $.ajax({
                url: "{{ route('admin.changePasswordDir') }}",
                data: {
                    id: ids.data('id')
                },
                success: function(result) {
                    $('#ids').val(result.id)
                    change_password_modal.classList.remove('hidden');
                }
            })
        })

        const closeChangePasswordModal = document.querySelector('.close-change-password-modal');
        if (closeChangePasswordModal) {
            closeChangePasswordModal.addEventListener('click', function() {
                change_password_modal.classList.add('hidden')
            })
        }
        // End change user password
    });
</script>
