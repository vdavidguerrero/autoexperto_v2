<div id="pepe2">
    <div class="container">
        
        
          <div class="col-sm-6"> 
        
        <h2> Informacion</h2><b> 
            
            <div class="col-sm-3">
                <ul class='list-group list-unstyled '>
                    <li><b>Nombre</b></li>
                    <li><b>Correo</b></li>
                    <li><b>Telefono</b></li>
                    <li><b>Dirección</b></li>
                     <li><b>Fecha</b></li>
                </ul>
            </div>
                
                
            <div class="col-sm-7">
            <?php
               echo "
                   <ul class='list-group list-unstyled'>
                       <li>".$user->Name."</li>
                       <li>".$user->Email."</li>   
                       <li>".$user->Phone."</li>
                       <li>".$user->Address.", ".$user->City."</li>
                       <li>".$user->Date."</li>
                           
                    </ul>"
                ;
                    
            ?> 
            </div>   
                
    </div>
    
         <div class="col-sm-10"> 
        <h2>Anuncios Activos</h2>
        <table class="table table-striped">
            <thead>
                <tr class='info'>
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
                      
                    <tr class='active'>
                        <td> <a href='/ad_controller/showAd/".$var2->adID."/".$var2->VIN."/".$var2->userID."'>".$var2->Brand." </a></td>
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
        
        <div class="col-sm-10"> 
        <h2>Anuncios Pasado</h2>
        <table class="table table-striped">
            <thead>
                <tr class='warning'>
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
                      
                    <tr class='active'>
                        <td> <a href='/ad_controller/showAd/".$var2->adID."/".$var2->VIN."/".$var2->userID."'>".$var2->Brand." </a></td>
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
</div>