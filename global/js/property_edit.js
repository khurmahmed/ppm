$(function() {
    
    $('#priceSlider').on('change', function(){
        $('#asking_price').val($('#priceSlider').val());
    });  
});

function beforeSend(array) {
    
    var count = $('#images li').length;  
    array['images'] = count;
    return array;
}

function sendForm(array) {     
     
     array = beforeSend(array);
     postJSON('/property/edit', array).done(function(data) {
        if(data.update) {
            $('#error_message').html('updated');    
        } 
        else if(data.postcode_error) $('#error_message').html(data.postcode_error);  
        else {
            serverError(data.error);
        }  
     })
     .error(function() {
        console.log('error');    
     }); 
}  

function deleteById() {
    
    var id = $(this).attr('id').substr(2);
    postJSON('/property/delete', {property:id}).done(function(data) {     
         
        if(data.id) {
            window.location.replace('/property');
        } else {
            serverError(data.error);
        }
     })
     .error(function() {
        console.log('error');    
     });
}