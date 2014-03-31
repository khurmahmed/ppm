<?php           
$p_count = array();
$p_id = array();   

$clients = '';
if($this->data['clients']) {
    foreach($this->data['clients'] as $c) {  
        $clients .= "<a href='/clients/edit/$c->id'>
            <li>$c->firstname</li>
            <li>$c->lastname</li> 
            <li>$c->email</li> 
        </a>";
    } 
}       

$properties = '';      
if($this->data['properties']) {
    foreach($this->data['properties'] as $p) {  
        $p_count[] = count($p->Property_views);
        $p_id[] = $p->id;   
    }    
}
         

array_multisort($p_count, SORT_DESC, $p_id);     
$p_count = array_slice($p_count, 0, 5);     

for($i=0;$i<count($p_count);$i++) {
    foreach($this->data['properties'] as $p) {
        if($p_id[$i] == $p->id) {  
            $properties .= "<a href='/property/edit/$p->id'><li>$p->address_line</li>";       
            foreach($p->Property_image as $pi) {
                $properties .= "<li><img src='/static/img/$pi->filename' /></li>";
            }  
            $properties .= '</a>';    
        }
    }
}
?>

<article>
<section class='updated_clients'><li>Recently updated clients</li><?php echo $clients; ?></section>
<section class='viewed_properties viewed_properties_half'><li>Most frequently viewed properties</li><?php echo $properties; ?></section>
</article> 

<div class='dim'> 
    <h1>Search for a property</h1>           
    <img class='close' id='closeDim' src='/global/img/close.png' />
    <form id='form' action="/client/add" method="post">
                                            
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

<script src="/global/js/dashboard.js"></script>
