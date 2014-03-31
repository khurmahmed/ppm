<section class='inputs'> 
<li>Add client</li>
<ul id='error_message' ></ul>
<form id='form' action="/client/add" method="post">
	
<input id="firstname" type="text" placeholder='Enter the first name.' name="firstname" class='keyPressed' />
<input id="lastname" type="text" placeholder='Enter the surname.' name="lastname" class='keyPressed' />
<input id="email" type="text" placeholder='Enter the email address.' name="email" class='keyPressed' />
<input id="phone" type="tel" placeholder='Enter the telephone number.' name="phone" class='keyPressed' />
<input id="postcode" type="text" placeholder='Enter the postcode.' name="postcode" class='keyPressed' />
<input id="city" type="text" placeholder='Enter the city.' name="city" class='keyPressed' />
<input id="line_1" type="text" placeholder='Enter the first line of address.' name="line_1" class='keyPressed' />
<input id="line_2" type="text" placeholder='Enter the second line of address.' name="line_2" class='keyPressed' />

<label>Buyer</label>
<input type="radio" name="client_type" id='buyer' />
<label>Seller</label>
<input type="radio" name="client_type" id='seller' checked />
                                                                        

<label>Minimum price</label> 
<input type="range" value='0' id="minSlider" min="10000" max="999999" />
<input type='text' name='min_price' id='min_price' /> 


<label>Maximum price</label>   
<input type="range" value='0' id="maxSlider" min="10000" max="999999" />  
<input type='text' name='max_price' id='max_price' />  

<input type="submit" id='submit'>

</form>
</section>
<script src="/global/js/client_add.js"></script>