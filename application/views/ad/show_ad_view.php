<div class="container">   
    <div class="col-sm-offset-1">
    <div class="row">
       
        <div class="col-sm-4 thumbnail">
            <img class="img-responsive" src="/assets/img/carro1.jpg" alt="">
        </div>
            
            
            
        <div class="col-sm-7 col-sm-offset-1 "> 
            
            
            
            
            <h2 class="pepito"> Anuncio</h2><b> 
                
                <div class="col-sm-2 ">
                    <ul class='list-group list-unstyled '>
                        <li ><b>Nombre</b></li>
                        <li><b>Correo</b></li>
                        <li><b>Precio</b></li>
                        <li><b>Fecha</b></li>
                        <li><b>Telefono</b></li>
                        <li><b>Dirección</b></li>
                        <li><b>Review</b></li>
                        <li><b>Mileage</b></li>
                        <li><b>Estado DGII</b></li>
                    </ul>
                </div>
                    
                    
                <div class="col-sm-8">
            <?php
               echo "
                   <ul class='list-group list-unstyled'>
                       <li>".$user->Name."</li>
                       <li>".$user->Email."</li>   
                       <li>".number_format($ad->Price)."</li>
                       <li>".$ad->Publish_Date."</li>
                       <li>".$user->Phone."</li>
                       <li>".$user->Address.", ".$user->City."</li>
                        <li>".$ad->Car_Review."</li>
                    <li>".number_format($ad->Mileage)."</li>
             <li>".$ad->Paper_Status."</li>
                    </ul>"
                ;
                    
            ?> 
                </div>   
                    
        </div>
            
            
        <!--            <div class="col-sm-4">
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
                
//                  echo "
//                      
//                      
//        <ul class='list-group list-unstyled '>
//             <li>".$ad->Car_Review."</li>
//             <li>".number_format($ad->Mileage)."</li>
//             <li>".$ad->Paper_Status."</li>
//        </ul>
//            
//                     ";
    
            ?>
                
                
                        </div>     
                    </div>-->
        <div class="row">
        </div> 
        <div class="col-sm-11">
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
                    <tr class='active'>
                        <td>".$k."</td>
                        <td>".$carrito."</td>
                    </tr>
                     ";
                         
            ?>
                
                </tbody>
            </table>
        </div>     
    </div> 
    <div class="row">
        <div class="col-sm-11">
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
              {
                  echo "
                    <tr class='active'>
                        <td>".$carrito->Part."</td>" ;
                            
                            
                    echo "<td>";
                    for($i=0; $i<5; $i++)
                    {
                        if($i < $carrito->Seller_Review)
                           echo " <span class='fa fa-star yellow icon-2x '></span>" ;
                        else 
                           echo " <span class='fa fa-star-o icon-2x'></span>" ;
                               
                    }
                    echo "</td>";
                    echo  "<td>";
                     for($i=0; $i<5; $i++)
                    {
                       if($i < $carrito->Seller_Review-1)
                           echo " <span class='fa fa-star  yellow icon-2x'></span>" ;
                        else 
                           echo " <span class='fa fa-star-o icon-2x'></span>" ;
                               
                    }
                    echo "</td>";
                     echo "</tr>";          
                         
                 }        
            ?>
                
                
                
                
                
                
                </tbody>
            </table>
        </div>
    </div>
        </div>
</div>