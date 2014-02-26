
<div class="container">
    <div class="page-header">
  		<h2>Crenado Carros...</h2><br>
                
    </div>
	   		
    <form class="form-horizontal " role="form" method="post" action="index.php?/car_controller/createUniqueModel">
		
		<div class="form-group ">
	    	<label for="inputEmail3" class="col-sm-1 control-label">Año</label>
	    	<div class="col-sm-4">
	      	<input type="text" class="form-control"  name="valor1" value="<?php echo set_value('valor1');?>"  >
	  	    </div>	  	
	  	</div>
        
                <div class="form-group ">
	    	<label for="inputEmail3" class="col-sm-1 control-label">Marca</label>
	    	<div class="col-sm-4">
	      	<input type="text" class="form-control"  name="valor7" value="<?php echo set_value('valor7');?>"  >
	  	    </div>	  	
	  	</div>
                
	  	<div class="form-group ">
	    	<label for="inputEmail3" class="col-sm-1 control-label">Modelo</label>
	    	<div class="col-sm-4">
	      	<input type="text" class="form-control"  name="valor2" >
	  	    </div>	  	
	  	</div>
                

	  	<div class="form-group ">
	    	<label for="inputEmail3" class="col-sm-1 control-label">Trim</label>
	    	<div class="col-sm-4">
	      	<input type="text" class="form-control"  name="valor3" value="<?php echo set_value('valor3');?>" >
	  	    </div>	  	
	  	</div>
            

                <div class="form-group ">
	    	<label for="inputEmail3" class="col-sm-1 control-label">Body Style</label>
	    	<div class="col-sm-4">
	      	<input type="text" class="form-control"  name="valor4" value="<?php echo set_value('valor4');?>" >
	  	    </div>	  	
	  	</div>
                   
	  	<div class="form-group ">
	    	<label for="inputEmail3" class="col-sm-1 control-label">Engine Type</label>
	    	<div class="col-sm-4">
	      	<input type="text" class="form-control"  name="valor5" value="<?php echo set_value('valor5');?>" >
	  	    </div>	  	
	  	</div>

	  	<div class="form-group ">
	    	<label for="inputEmail3" class="col-sm-1 control-label">Transmision</label>
	    	<div class="col-sm-4">
	      	<input type="text" class="form-control"  name="valor6" value="<?php echo set_value('valor6');?>" >
	  	    </div>	  	
	  	</div>
                <?php echo form_error('email'); ?>
                  
	  	<div class="form-group">
    		<div class="col-sm-offset-4 col-sm-10">
      			<button type="submit" class="btn btn-default">Create</button>
    		</div>
  		</div>
                     
	  	<?php
                    foreach($pepito as $pepe)
                    echo $pepe;               
                ?>
                
    </form>
    
</div>