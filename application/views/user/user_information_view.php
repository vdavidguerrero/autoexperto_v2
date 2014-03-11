<div id="pepe2">
<div class="container">
    <br><br><br>
 <h1>Información</h1>
     <table class="table table-striped">
        <thead>
            <tr>
                <th>Vendedor</th>
                <th>Dirección</th>
                <th>Telefono</th>
                <th>Email</th>
        </thead>
        <tbody>
            
            <?php
               echo "
                    <tr>
                        <td>".$user->Name."</td>  
                        <td>".$user->Address.", ".$user->City."</td>  
                        <td>".$user->Phone."</td> 
                        <td>".$user->Email."</td> 
                    </tr>
                     ";
             
            ?>
           
        </tbody>
        
        <h1>Anuncios</h1>
    </table>
    
    	  <table class="table table-striped">
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
        <tbody>
            
        
            <?php
            
           
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
            ?>
           
        </tbody>
    </table>
</div>
    </div>