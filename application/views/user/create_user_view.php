<div id="pepe2">
    <div class="container ">
       
        <div class=" col-sm-offset-1">
            <h2> Ingrese Sus Datos</h2><br>
                    
        </div>
           
        
            <form class="form-horizontal col-sm-offset-1 " role="form" method="post" action="index.php?/user_controller/CreateUser">
        
            <div class="form-group ">
                <label  class="col-sm-1 control-label">Nombre</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control"  name="name" value="<?php echo set_value('name');?>"  >
                </div>	  	
            </div>
                    
            <div class="form-group ">
                <label  class="col-sm-1 control-label ">Contraseña</label>
                <div class="col-sm-3 ">
                    <input type="password" class="form-control  "  name="password" >
                </div>	  	
                <div class="text-danger"><?php echo form_error('password'); ?></div>
            </div>
                


            
                    
            <div class="form-group ">
                <label  class="col-sm-1 control-label">RNC O Cédula</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control"  name="cedula_rnc" value="<?php echo set_value('cedula_rnc');?>" >
                </div>	  
                 <div class="text-danger"><?php echo form_error('cedula_rnc'); ?></div>
            </div>
               
                    
            <div class="form-group ">
                <label class="col-sm-1 control-label">Dirección</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control"  name="address" value="<?php echo set_value('address');?>" >
                </div>	  	
            </div>
                    
            <div class="form-group ">
                <label  class="col-sm-1 control-label">Ciudad</label>
                <div class="col-sm-3">
                    <select class="form-control"  name="city">   
                        <option selected disabled>Seleccione Una Ciudad</option>
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
                <label class="col-sm-1 control-label">Télefono</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control"  name="phone" value="<?php echo set_value('phone');?>" >
                </div>	  	
            </div>
                    
            <div class="form-group ">
                <label  class="col-sm-1 control-label">Correo</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control"  name="email" value="<?php echo set_value('email');?>" >
                </div>	  	
               <div class="text-danger"><?php echo form_error('email'); ?></div>
            </div>
                
                    
            <div class="form-group ">
                <label  class="col-sm-1 control-label">Tipo</label>
                <div class="col-sm-3">
                    <select class="form-control"  name="flag">   
                        <option selected disabled>Seleccione un tipo</option>
                           <option value=0>Vendedor</option>
                           <option value=1>Mecanico</option>;
                           
                    </select>  
                </div>	  	
            </div>
                    
                    
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-10">
                    <button type="submit" class="btn btn-default">Create</button>
                </div>
            </div>
                   
        </form>
                
                <div class="col-sm-offset-2 text-danger">
	  	 <?php
                    echo "<b>".$var."</b>";               
                ?>
                    </div>
    </div>
    
</div>