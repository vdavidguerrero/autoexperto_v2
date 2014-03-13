 
<div class="container">

      <div class="  col-sm-offset-1 row">
            
        <h2>¿Qué Andas Buscando?</h2>
        
    </div>
      
        <form class="form-horizontal  " role="form" method="post" action="index.php?/ad_controller/showSearchResults">
            <br>
                     
            <div class="form-group ">
                <label  class="col-sm-1 control-label">Ciudad</label>
                <div class="col-sm-3">
                    <select class="form-control"  name="city">   
                        <option selected disabled>Seleccione Una Ciudad</option>
                            <?php
                           echo $thisFile; 
                            foreach ($cities as $city)
                           {
                             echo "<option value='".$city->ID."'>".$city->City."</option>";
                           }
                           ?>
                      
                    </select> 
                    
                </div>	  
                
            </div> 
                     
            <div class="form-group ">
                <label class="col-sm-1 control-label">Marca</label>
                <div class="col-sm-3">
                    <select class="form-control  " name="brands" id="first-choice" >
                        <option selected disabled>Seleccione Una Marca</option>
                            <?php
                            foreach ($brands as $brand)
                           {
                             echo "<option value='".$brand->ID."'>".$brand->Brand."</option>";
                           }
                           ?>
                    </select>  
                </div>	  
                        
            </div>
            <div class="form-group ">
                <label  class="col-sm-1 control-label">Modelo</label>
                <div class="col-sm-3">
                        <select class="form-control  "  name="model" id="second-choice">
                            
                            
                    </select>  
                </div>	  	
            </div>
                    
                    
            <div class="form-group ">
                <label  class="col-sm-1 control-label">Tipo</label>
                <div class="col-sm-3">
                    <select class="form-control"  name="type">
                        <option selected disabled>Seleccione Un Tipo</option>
                        <option value="Coupe">Coupe</option>
                        <option value="Sedan">Sedan</option>
                        <option value="Jeep">Jeep</option>
                    </select>  
                </div>	  	
            </div>
                     
            <div class="form-group ">
                <label  class="col-sm-1 control-label">Precio</label>
                <div class="col-sm-2" id="pepe">
                    <select class="form-control "  name="lowPrice">
                        <option selected disabled>Mínimo</option>
                        <option value="100000">100,000</option>
                        <option value="200000">200,000</option>
                        <option value="300000">300,000</option>
                        <option value="400000">400,000</option>
                    </select>  
                </div>
                <div class="col-sm-2" id="pepe">
                    <select class="form-control  " name="highPrice">
                        <option selected disabled>Máximo</option>
                        <option value="100000">100,000</option>
                        <option value="200000">200,000</option>
                        <option value="300000">300,000</option>
                        <option value="400000">400,000</option>
                    </select>  
                </div>  	
            </div>
                    
                    
            <div class="form-group ">
                <label class="col-sm-1 control-label">Año</label>
                <div class="col-sm-2" id="pepe">
                    <select class="form-control"  name="lowYear">
                        <option selected disabled>Desde</option>
                                 
                           <?php
                            foreach ($years as $year)
                           {
                             echo "<option value='".$year."'>".$year."</option>";
                           }
                           ?>
                    </select>  
                </div>
                <div class="col-sm-2" id="pepe">
                    <select class="form-control  "  name="highYear">
                        <option selected disabled>Hasta</option>
                                 
                            <?php
                            foreach ($years as $year)
                           {
                             echo "<option value='".$year."'>".$year."</option>";
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

<script type="text/javascript">
    $(document).ready(function()
    {
        $("#second-choice").attr('enabled', 'false'); 
        $("#first-choice").change(function() 
        {
            
            $("#second-choice").load("index.php?/ad_controller/showAdModels/" + $("#first-choice").val()); 
            $("#second-choice").attr('enabled', 'true'); 
        });
    });
    
</script>
     
     
     