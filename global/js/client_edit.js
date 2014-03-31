$(function() {            
    
    $('#minSlider').on('change', function(){
        $('#min_price').val($('#minSlider').val());       
    });  
    
    $('#maxSlider').on('change', function(){
        $('#max_price').val($('#maxSlider').val());
    });  
});

function sendForm(array) {     
     
     array = beforeSend(array);
     postJSON('/client/edit', array).done(function(data) {
        if(data.update) {
            console.log('updated');    
        } else {
            serverError(data.error);
        }
     })
     .error(function() {
        console.log('error');    
     }); 
}   

function beforeSend(array) {
    
    if($('#buyer').is(':checked')) array['client_type'] = 'buyer';
    else array['client_type'] = 'seller';
    return array;
}

function deleteById() {
    
    var id = $(this).attr('id').substr(2);
    postJSON('/client/delete', {client:id}).done(function(data) {     
         
        if(data.id) {
            window.location.replace('/client');
        } else {
            serverError(data.error);
        }
     })
     .error(function() {
        console.log('error');    
     });
}