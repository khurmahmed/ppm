<?php 
$c = $this->data['client'][0];
$ca = $c->Client_address;
$cb = $c->Client_budget;
$ct = $this->data['type'];
?>

<section class='inputs'> 
<li>Edit client</li>
<ul id='error_message' ></ul>
<form id='form' action="/client/edit" method="post">

<input id='id' name='id' value='<?php echo $c->id; ?>' type='hidden' />	
<input id="firstname" value='<?php echo $c->firstname; ?>' type="text" placeholder='Enter the first name.' name="firstname" class='keyPressed' />
<input id="lastname" value='<?php echo $c->lastname; ?>' type="text" placeholder='Enter the surname.' name="lastname" class='keyPressed' />
<input id="email" value='<?php echo $c->email; ?>' type="text" placeholder='Enter the email address.' name="email" class='keyPressed' />
<input id="phone" value='<?php echo $c->phone; ?>' type="tel" placeholder='Enter the telephone number.' name="phone" class='keyPressed' />
<input id="postcode" value='<?php echo $ca->postcode; ?>' type="text" placeholder='Enter the postcode.' name="postcode" class='keyPressed' />
<input id="city" value='<?php echo $ca->city; ?>' type="text" placeholder='Enter the city.' name="city" class='keyPressed' />
<input id="line_1" value='<?php echo $ca->line_1; ?>' type="text" placeholder='Enter the first line of address.' name="line_1" class='keyPressed' />
<input id="line_2" value='<?php echo $ca->line_2; ?>' type="text" placeholder='Enter the second line of address.' name="line_2" class='keyPressed' />

<label>Buyer</label>
<input type="radio" name="client_type" id='buyer' <?php if($ct->name === 'buyer') echo 'checked'; ?> />
<label>Seller</label>
<input type="radio" name="client_type" id='seller' <?php if($ct->name === 'seller') echo 'checked'; ?> />
                      
<label>Minimum price</label> 
<input type="range" value='<?php echo $cb->from;  ?>' id="minSlider" min="10000" max="999999" />
<input type='text' name='min_price' id='min_price' value='<?php echo $cb->from;  ?>' /> 


<label>Maximum price</label>   
<input type="range" value='<?php echo $cb->to;  ?>' id="maxSlider" min="10000" max="999999" />  
<input type='text' name='max_price' id='max_price' value='<?php echo $cb->to;  ?>' />  

<input type="submit" id='submit'>

</form>   
<li id='d-<?php echo $c->id; ?>' class='delete' value='delete'></li>               
</section>
<script src="/global/js/client_edit.js"></script>