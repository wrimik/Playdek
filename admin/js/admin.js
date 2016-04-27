$(document).ready(function(){
    removeImg();
   $('.datepicker').datepicker(); 
   sortable();
   editExpansion();
   if($('select[name=dlc_id] option').length == 0){
       $("#expansion-form").hide();
   }
    cleanUrls();
});

function cleanUrls(){
    $(document).on('submit', $('.clean-urls').parents('form'), function(){
       $('.clean-url').each(function(){
           var val = $(this).val();
           if(val.length > 3){
               // URLs throw security issues in post data. Script adds a space character before all values
               $(this).val(' '+val);
           }
       });
    });
}

function editExpansion(){
    $(document).on('click', '#edit-expansions div', function(){
       var id = $(this).attr('data-id');
       $.get('get/dlc.php', {id:id}, function(json){
           j = JSON.parse(json);
           $('input[name=dlc_published][value='+j['dlc_published']+']').trigger('click');
           $('input[name=dlc_id]').val(j['dlc_id']);
           $('input[name=dlc_title]').val(j['dlc_title']);
           CKEDITOR.instances.dlc_content.setData( j['dlc_content'] ); 
       });
    });
}

function sortable(){
    $('#sortable').sortable();
}

function removeImg(){
    $(document).on('click', '.game-img .delete', function(){
        var div = $(this).parent('div');
        if(confirm('Hold Up: Are you totally sure you want to delete this image forever??')){
            $.post('process/delete-img.php',{
                'img' : $(this).attr('data-id')
            }, function(){
               $(div).remove(); 
            });
        }
    });
}