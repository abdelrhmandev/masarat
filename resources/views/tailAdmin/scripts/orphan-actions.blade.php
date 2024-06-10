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


           // Add Orphan age equivalent Degree Modal 
    
  
            




 
           


        // Get Orphan Equivalent Degree History Modal 
        var form_id;
        $('.get-orphan-age-equivalent-degree-history-button').click(function() {                      
            console.log(form_id);
            form_id = $(this).attr('data-form-id');
            $.ajax({
                type: 'GET',
                url: "{{ route('admin.orphan_age_equivalent_degree_history') }}",
                data: {
                    id: form_id
                },
                success: function(result) {
                    const orphan_age_equivalent_degree_history_content = [];                    
                    orphan_age_equivalent_degree_history_content.push('<div class="flex grid flex-col grid-cols-12 gap-3 mx-2 mt-4 overflow-hidden bg-white rounded-lg shadow-xl md:flex-row w-50"><div class="flex flex-col justify-center w-full col-span-4 px-3 py-4 text-white bg-blue-800"><h3 class="text-sm leading-tight truncate font-cairo">الدرجه</h3></div><div class="flex flex-col justify-center w-full col-span-8 px-3 py-4 text-white bg-red-800"><h3 class="text-sm leading-tight truncate font-cairo">تاريخ الأنشاء</h3></div>');
                    $('#orphan_age_equivalent_degree_history_content').html(orphan_age_equivalent_degree_history_content);

                    $(result).each(function(key, obj) {
                    orphan_age_equivalent_degree_history_content.push('<div class="flex grid flex-col grid-cols-12 gap-3 mx-2 mt-4 overflow-hidden bg-white rounded-lg shadow-xl md:flex-row w-50"><div class="flex flex-col justify-center w-full col-span-4 px-3 py-4 text-gray-800 bg-blue-100"><h3 class="text-sm leading-tight truncate font-cairo">'+obj['value']+'</h3></div><div class="flex flex-col justify-center w-full col-span-8 px-3 py-4 text-gray-800 bg-red-100"><h3 class="text-sm leading-tight truncate font-cairo">'+obj['created_at']+'</h3></div>');
                    $('#orphan_age_equivalent_degree_history_content').html(orphan_age_equivalent_degree_history_content);
                    });
                    orphan_age_equivalent_degree_history_content.push('</div>');
                        $('#orphan_age_equivalent_degree_history_content').html(orphan_age_equivalent_degree_history_content);
                }
            });
            $('.orphan-get-age-equivalent-degree-history-modal').show();
        });        
        $('.close-the-modal').click(function() {
            $('.orphan-get-age-equivalent-degree-history-modal').hide('fast');
        });             
        // Get Orphan Equivalent Degree History Modal 
        
        // Add  Objective
   
    
        
  

        // Orphan path Type Modal 
        var form_id;
        $('.add-orphan-path-category-button').click(function() {                      
            form_id = $(this).attr('data-form-id');             
            $('#action-form-id-path').val(form_id);          
            $('.orphan-path-category-modal').show();
        });        
        $('.close-the-modal').click(function() {
            $('.orphan-path-category-modal').hide('fast');
        });             

        // Add Objective
        $('.orphan-add-objective-button').click(function() {                              
            $('.orphan-objective-add-modal').show();
        });        
        $('.close-the-modal').click(function() {
            $('.orphan-objective-add-modal').hide('fast');
        });  
        // End Of Add Objective

 
        // Add Objective For a Specific Orphan
        $('.add-objective-orphan-button').click(function() {    
            $('.orphan-objective-add-orphan-modal').show();
        });        
        $('.close-the-modal').click(function() {
            $('.orphan-objective-add-orphan-modal').hide('fast');
        });  
        // End Objective For a Specific Orphan

        // Edit objective Modal
        var objective_id;
        $('.edit-objective-button').click(function() {     
            objective_id = $(this).attr('data-objective-id');
            $('#objective_id').val(objective_id);
            $.ajax({
                type: 'GET',
                url: "{{ route('admin.orphan.objectives.edit') }}",
                data: {
                    id: objective_id
                },
                success: function(result) {
                    $('#title').val(result.title);  
                    
                    if(result.active){
                        $("#active_edit").prop("checked",true);
                    }else{
                        $("#active_edit").prop("checked",false);
                    }
                }
            });
            $('.orphan-objective-edit-modal').show();
        });        
        $('.close-the-modal').click(function() {
            $('.orphan-objective-edit-modal').hide('fast');
        });             
        // End Edit objective Modal

        // Start delete objective Modal
        var objective_title;
        var objective_id;
        const deleteobjective_content = [];                    

        
        $('.delete-objective-button').click(function() {   
            objective_title = $(this).attr('data-objective-title');
            objective_id = $(this).attr('data-objective-id');

                    deleteobjective_content.push('<div class="flex grid flex-col grid-cols-12 gap-3 mx-2 mt-4 overflow-hidden bg-white rounded-lg shadow-xl md:flex-row w-50"><div class="flex flex-col justify-center w-full col-span-4 px-3 py-4 text-white bg-blue-800"><h3 class="text-sm leading-tight truncate font-cairo">الدرجه</h3></div><div class="flex flex-col justify-center w-full col-span-8 px-3 py-4 text-white bg-red-800"><h3 class="text-sm leading-tight truncate font-cairo">تاريخ الأنشاء</h3></div>');
                    $('#confirm_delete_objective_message').html('حذف '+"["+objective_title+"]"+' !!! ');

               
                
                $('#delete_objective_id').val(objective_id);


            $('.orphan-objective-delete-modal').show();
        });        
        $('.close-the-modal').click(function() {
            $('.orphan-objective-delete-modal').hide('fast');
        });  

        // End delete objective Modal




        // Single transfer

    });
</script>