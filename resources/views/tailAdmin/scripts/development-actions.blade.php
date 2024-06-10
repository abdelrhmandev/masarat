<script>
    
    function callviewmodal(id) {
        $('#action-pen-id').val(id);
        $('.orphan-age-equivalent-degree-modal').show();
        return false;
    }
    document.addEventListener("DOMContentLoaded", function() {
        var that;
        var toRole;
        var selectedIds;
        var rejectReason;

        const reject_development_modal = document.querySelector('.reject-development-modal');
        const closeDevelopmentModal = document.querySelector('.close-reject-development-modal');
        if (closeDevelopmentModal) {
            closeDevelopmentModal.addEventListener('click', function() {
                reject_development_modal.classList.add('hidden')
            })
        }
            
        // Supporter Modal
        var support_case_id;
        var supported_modal_content;
        $('.show-supporter-modal').click(function() {
            console.log(support_case_id);
            support_case_id = $(this).attr('data-id');
            $.ajax({
                type: 'GET',
                url: "{{ route('admin.supporterDetails') }}",
                data: {
                    id: support_case_id
                },
                success: function(result) {
                    $('#name').html(result.name);
                    $('#person_name').html(result.person_name);
                    $('#phone').html(result.phone);
                    $('#email').html(result.email);
                    $('#full_address').html(result.full_address);
                }
            });
            $('.supporter-modal').show();
        });
        
        $('.close-the-modal').click(function() {
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

        // Not Completed Modal
        var form_case_id;
        $('.shownotcompletedcases-modal').click(function() {
            form_case_id = $(this).attr('form-data-id');
            $.ajax({
                type: 'GET',
                url: "{{ route('admin.NotCompletedCasesModal') }}",
                data: {
                    id: form_case_id
                },
                success: function(result) {

                    const inner_notcompletedcases_content = [];

                    $(result).each(function(key, obj) {
                        inner_notcompletedcases_content.push('<div class="flex flex-wrap">' + obj + '<div></div>');
                        $('#inner_notcompletedcases_content').html(inner_notcompletedcases_content);
                    });


                }
            });
            $('.notcompletedcases-modal').show();
        });
        $('.close-the-notcompletedcases-modal').click(function() {
            $('.notcompletedcases-modal').hide('fast');
        });
        // Not Completed Modal

        // Reason Modal
        var reason_case_id;
        var reason_modal_content;
        $('.show-reason-modal').click(function() {
            reason_case_id = $(this).attr('reason-data-id');
            $.ajax({
                type: 'GET',
                url: "{{ route('admin.operationHangreasonDetails') }}",
                data: {
                    id: reason_case_id
                },
                success: function(result) {
                    $('#reason').html(result.reason);
                    $('#notes').html(result.notes);
                    $('#created_at').html(result.created_at);
                }
            });
            $('.reason-modal').show();
        });
        $('.close-the-reason-modal').click(function() {
            $('.reason-modal').hide('fast');
        });
        // Reason Modal

        // Single transfer
        $('.tansfer-single-case').click(function() {
            that = $(this);
            if (that.prev().val() == 11) {
                form_id = [that.attr('data-form-id')];
                $('#modal-action-form-id').val(form_id);
                reject_development_modal.classList.remove('hidden');
            } else {
                toRole = that.prev().val();
                selectedIds = [that.attr('data-form-id')];
                if (toRole >= 1) {
                    // Do the transfer with form submission
                    var newForm = $('#transferIdsForm').append(jQuery('<input>', {
                        'name': 'ids',
                        'value': selectedIds,
                        'type': 'hidden'
                    }));
                    newForm = $('#transferIdsForm').append(jQuery('<input>', {
                        'name': 'role',
                        'value': toRole,
                        'type': 'hidden'
                    }));
                    newForm = $('#transferIdsForm').append(jQuery('<input>', {
                        'name': 'details_id',
                        'value': '{{ $details_id ?? "" }}',
                        'type': 'hidden'
                    }));
                    newForm.submit();
                }
            }
        });

            // Add Orphan age equivalent Degree Modal
            var form_id;
            $('.add-orphan-age-equivalent-degree-button').click(function() {                      
                form_id = $(this).attr('data-form-id');  
       
            $('#action-form-id-age').val(form_id);

            $('.orphan-add-age-equivalent-degree-modal').show();
            });        
            $('.close-the-modal').click(function() {
            $('.orphan-add-age-equivalent-degree-modal').hide('fast');
            });        
            // End Orphan age equivalent Degree Modal



            // Orphan Load
            $('.orphan-load-modal').show();         
            $('.close-the-modal').click(function() {
            $('.orphan-load-modal').hide('fast');
            });    
            //End Orphan Load


           // Add Stage Modal
            $('.add-stage-button').click(function() {
            $('.stage-add-modal').show();
            });        
            $('.close-the-modal').click(function() {
            $('.stage-add-modal').hide('fast');
            });     
           // End Add Stage Modal


        // Edit stage Modal
        var stage_id;
        $('.edit-stage-button').click(function() {                    
            stage_id = $(this).attr('data-stage-id');
            $('#stage_id').val(stage_id);
            $.ajax({
                type: 'GET',
                url: "{{ route('admin.development.stages.edit') }}",
                data: {
                    id: stage_id
                },
                success: function(result) {
                    $('#title_edit').val(result.title);
                    $('#start_date_edit').val(result.start_date);
                    $('#end_date_edit').val(result.end_date);
                    if(result.active){
                        $("#active_edit").prop("checked",true);
                    }else{
                        $("#active_edit").prop("checked",false);
                    }
                }
            });
            $('.stage-edit-modal').show();
        });        
        $('.close-the-modal').click(function() {
            $('.stage-edit-modal').hide('fast');
        });             
        // End edit stage Modal
        

        // Transfer multi selected
        $('.transfer-selected').click(function() {
            toRole = $(this).attr('data-role-id');
            selectedIds = [];
            $('.one-form-id:checked').each(function(key, val) {
                selectedIds.push($(val).attr('data-form-id'))
            })
            if (selectedIds.length >= 1) {
                event.preventDefault()
                var newForm = $('#transferIdsForm').append(
                    jQuery('<input>', {
                        name: 'ids',
                        value: selectedIds,
                        type: 'hidden'
                    })
                );
                newForm = $('#transferIdsForm').append(
                    jQuery('<input>', {
                        name: 'role',
                        value: toRole,
                        type: 'hidden'
                    })
                );
                newForm = $('#transferIdsForm').append(jQuery('<input>', {
                    'name': 'details_id',
                    'value': '{{ $details_id ?? "" }}',
                    'type': 'hidden'
                }));
                newForm.submit();
            }
        })
    });
</script>