
<div class="container">
    <div class="page-header">
  		<h2>Ingrese Sus Datos</h2><br>
                
    </div>
	   		
    <form class="form-horizontal " role="form" method="post" action="index.php?/user_controller/CreateUser">
		
		<div class="form-group ">
	    	<label for="inputEmail3" class="col-sm-1 control-label">Nombre</label>
	    	<div class="col-sm-4">
	      	<input type="text" class="form-control"  name="name" value="<?php echo set_value('name');?>"  >
	  	    </div>	  	
	  	</div>
                
	  	<div class="form-group ">
	    	<label for="inputEmail3" class="col-sm-1 control-label">Contraseña</label>
	    	<div class="col-sm-4">
	      	<input type="password" class="form-control"  name="password" >
	  	    </div>	  	
	  	</div>
                <?php echo form_error('password'); ?>

	  	<div class="form-group ">
	    	<label for="inputEmail3" class="col-sm-1 control-label">RNC O Cédula</label>
	    	<div class="col-sm-4">
	      	<input type="text" class="form-control"  name="cedula_rnc" value="<?php echo set_value('cedula_rnc');?>" >
	  	    </div>	  	
	  	</div>
                <?php echo form_error('cedula_rnc'); ?>

                <div class="form-group ">
	    	<label for="inputEmail3" class="col-sm-1 control-label">Dirección</label>
	    	<div class="col-sm-4">
	      	<input type="text" class="form-control"  name="address" value="<?php echo set_value('address');?>" >
	  	    </div>	  	
	  	</div>
        
                <div class="form-group ">
                    <label for="inputEmail3" class="col-sm-1 control-label">Ciudad</label>
                    <div class="col-sm-4">
                        <select class="form-control"  name="city">   
                           <?php
                           echo $thisFile; 
                            foreach ($cities as $city)
                           {
                             echo "<option value='.$city->ID.'>".$city->City."</option>";
                           }
                           ?>
                       </select>  
                    </div>	  	
	  	</div>

	  	<div class="form-group ">
	    	<label for="inputEmail3" class="col-sm-1 control-label">Télefono</label>
	    	<div class="col-sm-4">
	      	<input type="text" class="form-control"  name="phone" value="<?php echo set_value('phone');?>" >
	  	    </div>	  	
	  	</div>

	  	<div class="form-group ">
	    	<label for="inputEmail3" class="col-sm-1 control-label">Correo</label>
	    	<div class="col-sm-4">
	      	<input type="text" class="form-control"  name="email" value="<?php echo set_value('email');?>" >
	  	    </div>	  	
	  	</div>
                <?php echo form_error('email'); ?>

               
                <input type="hidden"  name="flag" value=<?php echo $flagValue;?> >

	  	<div class="form-group">
    		<div class="col-sm-offset-4 col-sm-10">
      			<button type="submit" class="btn btn-default">Create</button>
    		</div>
  		</div>
                     
	  	<?php
                    echo "<br><b>".$var."</b>";               
                ?>
                
    </form>
    
</div>