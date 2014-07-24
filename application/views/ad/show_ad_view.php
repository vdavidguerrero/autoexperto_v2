<div id="content">
    <div id="page-heading">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading">
                        <div class="title">
                            <h1><?php echo $ad->Unique_Car->Unique_Model->Brand . ' ' . $ad->Unique_Car->Unique_Model->Model; ?></h1>
                        </div><!-- /.title -->

                    </div><!-- /.heading -->
                </div><!-- /.col-md-8 -->

            </div><!-- /.row -->
        </div><!-- /.container -->
    </div><!-- /#page-heading -->

    <div class="section gray-light">
        <div class="container">

            <div class="row">
                <div class="col-xs-12 col-sm-10 col-md-10">
                    <div class="action-buttons">
                        <div class="buy-it-now">
                            <div class="label">Por tan solo</div>
                            <div class="price">RD$ <?php echo number_format($ad->Price); ?></div>
                        </div><!-- /.buy-it-now -->
                    </div><!-- /.action-buttons -->
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div id="main">
                        <div class="car car-detail">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div id="gallery-wrapper">
                                                <div class="gallery">
                                                    <?php
                                                    foreach ($ad->Pictures as $p) {
                                                        ;
                                                        ?>
                                                        <div class="slide active">
                                                            <div class="picture-wrapper">
                                                                <img src="/assets/img/<?php echo $p->Picture_Path; ?>" alt="#">
                                                            </div>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>

                                                </div><!-- /.gallery -->

                                                <div id="gallery-pager" class="white block-shadow">
                                                    <div class="prev">
                                                        <i class="icon-normal-left-arrow-small"></i>
                                                    </div>

                                                    <div class="pager">
                                                    </div>

                                                    <div class="next">
                                                        <i class="icon-normal-right-arrow-small"></i>
                                                    </div>
                                                </div><!-- /#gallery-pager -->


                                                <div class="gallery-thumbnails">
                                                    <?php
                                                    $i = 0;
                                                    foreach ($ad->Pictures as $p) {
                                                        ;
                                                        ?>
                                                        <div class="thumbnail-<?php echo $i; ?>">
                                                            <img src="/assets/img/<?php echo $p->Picture_Path; ?>" alt="#">
                                                        </div>
                                                        <?php
                                                        $i++;
                                                    }
                                                    ?>
                                                </div><!-- /.gallery-thumbnails -->

                                            </div> <!-- /#gallery-wrapper -->
                                        </div>
                                    </div>


                                </div>

                                <div class="col-md-6">
                                    <div class="overview">
                                        <div id="tab-container" class="tab-container">

                                            <ul class='nav nav-tabs'>
                                                <li class='tab'><a href="#overview">Generales</a></li>
                                                <li class='tab'><a href="#description">Problemas</a></li>
                                                <li class='tab'><a href="#video">Clasificacion</a></li>
                                            </ul><!-- /.nav-tabs -->

                                            <div class="block white block-shadow">
                                                <div class="block-inner">
                                                    <div id="overview" class="active">
                                                        <div class="row">
                                                            <div class="col-sm-5 col-md-5">
                                                                <div class="actions">
                                                                    <ul>
                                                                        <li>
                                                                            <b>Vendedor</b>
                                                                            <a href="#">
                                                                                <?php echo $ad->Seller->Name; ?>
                                                                            </a>
                                                                        </li>
                                                                        <li>
                                                                            <b>Telefono</b>
                                                                            <a href="#">
                                                                                <?php echo $ad->Seller->Phone; ?>
                                                                            </a>
                                                                        </li>
                                                                        <li>
                                                                            <b>Direccion</b>
                                                                            <a href="#">
                                                                                <?php echo $ad->Seller->Address . ", " . $ad->Seller->Dominican_Republic_City; ?>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div><!-- /.actions-->
                                                                <a class="btn btn-primary" href="#"><i class="icon icon-normal-mail"></i>Contactar vendedor</a>
                                                            </div><!-- /.col-md-5 -->

                                                            <div class="col-sm-7 col-md-7">
                                                                <table class="table">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="property">Chasis</td>
                                                                            <td class="value"><?php echo $ad->Unique_Car->VIN; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="property">Marca</td>
                                                                            <td class="value"><?php echo $ad->Unique_Car->Unique_Model->Brand; ?></td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td class="property">Model</td>
                                                                            <td class="value"><?php echo $ad->Unique_Car->Unique_Model->Model . ' ' . $ad->Unique_Car->Unique_Model->Trim; ?></td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td class="property">Estilo</td>
                                                                            <td class="value"><?php echo $ad->Unique_Car->Unique_Model->Body_Style; ?> </td>
                                                                        </tr>


                                                                        <tr>
                                                                            <td class="property">Fabricado en</td>
                                                                            <td class="value"><?php echo $ad->Unique_Car->Manufacturer_Country; ?></td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td class="property">A&ntilde;o</td>
                                                                            <td class="value"><?php echo $ad->Unique_Car->Unique_Model->Year; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="property">Kilometraje</td>
                                                                            <td class="value"><?php echo number_format((float) $ad->Mileage); ?></td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td class="property">Papeles en orden?</td>
                                                                            <td class="value"><?php echo ($ad->Paper_Status == 'ok' ? 'Si' : 'No'); ?></td>
                                                                        </tr>

                                                                    </tbody>
                                                                </table><!-- /.table -->
                                                            </div><!-- /.col-md-7 -->
                                                        </div><!-- /.row -->
                                                    </div><!-- /#overview -->

                                                    <div id="description">
                                                        <h3>Errores registrados por el sistema</h3>

                                                        <table class="table">
                                                            <?php
                                                            foreach ($ad->Trouble_Codes as $k => $trouble) {
                                                                echo "
                    <tr>
                        <td>Codigo " . $trouble->Trouble_Code . "</td>
                        <td> - " . $trouble->Description . "</td>
                    </tr>
                      ";
                                                            }
                                                            ?>
                                                            </tbody>
                                                        </table>

                                                    </div><!-- /#description -->

                                                    <div id="video">
                                                        <?php
                                                        $sessionInfo = $this->session->userdata('logged_in');
                                                        $flag = $sessionInfo['flag'];

                                                        if ($flag == 0) {
                                                            $review1 = 0;
                                                            $review2 = 0;
                                                            $review3 = 0;
                                                            $reviewGeneral = 0;

                                                            foreach ($ad->Car_Part_Reviews as $carrito) {
                                                                if ($carrito->Type == 1) {
                                                                    $review1 += $carrito->Review;
                                                                } else if ($carrito->Type == 2) {
                                                                    $review2 += $carrito->Review;
                                                                } else if ($carrito->Type == 3) {
                                                                    $review3 += $carrito->Review;
                                                                }
                                                            }

                                                            foreach ($ad->Car_Part_Reviews as $carrito) {
                                                                $reviewGeneral += $carrito->Review * $carrito->Weight;
                                                            }

//            $reviewGeneral = round(($reviewGeneral/580) * 5);
//
                                                            $review1 = round($review1 / 16);
//
//
                                                            $review2 = round($review2 / 16);
//
                                                            $review3 = round($review3 / 16);

                                                            //580 review 3
                                                        }
                                                        ?>
                                                        <table class="table">
                                                            <tr>

                                                                    <td>Review Carrocería</td>
                                                                <div class="col-md-1">
                                                                <td>
                                                                    <?php
                                                                    if ($flag == 0) {
                                                                        for ($i = 0; $i < 5; $i++) {
                                                                            if ($i < $review1)
                                                                                echo " <span class='fa fa-star yellow fa-2x '></span>";
                                                                            else
                                                                                echo " <span class='fa fa-star-o fa-2x'></span>";
                                                                        }
                                                                    }
                                                                    else
                                                                        echo "No hay datos.";
                                                                    ?>
                                                                </td>
                                                                    </div>
                                                            </tr>
                                                            <tr>
                                                                <td>Review Interior</td>

                                                                <td>
                                                                    <?php
                                                                    if ($flag == 0) {
                                                                        for ($i = 0; $i < 5; $i++) {
                                                                            if ($i < $review2)
                                                                                echo " <span class='fa fa-star yellow fa-2x '></span>";
                                                                            else
                                                                                echo " <span class='fa fa-star-o fa-2x'></span>";
                                                                        }
                                                                    }
                                                                    else
                                                                        echo "No hay datos.";
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                            <td> Review  Motor</td>

                                                            <td>
                                                                <?php
                                                                if ($flag == 0) {
                                                                    for ($i = 0; $i < 5; $i++) {
                                                                        if ($i < $review3)
                                                                            echo " <span class='fa fa-star yellow fa-2x '></span>";
                                                                        else
                                                                            echo " <span class='fa fa-star-o fa-2x'></span>";
                                                                    }
                                                                }

                                                                else
                                                                    echo "No hay datos.";
                                                                ?>
                                                            </td>
                                                            <tr>

                                                                <td> Review General</h4></td>

                                                                <td>
                                                                    <?php
                                                                    if ($flag == 0) {
                                                                        for ($i = 0; $i < 5; $i++) {
                                                                            if ($i < $ad->Car_Review)
                                                                                echo " <span class='fa fa-star yellow fa-2x '></span>";
                                                                            else
                                                                                echo " <span class='fa fa-star-o fa-2x'></span>";
                                                                        }
                                                                    }

                                                                    else
                                                                        echo "No hay datos.";
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div><!-- /#video -->
                                                </div><!-- /.block-inner -->
                                            </div><!-- /.block -->
                                        </div><!-- /#tab-container -->
                                    </div><!-- ./overview -->            
                                </div>
                            </div>
                            <div class="block block-shadow white col-sm-12 col-md-12">

                                <h2>Mas detalles</h2>
                                <div class="row">
                                    <div class="col-sm-4 col-md-4">
                                        <ul class="appliances">
                                            <li><span class="dot"></span>Motor <?php echo $ad->Unique_Car->Unique_Model->Engine_Type; ?></li>
                                            <li><span class="dot"></span>Transmision <?php echo $ad->Unique_Car->Unique_Model->Transmission; ?></li>
                                            <li><span class="dot"></span>Tanque de <?php echo $ad->Unique_Car->Unique_Model->Gallons; ?></li>
                                            <li><span class="dot"></span>Consumo en ciudad de <?php echo $ad->Unique_Car->Unique_Model->Fuel_Economy_City; ?></li>
                                            <li><span class="dot"></span>Consumo en carretera de <?php echo $ad->Unique_Car->Unique_Model->Fuel_Economy_Highway; ?></li>
                                        </ul><!-- /.appliances -->
                                    </div><!-- /.col-md-6 -->

                                    <div class="col-sm-4 col-md-4">
                                        <ul class="appliances">
                                            <li><span class="dot"></span>Asientos en <?php echo $ad->Unique_Car->Unique_Model->Seating; ?></li>
                                            <li><span class="dot"></span>Color <?php echo $ad->Unique_Car->Unique_Model->Color; ?></li>
                                            <li><span class="dot"></span><?php echo ($ad->Unique_Car->Unique_Model->ABS_Brake == 'Si' ? 'Tiene' : 'No Tiene'); ?> frenos ABS</li>
                                            <li><span class="dot"></span><?php echo ($ad->Unique_Car->Unique_Model->Driver_Airbag == 'Si' ? 'Tiene' : 'No Tiene'); ?> bolsa de aire conductor</li>
                                            <li><span class="dot"></span><?php echo ($ad->Unique_Car->Unique_Model->Front_Side_Airbag == 'Si' ? 'Tiene' : 'No Tiene'); ?> bolsa de aire copiloto</li>
                                            <li><span class="dot"></span><?php echo ($ad->Unique_Car->Unique_Model->AC == 'Si' ? 'Tiene' : 'No Tiene'); ?> aire acondicionado</li>
                                        </ul><!-- /.appliances -->
                                    </div><!-- /.col-md-6 -->

                                    <div class="col-sm-4 col-md-4">
                                        <ul class="appliances">
                                            <li><span class="dot"></span>El radio es tipo <?php echo $ad->Unique_Car->Unique_Model->Radio; ?></li>
                                            <li><span class="dot"></span><?php echo ($ad->Unique_Car->Unique_Model->CD_Player == 'Si' ? 'Tiene' : 'No Tiene'); ?> CD Player</li>
                                            <li><span class="dot"></span><?php echo ($ad->Unique_Car->Unique_Model->Subwoofer == 'Si' ? 'Tiene' : 'No Tiene'); ?> subwoofer</li>
                                            <li><span class="dot"></span><?php echo ($ad->Unique_Car->Unique_Model->Leather_Seats == 'Si' ? 'Tiene' : 'No Tiene'); ?> asientos en leather</li>
                                            <li><span class="dot"></span><?php echo ($ad->Unique_Car->Unique_Model->Power_Windows == 'Si' ? 'Tiene' : 'No Tiene'); ?> ventanas electricas</li>
                                            <li><span class="dot"></span>Aros en <?php echo $ad->Unique_Car->Unique_Model->Wheels; ?></li>
                                        </ul><!-- /.appliances -->
                                    </div><!-- /.col-md-6 -->
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>