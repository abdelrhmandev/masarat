<script>
    document.addEventListener("DOMContentLoaded", function() {
        var that;
        var form_id;
        const approval_partners_modal = document.querySelector('.approval-partners-modal');
        $('.submit-single-action').click(function() {
            that = $(this);
            if (that.prev().val() == 6) {
                form_id = that.attr('data-id');
                $('#modal-action-form-id').val(form_id);
                approval_partners_modal.classList.remove('hidden');
            } else if (that.prev().val() == 4 || that.prev().val() == 5) {
                $.ajax({
                    url: "{{ route('admin.moveFormToWaiting') }}",
                    data: {
                        form_id: that.attr('data-id'),
                        status: that.prev().val()
                    },
                    success: function(result) {
                        location.reload();
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.responseJSON.error);
                    }
                });
            }
        });

        $('.providers-dropdown').change(function() {
            if ($(this).val() >= 1) {
                $.ajax({
                    url: "{{ route('admin.providerDetails') }}",
                    data: {
                        id: $(this).val()
                    },
                    success: function(result) {
                        $('#extra_person').val(result.person_name);
                        $('#extra_phone').val(result.phone);
                        $('#extra_notes').val(result.notes);
                        $('#modal-action-provider-id').val(result.id);
                    }
                });
            }
        });

        const closeProviderModal = document.querySelector('.close-approval-partners-modal');
        if (closeProviderModal) {
            closeProviderModal.addEventListener('click', function() {
                approval_partners_modal.classList.add('hidden')
            })
        }

        // Start update a provider details
        var that
        const edit_provider_modal = document.querySelector('.edit-provider-modal');
        $('.edit-provider').click(function() {
            that = $(this)
            $.ajax({
                url: "{{ route('admin.editProvider') }}",
                data: {
                    id: that.data('id')
                },
                success: function(result) {
                    $('#id').val(result.id)
                    $('#name').val(result.name)
                    $('#person_name').val(result.person_name)
                    $('#phone').val(result.phone)
                    $('#email').val(result.email)
                    $('#full_address').val(result.full_address)
                    edit_provider_modal.classList.remove('hidden');
                }
            })
        })

        const closeEditProviderModal = document.querySelector('.close-edit-Provider-modal');
        if (closeEditProviderModal) {
            closeEditProviderModal.addEventListener('click', function() {
                edit_provider_modal.classList.add('hidden')
            })
        }
        // End update a provider details

        // Approve Modal
        var approve_case_id;
        var approve_modal_content;
        $('.show-approve-modal').click(function() {
            approve_case_id    = $(this).attr('approve-data-id');
            $.ajax({
                type: 'GET',
                url: "{{ route('admin.approveDetails') }}",
                data:{id:approve_case_id}, 
                success: function(result) {
                    approve_modal_content  = '<table class="min-w-full divide-y divide-gray-200 text-center bg-gray-50"><tr><td>{{ trans('development_interventions.reference_number') }}</td><td>'+result.reference_number+'</td></tr><tr><td>{{ trans('development_interventions.created_at') }}</td><td>'+result.created_at+'</td></tr></table>';
                    $('#inner-approve-content').html(approve_modal_content);
            }});
            $('.approve-modal').show();
        });
        $('.close-the-approve-modal').click(function(){
            $('.approve-modal').hide('fast');
        });
        // Approve Modal

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
        // Image Modal Viewer JS Handler
        
        // Reason Modal
        var reason_case_id;
        var reason_modal_content;
        $('.show-reason-modal').click(function() {
            reason_case_id    = $(this).attr('reason-data-id');
            $.ajax({
                type: 'GET',
                url: "{{ route('admin.reasonDetails') }}",
                data:{id:reason_case_id},
                success: function(result) {
                    $('#reason').html(result.reason);
                    $('#notes').html(result.notes);
                    $('#created_at').html(result.created_at);
            }});
            $('.reason-modal').show();
        });
        $('.close-the-reason-modal').click(function(){
            $('.reason-modal').hide('fast');
        });
        // Reason Modal

        // Transfer multi selected
        $('.transfer-selected').click(function() {
            toRole = $(this).attr('data-role-id');
            selectedIds = [];
            $('.one-form-id:checked').each(function(key, val) {
                selectedIds.push($(val).attr('data-form-id'))
            })
            if (selectedIds.length >= 1) {
                event.preventDefault()
                var newForm = $('#transferIdsFormToExport').append(
                    jQuery('<input>', {
                        name: 'ids',
                        value: selectedIds,
                        type: 'hidden'
                    })
                );
                newForm = $('#transferIdsFormToExport').append(
                    jQuery('<input>', {
                        name: 'role',
                        value: toRole,
                        type: 'hidden'
                    })
                );
                newForm = $('#transferIdsFormToExport').append(jQuery('<input>', {
                    'name': 'details_id',
                    'value': '{{ $details_id ?? "" }}',
                    'type': 'hidden'
                }));
                newForm.submit();
            }
        })
    });
</script>