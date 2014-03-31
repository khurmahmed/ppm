<?php
$result = array('like', 'offer', 'reject', 'unknown');
$options = '';
foreach($result as $enum) {
    $options.="<option value='$enum'>$enum</option>";    
}
$seller = '';
$buyer = '';

foreach($this->data['clients'] as $c) {   
    $id = $c->id;
    $text =  "<a href='/client/edit/$id' id='a-$id' ><li>$c->firstname $c->lastname $c->phone</li>";
    if($c->type === '1') $text .= "<li id='l-$id' class='link' ></li>";                                                  
    $text .= "<li id='d-$id' class='delete' value='delete'></li></a>";
    
    if($c->type === '1') $buyer .= $text;
    else $seller .= $text;                                 
}                                             
?>
<article>                                                                                             
<section class='updated_clients'><li>Sellers</li><?php echo $seller; ?></section>
<section class='viewed_properties viewed_properties_half'><li>Buyers</li><?php echo $buyer; ?></section>
</article>  

<div class='dim' id='linkClient'>
    <h1>Link this client to a property</h1>                     
    <img class='close' id='closeLink' src='/global/img/close.png' />     
                                            
    <form id='form' action="/property/link" method="post">
        <input type="text" name='search' class='search' id='search' placeholder='Search for property' class='keyPressed'/>
        <input type='hidden' value='' name='client' id='client'/>
        <input type='hidden' value='' name='property' id='property' />
        <ul id='error_message'></ul> 
        <select name="result" id="result"><?php echo $options; ?></select>
        <input type="submit" id='submit' class='searchSubmit'>
    </form>                           
</div>

<div class='dim' id='searchClient'>         
    <h1>Search for a client</h1>              
    <img class='close' id='closeSearch' src='/global/img/close.png' />
    <form id='form' action="/client/find" method="post">
                                            
    <input id="client_search" type="text" placeholder='Search client name/address/email/phone.' name="client_search" class='keyPressed' />                       

    </form>
    
    <ul id='error_message2' ></ul>
</div>

<script src="/global/js/client_index.js"></script>
