<div class="container">
  
    <div class="page-header">
  		<h2>Login</h2><br>
                
    </div>
    <form class="form-horizontal" role="form" method="post" action="index.php?/user_controller/userLogin">
		
		<div class="form-group ">
	    	<label for="inputEmail3" class="col-sm-1 control-label">RNC</label>
	    	<div class="col-sm-3">
	      	<input type="text" class="form-control"  name="cedula_rnc" value="<?php echo set_value('cedula_rnc');?>"  >
	  	    </div>	  	
	  	</div>
                
	  	<div class="form-group ">
	    	<label for="inputEmail3" class="col-sm-1 control-label">Contraseña</label>
	    	<div class="col-sm-3">
	      	<input type="password" class="form-control"  name="password" >
	  	    </div>	  	
	  	</div>
                
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-10">
      			<button type="submit" class="btn btn-default">Login</button>
                    </div>
                </div>    
               

                     
	  	<?php
                  echo $var;
                  echo form_error('cedula_rnc'); 
                    //echo validation_errors();              
                ?>
                
    </form>
    
</div>