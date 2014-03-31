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
     postJSON('/property/add', array).done(function(data) {
        if(data.insert) window.location.replace("/property");
        else if(data.postcode_error) $('#error_message').html(data.postcode_error);  
        else {
            serverError(data.error);
        }
     })
     .error(function() {
        console.log('error');    
     }); 
}  

function search() {
    
    var val = $('#search').val();
    if(val.length > 4 && validate('search', val)) {
        postJSON('/client/search', {search:val}).done(function(data) {     
         
        if(data.error_none) {
            $('#error_message').html(data.error_none);
        } else if(data.result) {
            $('#error_message').html(data.result);
            var count = $('#error_message').find('li').length;
            if(count === 1) {
                var val = $('#error_message').find('li').attr('id').substr(2);
                $('#clientResult').html( $('#c-'+val).html());
                $('#client').val(val);  
            }
            $('.result').on('click', openSubmit);
        } else {
            serverError(data.error);
        }
     })
     .error(function() {
        console.log('error');    
     }); 
    } 
}

function openSubmit() {
    
    var val = $(this).attr('id').substr(2);
    $('#clientResult').html( $('#c-'+val).html());
    $('#client').val(val);
    
}