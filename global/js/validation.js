var error_colour = '#A30000';
var accepted_colour = '#000';

function validate(input, val) {
    
    return getErrorMessage(input, val);    
}

function getErrorMessage(input, val) {   
    
    if(!checkValAgainstInput(input, val)) {
        $('#'+input).css({border:'solid 1px '+error_colour});
        return false;       
    } else {
        $('#'+input).css({border:'solid 1px '+accepted_colour});
        return true;
    }   
}

function checkValAgainstInput(input, val) {
       
    switch(input) {
        case 'firstname':         
            if(!validateMinLength(val, 5) || !validateMaxLength(val, 50) || !validateAlpha(val)) return false;
            break;
        case 'lastname':
            if(!validateMinLength(val, 5) || !validateMaxLength(val, 50) || !validateAlpha(val)) return false;
            break;   
        case 'email':
            if(!validateMinLength(val, 6) || !validateMaxLength(val, 80) || !validateEmail(val)) return false;
            break;
        case 'phone':
            if(!validateMinLength(val, 11) || !validateMaxLength(val, 13) || !validateDigit(val)) return false;
            break;
        case 'postcode':
            if(!validateMinLength(val, 6) || !validateMaxLength(val, 80) || !validateAlphaNumeric(val)) return false;
            break;
        case 'search':
            if(!validateMinLength(val, 1) || !validateMaxLength(val, 20) || !validateAlphaNumeric(val)) return false;
            break;
        case 'city':
            if(!validateMinLength(val, 3) || !validateMaxLength(val, 100) || !validateAlpha(val)) return false;
            break;
        case 'line_1':
            if(!validateMinLength(val, 4)) return false;
            break;
        case 'line_2':
            if(!validateMinLength(val, 4)) return false;
            break;    
        case 'geo_lat':
            if(!validateMinLength(val, 6) || !validateMaxLength(val, 10)) return false;
            break;   
        case 'geo_long':
            if(!validateMinLength(val, 6) || !validateMaxLength(val, 10)) return false;
            break;
        case 'min_price':
            if(!validateMaxLength(val, 6)|| !validateMinLength(val, 5) || !validateDigit(val)) return false;
            break;
        case 'max_price':
            if(!validateMaxLength(val, 6)|| !validateMinLength(val, 5) || !validateDigit(val)) return false;
            break;
        case 'asking_price':
            if(!validateMaxLength(val, 6) || !validateMinLength(val, 5) || !validateDigit(val)) return false;
            break;
        case 'client_search':
            if(!validateMinLength(val, 1) || !validateAlphaNumeric(val)) return false;
            break;
        default:
            return true;
            break;
    }                      
    return true;         
}

function validateMinLength(val, length) {                                           
    return val.length > (length - 1);    
}

function validateMaxLength(val, length) {                    
    return val.length < (length + 1);
}

function validateAlpha(val) {                                          
    return /^[a-zA-Z()]+$/.test(val);    
}

function validateEmail(val) {   
    var res = val.replace("%40","@");
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(res); 
} 

function validateDigit(val) {
    return $.isNumeric(val);    
}

function validateAlphaNumeric(val) {  
    return /^[A-Za-z0-9 +]+$/i.test(val);
}

function serverError(error) {
    
    var message = '';
    $.each(error, function(i, item) {
        if(typeof item === 'string') {
            message += '<li>'+item+'</li>';
        } else {
            $.each(item, function(x, list) {
                message += '<li>'+list+'</li>';
            });
        }
        $('#'+i).css({border:'solid 1px '+error_colour});
    });
    
    $('#error_message').html(message);
}

function validateImage(file, size) {
    
    return size > 5242880 || file.files[0].name.match(/\.(jpg|jpeg|png|gif|JPG|JPEG|PNG|GIF)$/);
}

function checkImage(file, size) {
    
    if(!validateImage(file, size)) {
        $('#file').css({border:'solid 1px '+error_colour}); 
        return false;
    }    
    $('#file').css({border:'solid 1px '+accepted_colour}); 
    return true;
}