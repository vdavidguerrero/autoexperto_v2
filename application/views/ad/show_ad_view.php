<div class="container">   
    <div class="col-sm-offset-1">
        <div class="row">
            
            <div class="col-sm-5 thumbnail ">
                <img class="img-responsive nueva" src="/assets/img/carro1.jpg" alt="">
            </div>
                
            <div class="col-sm-6  ad_Brief"> 
                <div class="col-sm-3 ">
                    <ul class='list-group  '>
                        <li class='list-group-item list-group-item-info'><b>Nombre</b></li>
                        <li class='list-group-item list-group-item-info'><b>Telefono</b></li>
                        <li class='list-group-item list-group-item-info'><b>Dirección</b></li>
                        <li class='list-group-item list-group-item-info'><b>Precio</b></li>
                        <li class='list-group-item list-group-item-info'><b>Review</b></li>
                        <li class='list-group-item list-group-item-info'><b>Mileage</b></li>
                        <li class='list-group-item list-group-item-info'><b>Papeles</b></li>
                    </ul>
                </div>
                    
                <div class="col-sm-7">
            <?php
               echo "
                   <ul class='list-group list-unstyled'>
                       <li class='list-group-item list-group-item-default'>".$ad->Seller->Name."</li>
                       <li class='list-group-item list-group-item-default'>".$ad->Seller->Phone."</li>
                       <li class='list-group-item list-group-item-default'>".$ad->Seller->Address.", ".$ad->Seller->Dominican_Republic_City."</li>
                       <li class='list-group-item list-group-item-default'>".number_format($ad->Price)."</li>
                       <li class='list-group-item list-group-item-default'>".$ad->Car_Review."</li>
                       <li class='list-group-item list-group-item-default'>".number_format($ad->Mileage)."</li>
                      <li class='list-group-item list-group-item-default'>".$ad->Paper_Status."</li>
                    </ul>"         
            ?> 
                </div>        
            </div>
        </div>     
    </div>
    <div class="row">  
        
        <div class="col-sm-6">
            <table class="table table-striped">
                <thead>
                    <tr class="info">
                        <th>Pieza</th>
                        <th>Descripcion</th>
                    </tr>
                </thead>
                <tbody>
            <?php
                echo
                     "
                        <tr class='active'>
                        <td>Marca</td>
                        <td>".$ad->Unique_Car->Unique_Model->Brand."</td>   
                        </tr>
                         <tr class='active'>
                        <td>Modelo</td>
                        <td>".$ad->Unique_Car->Unique_Model->Model." ".$ad->Unique_Car->Unique_Model->Trim."</td>   
                        </tr>
                         <tr class='active'>
                        <td>Estilo</td>
                        <td>".$ad->Unique_Car->Unique_Model->Body_Style."</td>   
                        </tr>
                         <tr class='active'>
                        <td>Año</td>
                        <td>".$ad->Unique_Car->Unique_Model->Year."</td>   
                        </tr>
                        </tr>
                         <tr class='active'>
                        <td>Frabricado en</td>
                        <td>".$ad->Unique_Car->Manufacturer_Country."</td>   
                        </tr>
                    ";
            ?>
                
                </tbody>
            </table>
        </div>   
        <div class="col-sm-6">
            <table class="table table-striped ">
                <thead>
                    <tr class="info">
                        <th>Trouble Code</th>
                        <th>Descripcion</th>
                    </tr>
                </thead>
                <tbody>
                    
            <?php  
              foreach($ad->Trouble_Codes as $k => $trouble)
              {
                  echo "
                    <tr class='active danger'>
                        <td>".$trouble->Trouble_Code."</td>
                        <td>".$trouble->Description."</td>
                    </tr>
                      ";     
              }
            ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            
            
            <table class="table table-striped ">
                <thead>
                    <tr class="info">
                        <th>Nombre</th>
                        <th>Descripcion</th>
                    </tr>
                </thead>
                <tbody>
            <?php
              echo "  <tr class='active'>
                        <td>Chasis</td>
                        <td>".$ad->Unique_Car->VIN."</td>   
                        </tr>
                         <tr class='active'>
                        <td>Motor</td>
                        <td>".$ad->Unique_Car->Unique_Model->Engine_Type."</td>   
                        </tr>
                         <tr class='active'>
                        <td>Transmision</td>
                        <td>".$ad->Unique_Car->Unique_Model->Transmission."</td>   
                        </tr>
                         <tr class='active'>
                        <td>Tamaño del tanque</td>
                        <td>".$ad->Unique_Car->Unique_Model->Gallons." Galones</td>   
                        </tr>
                        </tr>
                         <tr class='active'>
                        <td>Consumo en Ciudad</td>
                        <td>".$ad->Unique_Car->Unique_Model->Fuel_Economy_City." Galones</td>   
                        </tr>
                        <tr class='active'>
                        <td>Consumo en Carretera</td>
                        <td>".$ad->Unique_Car->Unique_Model->Fuel_Economy_Highway." Galones</td>   
                        </tr>
                         <tr class='active'>
                        <td>Asientos</td>
                        <td>".$ad->Unique_Car->Unique_Model->Seating."</td>   
                        </tr>
                         <tr class='active'>
                        <td>Frenos ABS</td>
                        <td>".$ad->Unique_Car->Unique_Model->ABS_Brake."</td>   
                        </tr>
                         <tr class='active'>
                        <td>Bolsa de Aire Conductor</td>
                        <td>".$ad->Unique_Car->Unique_Model->Driver_Airbag."</td>   
                        </tr>
                        </tr>
                         <tr class='active'>
                        <td>Bolsa de Aire Copiloto</td>
                        <td>".$ad->Unique_Car->Unique_Model->Front_Side_Airbag."</td>   
                        </tr>
                        <td>Aire Acondicionado</td>
                        <td>".$ad->Unique_Car->Unique_Model->AC."</td>   
                        </tr>
                         <tr class='active'>
                        <td>Radio</td>
                        <td>".$ad->Unique_Car->Unique_Model->Radio."</td>   
                        </tr>
                         <tr class='active'>
                        <td>CD_Player</td>
                        <td>".$ad->Unique_Car->Unique_Model->CD_Player."</td>   
                        </tr>
                         <tr class='active'>
                        <td>SubWoofer</td>
                        <td>".$ad->Unique_Car->Unique_Model->Subwoofer."</td>   
                        </tr>
                        </tr>
                         <tr class='active'>
                        <td>Asientos en Piel</td>
                        <td>".$ad->Unique_Car->Unique_Model->Leather_Seats."</td>   
                        </tr>
                        <tr class='active'>
                        <td>Ventanas Electricos</td>
                        <td>".$ad->Unique_Car->Unique_Model->Power_Windows."</td>   
                        </tr>
                         <tr class='active'>
                        <td>Aros</td>
                        <td>".$ad->Unique_Car->Unique_Model->Wheels."</td>   
                        </tr> 
                ";
            ?>
                
                </tbody>
            </table>
        </div>   
    </div>
        
        
    <div class="row">
        <div class="col-sm-4">
            <h2> Review - Carroceria</h2>
                
                
            <table class="table table-striped">
                <thead>
                    <tr class="info">
                        <th>Pieza</th>
                        <th>Review </th>
                       
                            
                    </tr>
                </thead>
                <tbody>

                <?php
                if($ad->Flag == 1)
                {
                    foreach($ad->Car_Part_Reviews as $carrito)
                    {
                        if($carrito->Type == 1)
                        {
                            echo "
                        <tr class='active'>
                            <td>".$carrito->Part."</td>" ;
                            echo "<td>";
                            for($i=0; $i<5; $i++)
                            {
                                if($i < $carrito->Review)
                                    echo " <span class='fa fa-star yellow fa-2x '></span>" ;
                                else
                                    echo " <span class='fa fa-star-o fa-2x'></span>" ;
                            }
                            echo "</td>";
                            echo "</tr>";
                        }
                    }
                }


                ?>


                </tbody>
            </table>
        </div>
        
        <div class="col-sm-4">
            <h2> Review - Interior</h2>
                
                
            <table class="table table-striped">
                <thead>
                    <tr class="info">
                        <th>Pieza</th>
                        <th>Review </th>
                      
                            
                    </tr>
                </thead>
                <tbody>

                <?php
                if($ad->Flag == 1)
                {
                    foreach($ad->Car_Part_Reviews as $carrito)
                    {
                        if($carrito->Type == 2)
                        {
                            echo "
                        <tr class='active'>
                            <td>".$carrito->Part."</td>" ;
                            echo "<td>";
                            for($i=0; $i<5; $i++)
                            {
                                if($i < $carrito->Review)
                                    echo " <span class='fa fa-star yellow fa-2x '></span>" ;
                                else
                                    echo " <span class='fa fa-star-o fa-2x'></span>" ;
                            }
                            echo "</td>";
                            echo "</tr>";
                        }
                    }
                }
                ?>


                </tbody>
            </table>
        </div>
        
        <div class="col-sm-4">
            <h2> Review - Motor</h2>
                
                
            <table class="table table-striped">
                <thead>
                    <tr class="info">
                        <th>Pieza</th>
                        <th>Review </th>
                       
                            
                    </tr>
                </thead>
                <tbody>

                <?php
                if($ad->Flag == 1)
                {
                    foreach($ad->Car_Part_Reviews as $carrito)
                    {
                        if($carrito->Type == 3)
                        {
                            echo "
                        <tr class='active'>
                            <td>".$carrito->Part."</td>" ;
                            echo "<td>";
                            for($i=0; $i<5; $i++)
                            {
                                if($i < $carrito->Review)
                                    echo " <span class='fa fa-star yellow fa-2x '></span>" ;
                                else
                                    echo " <span class='fa fa-star-o fa-2x'></span>" ;
                            }
                            echo "</td>";
                            echo "</tr>";
                        }
                    }
                }
                ?>
                     
                </tbody>
            </table>
        </div>
    
    
    
    
    </div>
</div>
    