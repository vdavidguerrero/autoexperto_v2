   <div class="container">
    
       <h1> Detalles Vendedor</h1>
       
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
                        <td>".$user->Address." ".$var2->DR_City_ID."</td>  
                        <td>".$user->Phone."</td> 
                        <td>".$user->Email."</td> 
                        <td>".$ad->Price."</td> 
                        <td>".$ad->Publish_Date."</td>
                    </tr>
                     ";
             
            ?>
           
        </tbody>
    </table>
       
       
       
       <h1> Detalles Carro</h1>
       
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
                        <td>".$ad->Review."</td>
                        <td>".$ad->Mileage." ".$var2->DR_City_ID."</td>
                        <td>".$ad->Paper_Status."</td>
                    </tr>
                     ";
               
            ?>
           
        </tbody>
    </table>
       
       
       </table>
       
       
       
       <h1> Detalles Modelo</h1>
       
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
    </div>