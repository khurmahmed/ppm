var image_count = 0;
var current_image = 0;

$(function() {
    
    $(window).on('keyup', showSearch);  
    $('#closeDim').on('click', hideSearch); 
    $('#closeImages').on('click', hideImages);                               
    $('#postcode').on('keyup', search);
    $('#distance').change(search);
    $('.image').on('click', showImage);
    $('#left').on('click', moveLeft);
    $('#right').on('click', moveRight);
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

function deleteById() {
                    
    var id = $(this).attr('id').substr(2);
    postJSON('/property/delete', {property:id}).done(function(data) {     
         
        if(data.id) {
            $('#a-'+data.id).remove();  
            $('#d-'+data.id).remove();   
        } else {
            serverError(data.error);
        }
     })
     .error(function() {
        console.log('error');    
     });
     return false;
}

function showImage() {
    
    $('#right').css({display:'none'});
    $('#left').css({display:'none'});
    
    
    $('#fullScreenImages ul').css({left:'0px'});
    if($('#fullScreenImages').css('display') === 'none') {
        $('#fullScreenImages').css('display', 'block');             
    }  
    
    image_count = $(this).parent().find('li').length - 3;  
    current_image = 0;     
    var i = $(this).find('img').attr('src').substr(12).replace('.jpg', '');                 
    $('#fullScreenImages ul').html('<li><img src="/static/img/'+i+'_large.jpg" /></li>');
     
    var title = $(this).parent().find('li:first-child').html();
    $('#fullScreenImages h2').html(title);       
    var array = $(this).parent().find('.image:not(:last-child)');
    
    $.each(array, function(x, y) {
        var a_i = $(y).find('img').attr('src').substr(12).replace('.jpg', '');
        if(a_i !== i) $('#fullScreenImages ul').append('<li><img src="/static/img/'+a_i+'_large.jpg" /></li>');
    });               
    var w = $(window).width();
    var h = $(window).height();                                          
    $('#fullScreenImages ul li img').css({width:w, height:h}); 
    if(image_count > 1) $('#right').css({display:'inline'});
    return false;
}

function moveLeft() {
                           
    if(current_image === 0) current_image = image_count;                        
    else current_image--;
    
    var w = $(window).width();
    move = -current_image * w;
    $('#fullScreenImages ul').animate({left:move});
}


function moveRight() {
    
    if(current_image === image_count) current_image = 0;                        
    else current_image++;
    
    if($('#left').css('display') === 'none') $('#left').css('display', 'inline');
    var w = $(window).width();
    move = -current_image * w;
    $('#fullScreenImages ul').animate({left:move});
}

function hideImages() {
    
    $('#fullScreenImages').hide();
}