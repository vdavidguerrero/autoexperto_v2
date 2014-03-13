    

    

<div class="container">
    
    
    <div class="col-sm-4">
        
        
        <h2>¿Qué Andas Buscando?</h2>
        
        <form class="form-horizontal " role="form" method="post" action="index.php?/ad_controller/showSearchResults">
            <br>
            
            <div class="form-group ">
                <label  class="col-sm-2">Ciudad</label>
                <div class="col-sm-10">
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
                <label class="col-sm-2 control-label">Marca</label>
                <div class="col-sm-10">
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
                <label  class="col-sm-2 control-label">Modelo</label>
                <div class="col-sm-10">
                    <select class="form-control  "  name="model" id="second-choice">
                        
                        
                    </select>  
                </div>	  	
            </div>
            
            
            <div class="form-group ">
                <label  class="col-sm-2 control-label">Tipo</label>
                <div class="col-sm-10">
                    <select class="form-control"  name="type">
                        <option selected disabled>Seleccione Un Tipo</option>
                        <option value="Coupe">Coupe</option>
                        <option value="Sedan">Sedan</option>
                        <option value="Jeep">Jeep</option>
                    </select>  
                </div>	  	
            </div>
            
            <div class="form-group ">
                <label  class="col-sm-2 control-label">Precio</label>
                <div class="col-sm-5" id="pepe">
                    <select class="form-control "  name="lowPrice">
                        <option selected disabled>Mínimo</option>
                        <option value="100000">100,000</option>
                        <option value="200000">200,000</option>
                        <option value="300000">300,000</option>
                        <option value="400000">400,000</option>
                    </select>  
                </div>
                <div class="col-sm-5" >
                    
                    <select class="form-control "  name="highPrice">
                        <option selected disabled>Máximo</option>
                        <option value="100000">100,000</option>
                        <option value="200000">200,000</option>
                        <option value="300000">300,000</option>
                        <option value="400000">400,000</option>
                    </select>  
                    
                </div>  	
            </div>
            
            
            <div class="form-group ">
                <label class="col-sm-2 control-label">Año</label>
                <div class="col-sm-5" ">
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
                <div class="col-sm-5" >
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
                <div class=" col-sm-8 col-sm-offset-8">
                    <button type="submit" class="btn btn-default">Search</button>
                </div>
            </div> 
            
	  	<?php
                 // echo $var;
                    echo validation_errors();              
                ?>  
        </form>
        
        
    </div>

    
<div class="col-sm-6 col-sm-offset-1">
   <?php
            if($vaar == 0)
                {
        echo "       
    
         <h2> Anuncios Encontrados </h2>
         
        <table class='table table-striped table-hover'>
            <thead>
                <tr>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Ano</th>
                    <th>Precio</th>
                    <th>Millaje</th>
                    <th>Ciudad</th>
                </tr>
            </thead>
            <tbody>"    ;
                foreach ($var as $var2)
                    { 
                       echo "
                    <tr>
                        <td> <a href='index.php?/ad_controller/showAd/".$var2->adID."/".$var2->VIN."/".$var2->userID."'>".$var2->Brand." </a></td>
                        <td>".$var2->Model." ".$var2->Body_Style." ".$var2->Trim. "</td>
                        <td>".$var2->Year."</td>
                        <td>".number_format($var2->Price)."</td>
                        <td>".number_format($var2->Mileage)."</td>
                        <td>".$var2->City."</td>    
                    </tr>
                        
                     ";
                    }  
                }
                
               
            ?>
                
            </tbody>
        </table>
    </div>    
    
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


