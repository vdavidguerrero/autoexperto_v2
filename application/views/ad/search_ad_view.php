 
    
    <h2>¿Qué Andas Buscando?</h2>
    
</div>
 
<div class="container">
  
<div class="text-center">
  		
    </div>
	
    <form class="form-horizontal  " role="form" method="post" action="index.php?/ad_controller">
		 <br>
           
                 <div class="form-group ">
                    <label for="inputEmail3" class="col-sm-1 control-label">Ciudad</label>
                    <div class="col-sm-2">
                        <select class="form-control  ">   
                           <?php
                           echo $thisFile; 
                            foreach ($cities as $city)
                           {
                             echo "<option value='volvo'>".$city->City."</option>";
                           }
                           ?>
                       </select>  
                    </div>	  	
	  	</div>
               
                <div class="form-group ">
                    <label for="inputEmail3" class="col-sm-1 control-label">Marca</label>
                    <div class="col-sm-2">
                        <select class="form-control  " name="brands" id="first-choice">
                           <?php
                            foreach ($brands as $brand)
                           {
                             echo "<option value='".$brand->ID."' >".$brand->Brand."</option>";
                           }
                           ?>
                       </select>  
                    </div>	  	
	  	</div>
                <div class="form-group ">
                    <label for="inputEmail3" class="col-sm-1 control-label">Modelo</label>
                    <div class="col-sm-2">
                        <select class="form-control  " id="second-choice">
                          
                          
                       </select>  
                    </div>	  	
	  	</div>
                 
                
                <div class="form-group ">
                    <label for="inputEmail3" class="col-sm-1 control-label">Tipo</label>
                    <div class="col-sm-2">
                        <select class="form-control  ">
                            <option value="volvo">Coupe</option>
                            <option value="saab">Sedan</option>
                            <option value="fiat">Jeep</option>
                       </select>  
                    </div>	  	
	  	</div>
                 
                  <div class="form-group ">
                    <label for="inputEmail3" class="col-sm-1 control-label">Precio</label>
                    <div class="col-sm-1">
                        <select class="form-control  ">
                            <option value="volvo">100,000</option>
                            <option value="saab">200,000</option>
                            <option value="fiat">300,000</option>
                            <option value="audi">400,000</option>
                       </select>  
                        </div>
                        <div class="col-sm-1">
                        <select class="form-control  ">
                            <option value="volvo">100,000</option>
                            <option value="saab">200,000</option>
                            <option value="fiat">300,000</option>
                            <option value="audi">400,000</option>
                       </select>  
                    </div>  	
	  	</div>
                 
                 
                <div class="form-group ">
                    <label for="inputEmail3" class="col-sm-1 control-label">Año</label>
                    <div class="col-sm-1">
                        <select class="form-control  ">
                           <?php
                            foreach ($years as $year)
                           {
                             echo "<option value='volvo'>".$year."</option>";
                           }
                           ?>
                       </select>  
                        </div>
                        <div class="col-sm-1">
                        <select class="form-control  ">
                            <?php
                            foreach ($years as $year)
                           {
                             echo "<option value='volvo'>".$year."</option>";
                           }
                           ?>
                       </select>  
                    </div>  	
	  	</div> 
             
                 
                 
                 
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-10">
      			<button type="submit" class="btn btn-default">Search</button>
                    </div>
                </div> 
                     
	  	<?php
                 // echo $var;
                    echo validation_errors();              
                ?>
                
    </form>
    
</div>