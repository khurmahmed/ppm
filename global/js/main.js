$(function() {
	
    if($('form').length > 0) $('form').on('submit', submitForm);       
    if($('input').length > 0) $("input").on('keyup', keyPressed);
    if($('#file').length > 0) $("#file").change(saveImage); 
    if($('#search').length > 0) $('#search').on('keyup', search);
    if($('.delete').length > 0) $('.delete').on('click', deleteById);
    $('#searchPop').on('click', searchMessage);
});                                           

function saveImage() {
                                                  
    var file = document.getElementById('file');
    var size = file.files[0].size; 
    
    if(!checkImage(file, size)) return false;       

    oData = new FormData(document.forms.namedItem("fileInfo"));
    
    var oReq = new XMLHttpRequest();
    oReq.open("POST", '/property/image/save', true);
    
    oReq.onreadystatechange = function() {
        if (oReq.readyState == 4 && oReq.status == 200) { 
            switch(oReq.response) {
                case 1:
                    console.log('wrong file type');
                    break;
                case 2:
                    console.log('error creating');  
                    break;
                default:                                    
                    imageSaved(oReq.response);     
                    break;    
            }
        }
    }
    
    oReq.send(oData);    
}                    

function imageSaved(img) {
    
    var count = $('#images li').length;                   
    $('#images').append('<li><img src="/static/img/'+img+'" /><input name="image_'+count+'" id="image_'+count+'" type="hidden" value="'+img+'" /></li>');
}

function submitForm(e) {   
    
    e.preventDefault();
    
    var row = $(this).serialize().split('&');
    var validation = true;
    var array = {};      
    
    $(row).each(function(x, y) {
        input = y.split('=');  
        if(!validate(input[0], input[1])) validation = false;
        input[1] = input[1].replace("%40","@");
        input[1] = input[1].replace(/\+/g, " ");
        array[input[0]] = input[1];   
    });  
    
    if(validation) sendForm(array);
}   

function keyPressed(e) {
                                 
    var input = e.currentTarget.id;
    var val = $('#'+input).val(); 
    if(val.length > 4) validation = validate(input, val); 
} 

function postJSON(url, array) {
    
    return $.ajax({
        type: "POST",
        url: url,
        data: array,
        dataType: "json"
    });        
}  

function searchMessage() {
    
    alert('Type anywhere to search.');
}

