 <div id="header">
      

    
        <div class="container col-sm-offset-1">
    
    <h2>¿Qué Andas Buscando?</h2>
    
</div>
 
<div class="container">
  
<div class="text-center">
  		
    </div>
	
    <form class="form-horizontal  " role="form" method="post" action="index.php?/ad_controller">
		 <br>
           
                 <div class="form-group ">
                    <label for="inputEmail3" class="col-sm-1 control-label">Ciudad</label>
                    <div class="col-sm-3">
                        <select class="form-control"  name="city">   
                           <option selected disabled>Seleccione Una Ciudad</option>
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
                    <div class="col-sm-3">
                        <select class="form-control  " name="brands" id="first-choice" >
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
                    <label for="inputEmail3" class="col-sm-1 control-label">Modelo</label>
                    <div class="col-sm-3">
                        <select class="form-control  "  name="model" id="second-choice">
                          
                          
                       </select>  
                    </div>	  	
	  	</div>
                 
                
                <div class="form-group ">
                    <label for="inputEmail3" class="col-sm-1 control-label">Tipo</label>
                    <div class="col-sm-3">
                        <select class="form-control"  name="type">
                             <option selected disabled>Seleccione Un Tipo</option>
                            <option value="volvo">Coupe</option>
                            <option value="saab">Sedan</option>
                            <option value="fiat">Jeep</option>
                       </select>  
                    </div>	  	
	  	</div>
                 
                  <div class="form-group ">
                    <label for="inputEmail3" class="col-sm-1 control-label">Precio</label>
                    <div class="col-sm-2" id="pepe">
                        <select class="form-control "  name="lowPrice">
                             <option selected disabled>Mínimo</option>
                            <option value="volvo">100,000</option>
                            <option value="saab">200,000</option>
                            <option value="fiat">300,000</option>
                            <option value="audi">400,000</option>
                       </select>  
                        </div>
                        <div class="col-sm-2" id="pepe">
                        <select class="form-control  " name="highPrice">
                             <option selected disabled>Máximo</option>
                            <option value="volvo">100,000</option>
                            <option value="saab">200,000</option>
                            <option value="fiat">300,000</option>
                            <option value="audi">400,000</option>
                       </select>  
                    </div>  	
	  	</div>
                 
                 
                <div class="form-group ">
                    <label for="inputEmail3" class="col-sm-1 control-label">Año</label>
                   <div class="col-sm-2" id="pepe">
                        <select class="form-control"  name="lowYear">
                             <option selected disabled>Desde</option>
                           
                           <?php
                            foreach ($years as $year)
                           {
                             echo "<option value='volvo'>".$year."</option>";
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
</div>
<script type="text/javascript">
   $(document).ready(function()
{
	$("#second-choice").attr('enabled', 'false'); 
	$("#first-choice").change(function() 
	{
            
           // $.Ajax('/index.php?/ad_controller/showModelsFromABrand/'+ $("#first-choice").val(), 
           // {
           //  onComplete: function(response) 
            // {
             //   if (200 == response.status)
           // }
           // });
            
		$("#second-choice").load("index.php?/ad_controller/showModelsFromABrand/" + $("#first-choice").val()); 
		$("#second-choice").attr('enabled', 'true'); 
	});
});
    
 </script>
 

   