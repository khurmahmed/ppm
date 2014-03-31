<?php      
$properties = '';                                  
if($this->data['properties']) {
     foreach($this->data['properties'] as $property) {
         $properties .= "<a href='/property/edit/$property->id' id='a-$property->id'><li>$property->address_line $property->postcode</li>";                   
          
         foreach($property->Property_image as $image) {
             $properties .= "<li class='image'><img src='/static/img/$image->filename' /></li>";
         }
         $properties .= "<li id='d-$property->id' class='delete' value='delete'></li>"; 
         $properties .= "</a>";
         //$properties .= "<input id='d-$property->id' class='delete' value='delete' type='submit' />"; 
         
     }
}
?>

<article>                                                                                             
<section class='viewed_properties'><li>Properties</li><?php echo $properties; ?></section>
</article> 

<div class='dim'>         
    <h1>Search for a property</h1>              
    <img class='close' id='closeDim' src='/global/img/close.png' />
    <form id='form' action="/property/postcode" method="post">
                                            
    <input id="postcode" type="text" placeholder='Enter the postcode.' name="postcode" class='keyPressed' />
    <select id='distance' name="distance">
        <option value="25">25 Miles</option>
        <option value="50">50 Miles</option>
        <option value='75'>75 Miles</option>
        <option value='100'>100 Miles</option>
        <option value='400'>400 Miles</option>
    </select>                           

    </form>
    
    <ul id='error_message' ></ul>
</div>

<div id='fullScreenImages'>      
    <h2></h2>                                      
    <img class='close' id='closeImages' src='/global/img/close.png' />
    <img src='/global/img/right-arrow.png' id='right' class='arrow' />
    <img src='/global/img/left-arrow.png' id='left' class='arrow' />
    <ul></ul>
</div>

<script src="/global/js/property_index.js"></script>  