    
    
<div class="container">
    <div class="col-sm-6"> 
        
        <h2> Detalles Vendedor</h2><b> 
            
            <div class="col-sm-3">
                <ul class='list-group list-unstyled '>
                    <li><b>Nombre</b></li>
                    <li><b>Correo</b></li>
                    <li><b>Precio</b></li>
                    <li><b>Fecha</b></li>
                    <li><b>Telefono</b></li>
                    <li><b>Dirección</b></li>
                </ul>
            </div>
                
                
            <div class="col-sm-7">
            <?php
               echo "
                   <ul class='list-group list-unstyled'>
                       <li>".$user->Name."</li>
                       <li>".$user->Email."</li>   
                       <li>".number_format($ad->Price)."</li>
                       <li>".$ad->Publish_Date."</li>
                       <li>".$user->Phone."</li>
                       <li>".$user->Address.", ".$user->City."</li>
                    </ul>"
                ;
                    
            ?> 
            </div>   
                
    </div>
    
    
    <div class="col-sm-6">
        <h2> Detalles Carro</h2>
        
        <div class="col-sm-3">   
            <ul class='list-group list-unstyled '>
                <li><b>Review</b></li>
                <li><b>Mileage</b></li>
                <li><b>Estado DGII</b></li>
            </ul>
        </div>
        <div class="col-sm-5">          
            <?php
                
                  echo "
                      
                      
        <ul class='list-group list-unstyled '>
             <li>".$ad->Car_Review."</li>
             <li>".number_format($ad->Mileage)."</li>
             <li>".$ad->Paper_Status."</li>
        </ul>
            
                     ";
                         
            ?>
                
                
        </div>     
    </div>
  
    <div class="col-sm-8">
        <h2> Detalles Modelo</h2>
            
            
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Pieza</th>
                    <th>Descripcion</th>
                        
                </tr>
            </thead>
            <tbody>
                
            <?php
                
                
              unset($car["ID"]);
              unset($car["Manufacturer_Country_ID"]);
              unset($car["Unique_Model"]);
              unset($car["ID"]);
              unset($car["Date"]);
              unset($car["VIN"]);
                  
                  
              foreach($car as $k => $carrito)
                  echo "
                    <tr>
                        <td>".$k."</td>
                        <td>".$carrito."</td>
                    </tr>
                     ";
                         
            ?>
                
            </tbody>
        </table>
            
    </div> 
    <div class="col-sm-8">
        <h2> Review Del Carro</h2>
            
            
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Pieza</th>
                    <th>Review del Vendedor</th>
                    <th>Review del Mecanico</th>
                        
                </tr>
            </thead>
            <tbody>
                
            <?php
              foreach($parts as $carrito)
                  echo "
                    <tr>
                        <td>".$carrito->Part."</td>
                        <td>".$carrito->Seller_Review."</td>
                        <td>".$carrito->Seller_Review."</td>
                    </tr>
                     ";
                         
            ?>
                
            </tbody>
        </table>
    </div>
</div> 