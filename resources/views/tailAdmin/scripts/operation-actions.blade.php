<script>
    function setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays*24*60*60*1000));
        var expires = "expires="+ d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    document.addEventListener("DOMContentLoaded", function() {
        var support_case_id;
        var supported_modal_content;
        
        $('.show-supporter-modal').click(function() {
            support_case_id                 = $(this).attr('data-id');
            $.ajax({type: 'GET',url: "{{ route('admin.supporterDetails') }}",data:{id:support_case_id}, success: function(result) {
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

        // Image Modal Viewer JS Handler
        $('.image-show-modal').click(function() {
            form_id = $(this).attr('image-data-id');
            $.ajax({
                type: 'GET',
                url: "{{ route('admin.imagesCases') }}",
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

        // Transfer Modal
        const close_operation_modal = document.querySelector('.close-operation-modal');
        const hang_operation_modal = document.querySelector('.hang-operation-modal');
        $('.operation-single-case').click(function() {
            var that = $(this);
            if (that.prev().val() == 8) {
                $.ajax({
                    url: "{{ route('admin.operationIntsExecuted') }}",
                    data: {
                        form_id: [that.attr('data-form-id')],
                        to_role: that.prev().val()
                    },
                    success: function(result, xhr) {
                        location.reload();
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.responseJSON.error, thrownError);
                    }
                });
            } else if (that.prev().val() == 9) {
                form_id = [that.attr('data-form-id')];
                to_role = that.prev().val();
                $('#modal-action-form-id').val(form_id);
                $('#modal-action-to-role').val(to_role);
                close_operation_modal.classList.remove('hidden');
            } else if (that.prev().val() == 10) {
                form_id = [that.attr('data-form-id')];
                to_role = that.prev().val();
                $('#hang-modal-action-form-id').val(form_id);
                $('#hang-modal-action-to-role').val(to_role);
                hang_operation_modal.classList.remove('hidden');
            }
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

        // Reason Modal
        var reason_case_id;
        var reason_modal_content;
        $('.show-reason-modal').click(function() {
            reason_case_id    = $(this).attr('reason-data-id');
            $.ajax({type: 'GET',url: "{{ route('admin.operationHangreasonDetails') }}",data:{id:reason_case_id}, success: function(result) {
                $('#reason').html(result.reason);
                $('#notes').html(result.notes);
                $('#created_at').html(result.created_at);
            }});
            /*$.ajax({
                success: function(result) {                    
                    reason_modal_content  = '<table class="min-w-full divide-y divide-gray-200 text-center bg-gray-50"><tr><td>{{ trans('development_interventions.reason') }}</td><td>'+result.reason+'</td></tr><tr><td>الملاحظات</td><td>'+result.notes+'</td></tr><tr><td>{{ trans('development_interventions.created_at') }}</td><td>'+result.created_at+'</td></tr></table>';
                    $('#inner-reason-content').html(reason_modal_content);
            }});*/
            $('.hangged-modal').show();
        });
        $('.close-the-reason-modal').click(function(){
            $('.hangged-modal').hide('fast');
        });
        // Reason Modal
        
    });
</script>
