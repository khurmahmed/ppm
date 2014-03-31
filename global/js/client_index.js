$(function() {
                                        
    $('#closeLink').on('click', hideLink);  
    $('.link').on('click', link); 
    
    $(window).on('keyup', showSearch);        
    $('#closeSearch').on('click', hideSearch);
                                  
    $('#client_search').on('keyup', searchClient);
});

function searchClient() {
    
    var val = $('#client_search').val();                        
    if(!validate('client_search', val)) return false;   
    sendFormClient({client_search:val});
}

function sendFormClient(array) {     
                              
     postJSON('/client/find', array).done(function(data) {         
                   
         if(data.result) $('#error_message2').html(data.result);                     
         else if(data.error_none) $('#error_message2').html(data.error_none);
         else serverError(data.error); 
     })
     .error(function() {
        console.log('error');    
     }); 
}

function hideSearch() {
    
    $('#searchClient').css('display', 'none');
}

function showSearch(e) {   
      
    if($('#linkClient').css('display') === 'block') return false;
    if($('#searchClient').css('display') === 'none') {
        $('#searchClient').css('display', 'block'); 
        $('#client_search').focus().val(String.fromCharCode(e.keyCode));
    }
}

function sendForm(array) {     
     
     beforeSend();                               
     postJSON('/client/link', array).done(function(data) {     
         
        if(data.update) {
            $('#error_message').html('updated');
            $('#search').css({display:'none'});
            $('#result').css({display:'none'});
            $('#submit').css({display:'none'});
        } else {
            serverError(data.error);
        }
     })
     .error(function() {
        console.log('error');    
     }); 
}  
        
function beforeSend() {
    
     $('#error_message').html('');
}     

function search() {
    
    var val = $('#search').val();
    if(val.length > 4 && validate('search', val)) {
        postJSON('/property/search', {search:val}).done(function(data) {     
         
        if(data.error_none) {
            $('#error_message').html(data.error_none);
        } else if(data.result) {
            $('#error_message').html(data.result);
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

function link() {                                       
    
    var id = $(this).attr('id').substr(2);  
    $('#client').val(id);                          
    $('#linkClient').css({display:'block'});
    return false;
}

function openSubmit() {
    
    var id = $(this).attr('id').substr(2);   
    $('#error_message').html( $('#p-'+id));          
    $('#property').val(id);
    $('#result').css({display:'block'});
    $('#submit').css({display:'block'});
    
}

function deleteById() {
    
    var id = $(this).attr('id').substr(2);
    postJSON('/client/delete', {client:id}).done(function(data) {     
         
        if(data.id) {
            $('#a-'+data.id).remove(); 
            $('#l-'+data.id).remove();
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
          

function hideLink() {
    
    $('#linkClient').css({display:'none'});
} 
