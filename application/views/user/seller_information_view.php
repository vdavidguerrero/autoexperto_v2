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
                       <li>".$user->Address.", ".$user->Dominican_Republic_City."</li>
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
                
                
              foreach ($activeAds as $activeAd)
              { 
                  echo "
                      
                    <tr class='active'>
                        <td> <a href='/ad_controller/showAd/".$activeAd->Unique_Car->VIN."/0'>".$activeAd->Unique_Car->Unique_Model->Brand." </a></td>
                        <td>".$activeAd->Unique_Car->Unique_Model->Model." ".$activeAd->Unique_Car->Unique_Model->Body_Style." ".$activeAd->Unique_Car->Unique_Model->Trim. "</td>
                        <td>".$activeAd->Unique_Car->Unique_Model->Year."</td>
                        <td>".number_format($activeAd->Price)."</td>
                        <td>".number_format($activeAd->Mileage)."</td>
                        <td>".$user->Dominican_Republic_City."</td>   
                    </tr>
                        
                     ";
              }  
            ?>
                
                </tbody>
            </table>
        </div>
            
        <div class="col-sm-10"> 
            <h2>Anuncios Pendientes</h2>
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
                
                
              foreach ($pendingAds as $pendingAd)
              { 
                  echo "
                      
                    <tr class='active'>
                        <td> <a href='/ad_controller/showAd/".$pendingAd->Unique_Car->VIN."/1'>".$pendingAd->Unique_Car->Unique_Model->Brand." </a></td>
                        <td>".$pendingAd->Unique_Car->Unique_Model->Model." ".$pendingAd->Unique_Car->Unique_Model->Body_Style." ".$pendingAd->Unique_Car->Unique_Model->Trim. "</td>
                        <td>".$pendingAd->Unique_Car->Unique_Model->Year."</td>
                        <td>".number_format($pendingAd->Price)."</td>
                        <td>".number_format($pendingAd->Mileage)."</td>
                        <td>".$user->Dominican_Republic_City."</td>   
                    </tr>
                        
                     ";
              }  
            ?>
                
                </tbody>
            </table>
        </div>
            
        <div class="col-sm-10"> 
            <h2>Anuncios Antiguos</h2>
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
                
                
              foreach ($oldAds as $oldAd)
              { 
                  echo "
                      
                    <tr class='active'>
                        <td> <a href='/ad_controller/showAd/".$oldAd->Unique_Car->VIN."/2'>".$oldAd->Unique_Car->Unique_Model->Brand." </a></td>
                        <td>".$oldAd->Unique_Car->Unique_Model->Model." ".$oldAd->Unique_Car->Unique_Model->Body_Style." ".$oldAd->Unique_Car->Unique_Model->Trim. "</td>
                        <td>".$oldAd->Unique_Car->Unique_Model->Year."</td>
                        <td>".number_format($oldAd->Price)."</td>
                        <td>".number_format($oldAd->Mileage)."</td>
                        <td>".$user->Dominican_Republic_City."</td>   
                    </tr>
                        
                     ";
              }  
            ?>
                
                </tbody>
            </table>
        </div>
    </div>
</div>