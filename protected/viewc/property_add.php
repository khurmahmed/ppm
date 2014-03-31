<section class='inputs'> 
<li>Add property</li>             
<form id='form' action="/client/add" method="post">
    
<input type="search" name='search' id='search' placeholder='Search for client' class='keyPressed'/>        

<ul id='error_message' ></ul>
<input type='hidden' name='client' id='client' /> 
<input id="postcode" type="text" placeholder='Enter the postcode.' name="postcode" class='keyPressed' />
<input id="city" type="text" placeholder='Enter the city.' name="city" class='keyPressed' />
<input id="country" type="text" placeholder='Enter the country.' name="country" class='keyPressed' />
<input id="town" type="text" placeholder='Enter the town.' name="town" class='keyPressed' />     
<input id="address_line" type="text" placeholder='Enter the address line.' name="address_line" class='keyPressed' />

<label>Asking price</label>
<input type="range" value='0' id='priceSlider' min="10000" max="999999" />         
<input type='text' name='asking_price' id='asking_price' /> 
            
<div id='images'></div>
<input type="submit" id='submit' />  
</form>

<form enctype="multipart/form-data" method="post" name="fileInfo">
    <input type="file" name="file" id='file' accept="image/*" />
</form>
</section>
<script src="/global/js/property_add.js"></script>