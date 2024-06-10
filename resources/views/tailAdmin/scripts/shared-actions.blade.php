<script>
    function showhide(id) {
        $("#notcompletedints" + id).toggle();
        $("#Xnotcompletedints" + id).toggle();
    }

    function showHideIntDetails(id){
        var target_div = $("#tr_int_details" + id);
        if (target_div.is(":hidden")) {
            $(".filters-holder").hide(); 
            target_div.show();             
            $('#icon_'+id).attr("src","<?php echo url('/img/minus.svg'); ?>");                    
        }
        else if (target_div.is(":visible")) {
            target_div.hide(); 
            $('#icon_'+id).attr("src","<?php echo url('/img/plus.svg'); ?>");  
         }      
    }

    // Start image Modal Viewer JS Handler
    const closeImageModal = document.querySelector('.image-close-modal');
    const imageModal = document.querySelector('.image-modal');
    closeImageModal.addEventListener('click', function() {
        imageModal.classList.add('hidden')
        imageModal.style.display = 'none';
    })
    // End image Modal Viewer JS Handler
</script>