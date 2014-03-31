$(function() {
    
    $(window).on('keyup', showSearch);  
    $('#closeDim').on('click', hideSearch);                               
    $('#postcode').on('keyup', search);
    $('#distance').change(search);
});

function sendForm(array) {     
                              
     postJSON('/property/postcode', array).done(function(data) {         
                   
         if(data.result) $('#error_message').html(data.result);
         else if(data.postcode_error) $('#error_message').html(data.postcode_error);
         else if(data.error_empty) $('#error_message').html(data.error_empty);
         else serverError(data.error); 
     })
     .error(function() {
        console.log('error');    
     }); 
}    

function search() {
                                   
    var val = $('#postcode').val();                        
    if(!validate('postcode', val)) return false;   
    var distance = $('#distance').val();
    sendForm({postcode:val, distance:distance});
}

function showSearch(e) {   
    
    if($('.dim').css('display') === 'none') {
        $('.dim').css('display', 'block'); 
        $('#postcode').focus().val(String.fromCharCode(e.keyCode));
    }
}

function hideSearch(e) {   
    
    $('.dim').css('display', 'none');          
}