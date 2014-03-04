
<div class="container">
    <div class="page-header">
  		<h2>Crenado Carros...</h2><br>
                
    </div>
	   		
    <form class="form-horizontal " role="form" method="post" action="index.php?/car_controller/carQuery">
		
		<div class="form-group ">
	    	<label for="inputEmail3" class="col-sm-1 control-label">RNC</label>
	    	<div class="col-sm-3">
	      	<input type="text" class="form-control"  name="valor" >
	  	    </div>	  	
	  	</div>
        
        
                     
	  	<?php
                    foreach($pepito as $pepe)
                    echo $pepe;               
                ?>
                
    </form>
    
</div>