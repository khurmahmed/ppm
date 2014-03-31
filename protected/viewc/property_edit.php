<?php   
    $p = $data['property'][0];  
    $pi = $p->Property_image;
    $images = '';
    foreach($pi as $image) {   
        $images.="<li><img src='/static/img/$image->filename'></li>";    
    }
    
    $clients = $this->data['clients']; 
    $options = '';
    $first_option = '';
    foreach($clients as $client) {
        if($client->id === $p->client) $first_option = '<option value="'.$client->id.'">'.$client->firstname.' '.$client->lastname.'</option>';
        else $options .= '<option value="'.$client->id.'">'.$client->firstname.' '.$client->lastname.'</option>';    
    }  
      
?>

<section class='inputs'> 
<li>Edit property</li>
<ul id='error_message' ></ul>
<form id='form' action="/client/add" method="post">

<input id='id' name='id' value='<?php echo $p->id; ?>' type='hidden' />    
<select name='client' id='client'><?php echo $first_option.$options; ?></select>   
<input id="postcode" value='<?php echo $p->postcode; ?>' type="text" placeholder='Enter the postcode.' name="postcode" class='keyPressed' />
<input id="city" value='<?php echo $p->city; ?>' type="text" placeholder='Enter the city.' name="city" class='keyPressed' />
<input id="country" value='<?php echo $p->country; ?>' type="text" placeholder='Enter the country.' name="country" class='keyPressed' />
<input id="town" value='<?php echo $p->town; ?>' type="text" placeholder='Enter the town.' name="town" class='keyPressed' />     
<input id="address_line" value='<?php echo $p->address_line; ?>' type="text" placeholder='Enter the address line.' name="address_line" class='keyPressed' />
                    

<label>Asking price</label>
<input type="range" value='<?php echo $p->asking_price; ?>' id='priceSlider' min="10000" max="999999" />         
<input type='text' name='asking_price' id='asking_price' value='<?php echo $p->asking_price; ?>' /> 

<div id='images'><?php echo $images; ?></div>
<input type="submit" id='submit'>  
</form>

<form enctype="multipart/form-data" method="post" name="fileInfo">
    <input type="file" name="file" id='file' accept="image/*" />
</form>
<li id='d-<?php echo $p->id; ?>' class='delete' value='delete'></li>                  
</section>
<script src="/global/js/property_edit.js"></script>