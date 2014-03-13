
    
    <div class="container">
        
        <h2> Detalles Vendedor</h2>
           
        <br><br><br>  
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Vendedor</th>
                    <th>Dirección</th>
                    <th>Telefono</th>
                    <th>Email</th>
                    <th>Precio</th>
                    <th>Publicado:</th>
                </tr>
            </thead>
            <tbody>
                
            <?php
               echo "
                    <tr>
                        <td>".$user->Name."</td>  
                        <td>".$user->Address.", ".$user->City."</td>  
                        <td>".$user->Phone."</td> 
                        <td>".$user->Email."</td> 
                        <td>".number_format($ad->Price)."</td> 
                        <td>".$ad->Publish_Date."</td>
                    </tr>
                     ";
                         
            ?>
                
            </tbody>
        </table>
        
        
        
        <h2> Detalles Carro</h2>
           
        <br><br><br>  
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Review</th>
                    <th>Mileage</th>
                    <th>Estado DGII</th>
                </tr>
            </thead>
            <tbody>
                
            <?php
                
                  echo "
                    <tr>
                        <td>".$ad->Car_Review."</td>
                        <td>".number_format($ad->Mileage)."</td>
                        <td>".$ad->Paper_Status."</td>
                    </tr>
                     ";
                         
            ?>
                
            </tbody>
        </table>
        
        
        </table>
           
           
           
        <h2> Detalles Modelo</h2>
           
        <br><br><br>  
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Pieza</th>
                    <th>Descripcion</th>
                    
                </tr>
            </thead>
            <tbody>
                
            <?php
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
        
        <h2> Review Del Carro</h2>
            
        <br><br><br>  
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
