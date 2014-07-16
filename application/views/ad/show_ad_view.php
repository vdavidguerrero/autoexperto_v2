

<div class="container">

    <div class="col-sm-offset-1">
        <div class="row">
            
            <div class="col-sm-5 thumbnail ">
                <?php
                echo "<img class='img-responsive nueva' src='/assets/img/".$ad->Pictures[1]->Picture_Path."' alt=''>";
                ?>

            </div>
                
            <div class="col-sm-6  ad_Brief">
                <div class="col-sm-3 ">
                    <ul class='list-group  '>
                        <li class='list-group-item list-group-item-info'><b>Nombre</b></li>
                        <li class='list-group-item list-group-item-info'><b>Telefono</b></li>
                        <li class='list-group-item list-group-item-info'><b>Dirección</b></li>
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
                       <li class='list-group-item list-group-item-default'>".number_format((float)$ad->Price)."</li>



                       <li class='list-group-item list-group-item-default'>".number_format((float)$ad->Mileage)."</li>
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


            <?php


            $sessionInfo = $this->session->userdata('logged_in');
            $flag   = $sessionInfo['flag'];

            if($flag == 0){
                $review1 = 0;
                $review2 = 0;
                $review3 = 0;
                $reviewGeneral = 0;

                foreach($ad->Car_Part_Reviews as $carrito)
                {
                    if($carrito->Type == 1)
                    {
                        $review1 += $carrito->Review;
                    }
                    else if ($carrito->Type == 2)
                    {
                        $review2 += $carrito->Review;
                    }
                    else if($carrito->Type == 3)
                    {
                        $review3 += $carrito->Review;
                    }
                }

                foreach($ad->Car_Part_Reviews as $carrito)
                {
                    $reviewGeneral += $carrito->Review * $carrito->Weight;
                }

//            $reviewGeneral = round(($reviewGeneral/580) * 5);
//
                $review1 = round($review1/16);
//
//
                $review2 = round($review2/16);
//
                $review3 = round($review3/16);

                //580 review 3
            }


            ?>





                
                </tbody>
            </table>
        </div>

        <div class="col-sm-6">
            <table class="table table-striped ">
                <thead>
                    <tr class="info">
                        <th>Sección</th>
                        <th>Review</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                <tr>
                    <td> Carrocería</td>

                    <td>
                        <?php

                       if($flag ==0)
                       {
                           for($i=0; $i<5; $i++)
                           {
                               if($i < $review1)
                                   echo " <span class='fa fa-star yellow fa-2x '></span>" ;
                               else
                                   echo " <span class='fa fa-star-o fa-2x'></span>" ;
                           }
                       }

                        echo "No hay datos.";



                        ?>
                    </td>
                </tr>
                <tr>
                    <td> Interior</td>

                    <td>
                        <?php


                        if($flag ==0)
                        {
                            for($i=0; $i<5; $i++)
                            {
                                if($i < $review2)
                                    echo " <span class='fa fa-star yellow fa-2x '></span>" ;
                                else
                                    echo " <span class='fa fa-star-o fa-2x'></span>" ;
                            }
                        }

                        echo "No hay datos.";

                        ?>
                    </td>
                </tr>
                </tr>
                    <td> Motor/Mantenimeinto</td>

                    <td>
                        <?php


                        if($flag ==0)
                        {
                            for($i=0; $i<5; $i++)
                            {
                                if($i < $review3)
                                    echo " <span class='fa fa-star yellow fa-2x '></span>" ;
                                else
                                    echo " <span class='fa fa-star-o fa-2x'></span>" ;
                            }
                        }

                        echo "No hay datos.";

                        ?>
                    </td>
                </tr>
                <tr>
                    <td> Review General</td>

                    <td>
                        <?php


                        if($flag ==0)
                        {
                            for($i=0; $i<5; $i++)
                            {
                                if($i < $review1)
                                    echo " <span class='fa fa-star yellow fa-2x '></span>" ;
                                else
                                    echo " <span class='fa fa-star-o fa-2x'></span>" ;
                            }
                        }

                        echo "No hay datos.";



                        ?>
                    </td>
                </tr>



                </tbody>
            </table>
        </div>

    </div>


    
    
    </div>
</div>
    