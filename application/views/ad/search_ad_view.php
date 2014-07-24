<div class="highlighted-wrapper gray">
    <div class="highlighted section">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-3">
                    <div id="overviews">
                        <?php
                        foreach($reviewAds as $adR){
                            echo"
                                <div class='overview active'>
                                    <div class='overview-table'>
                                        <div class='item title'>
                                            <h3>".$adR->Unique_Car->Unique_Model->Brand." ".$adR->Unique_Car->Unique_Model->Model."</h3>
                                            <div class='subtitle'>".$adR->Unique_Car->Unique_Model->Trim."</div>
                                        </div><!-- /.item -->

                                        <div class='item tags'>
                                            <div class='price'>". number_format((float)$adR->Price)."</div>
                                        </div><!-- /.item -->

                                        <div class='item line'>
                                            <span class='property'>Año</span>
                                            <span class='value'>".$adR->Unique_Car->Unique_Model->Year."</span>
                                        </div><!-- /.item -->

                                        <div class='item line'>
                                            <span class='property'>VIN</span>
                                            <span class='value'>".$adR->Unique_Car->VIN."</span>
                                        </div><!-- /.item -->

                                        <div class='item line'>
                                            <span class='property''>Review</span>
                                            <span class='value'>".$adR->Car_Review."</span>
                                        </div><!-- /.item -->

                                        <div class='item line'>
                                            <span class='property'>Millaje</span>
                                            <span class='value'>".number_format((float)$adR->Mileage)."</span>
                                        </div><!-- /.item -->

                                        <div class='item line'>
                                            <span class='property'>Transmision</span>
                                            <span class='value'>".$adR->Unique_Car->Unique_Model->Transmission."</span>
                                        </div><!-- /.item -->
                                    </div><!-- /.overview-table -->
                                </div><!-- /.overview -->
                            ";
                        }
                        ?>

                        <div id="slider-navigation">
                            <div class="prev"></div><!-- /.prev -->
                            <div class="next"></div><!-- /.next -->
                        </div><!-- /.slider-navigation -->
                    </div><!-- /.overviews -->
                </div>


                <div class="col-md-7 col-sm-7">
                    <div id="slider">
                        <?php
                        foreach($reviewAds as $adR)
                        {
                            echo"
                                <div class='slide active'>
                                <a href='#'><img src='/assets/img/".$adR->Pictures[0]->Picture_Path."' alt='#'></a>
                                <div class='color-overlay'></div><!-- /.color-overlay -->
                                </div><!-- /.slide -->
                            ";

                        }


                        ?>
                    </div><!-- /#slider -->
                </div>
            </div><!-- /.row -->
        </div><!-- /.container -->
    </div><!-- /.highligted -->

    <div class="filter-wrapper">
        <div class="container">
            <div class="row">           
                <div class="col-md-3 col-xs-12 pull-right">
                    <div class="filter-block">
                        <div class="block">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#search-sales" data-toggle="tab">¿Que buscas?</a></li>
                            </ul><!-- /.nav -->

                            <div class="content">
                                <div class="inner">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="search-sales">
                                            <form class="form-horizontal " role="form" method="post" action="/ad_controller/showSearchResults">
                                                <div class="row">

                                                    <form class="form-horizontal " role="form" method="post" action="/ad_controller/showSearchResults">
                                                        <br>

                                                        <div class="form-group "> 
                                                            <div class="dropdown">
                                                                <div class="col-md-12">
                                                                    <div class="btn btn-sm btn-default col-md-10 col-xs-10" id="ciudad"  >Seleccione una Ciudad </div>
                                                                    <button class="btn btn-sm btn-info col-md-2 col-xs-2" data-toggle="dropdown" ><span class="caret"></span></button>
                                                                    <ul class="dropdown-menu col-md-12 " id="listaCiudad">
                                                                        <?php
                                                                        foreach ($cities as $city) {
                                                                            echo "<li ><a>" . $city->Dominican_Republic_City . "</a></li>";
                                                                        }
                                                                        ?>
                                                                    </ul>
                                                                </div>
                                                                <input type="hidden" name="city" value="" id="laCiudad">
                                                            </div>   
                                                        </div> 


                                                        <div class="form-group ">
                                                            <div class="dropdown">
                                                                <div class="col-md-12">
                                                                    <div class="btn btn-sm btn-default col-md-10 col-xs-10" id="marca"  >Seleccione una Marca </div>
                                                                    <button class="btn btn-sm btn-info col-md-2 col-xs-2" data-toggle="dropdown" ><span class="caret"></span></button>
                                                                    <ul class="dropdown-menu col-md-12 " id="listaMarca">
                                                                        <?php
                                                                        foreach ($brands as $brand) {
                                                                            echo "<li><a >" . $brand->Brand . "</a></li>";
                                                                        }
                                                                        ?>
                                                                    </ul>
                                                                    <input type="hidden" name="brands" value="" id="laMarca">
                                                                </div>	  
                                                            </div>
                                                        </div>

                                                        <div class="form-group ">
                                                            <div class="dropdown">
                                                                <div class="col-md-12">
                                                                    <div class="btn btn-sm btn-default col-md-10  col-xs-10" id="modelo"  >Seleccione Un Modelo</div>
                                                                    <button class="btn btn-sm btn-info col-md-2  col-xs-2" data-toggle="dropdown" ><span class="caret"></span></button>
                                                                    <ul class="dropdown-menu col-md-12 " id="listaModelo">


                                                                    </ul>
                                                                    <input type="hidden" name="model" value="" id="elModelo">
                                                                </div>	  	
                                                            </div>
                                                        </div>

                                                        <div class="form-group ">
                                                            <div class="dropdown">
                                                                <div class="col-md-12">
                                                                    <div class="btn btn-sm btn-default col-md-10 col-xs-10" id="tipo"  >Seleccione un Tipo</div>
                                                                    <button class="btn btn-sm btn-info col-md-2 col-xs-2" data-toggle="dropdown" ><span class="caret"></span></button>
                                                                    <ul class="dropdown-menu col-md-12 " id="listaTipo">
                                                                        <li ><a  >Sedan</a></li>
                                                                        <li ><a >Coupe</a></li>
                                                                        <li  ><a >Jeep</a></li>
                                                                    </ul>
                                                                    <input type="hidden" name="type" value="" id="elTipo">
                                                                </div>	
                                                            </div>                    
                                                        </div>

                                                        <div class="form-group ">
                                                            <div class="dropdown">
                                                                <div class="col-md-6" id="pepe">
                                                                    <div class="btn btn-sm btn-default col-md-9 col-xs-4" id="precioDesde"  >Desde </div>
                                                                    <button class="btn btn-sm btn-info col-md-3 col-xs-2" data-toggle="dropdown" ><span class="caret"></span></button>
                                                                    <ul class="dropdown-menu col-md-12 " id="listaPrecioDesde">
                                                                        <li><a >100000</a></li>
                                                                        <li><a >200000</a></li>
                                                                        <li><a >300000</a></li>
                                                                        <li><a >400000</a></li>
                                                                        <li><a >500000</a></li>
                                                                    </ul>
                                                                    <input type="hidden" name="lowPrice" value="" id="elprecio1">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6" >
                                                                <div class="btn btn-sm btn-default col-md-9 col-xs-4" id="precioHasta"  >Hasta</div>
                                                                <div class="dropdown">
                                                                    <button class="btn btn-sm btn-info col-md-3 col-xs-2" data-toggle="dropdown" ><span class="caret"></span></button>
                                                                    <ul class="dropdown-menu col-md-12 " id="listaPrecioHasta">
                                                                        <li><a >100000</a></li>
                                                                        <li><a >200000</a></li>
                                                                        <li><a >300000</a></li>
                                                                        <li><a >400000</a></li>
                                                                        <li><a >500000</a></li>
                                                                    </ul>
                                                                    <input type="hidden" name="highPrice" value="" id="elprecio2">
                                                                </div>
                                                            </div>                    
                                                        </div>


                                                        <div class="form-group ">
                                                            <div class="dropdown">
                                                                <div class="col-md-6" >
                                                                    <div class="btn btn-sm btn-default col-md-9 col-xs-4" id="anoDesde"  >Desde</div>
                                                                    <button class="btn btn-sm btn-info col-md-3 col-xs-2" data-toggle="dropdown" ><span class="caret"></span></button>
                                                                    <ul class="dropdown-menu col-md-12 " id="listaAnoDesde">
                                                                        <?php
                                                                        foreach ($years as $year) {
                                                                            echo "<li value='" . $year . "'><a >" . $year . "</a></li>";
                                                                        }
                                                                        ?>
                                                                    </ul>
                                                                    <input type="hidden" name="lowYear" value="" id="elano1">
                                                                </div>
                                                            </div>  
                                                            <div class="col-md-6" >
                                                                <div class="btn btn-sm btn-default col-md-9 col-xs-4" id="anoHasta"  >Hasta</div>
                                                                <div class="dropdown">
                                                                    <button class="btn btn-sm btn-info col-md-3 col-xs-2" data-toggle="dropdown" ><span class="caret"></span></button>
                                                                    <ul class="dropdown-menu col-md-12 " id="listaAnoHasta">
                                                                        <?php
                                                                        foreach ($years as $year) {
                                                                            echo "<li value='" . $year . "'><a >" . $year . "</a></li>";
                                                                        }
                                                                        ?>
                                                                    </ul>
                                                                    <input type="hidden" name="highYear" value="" id="elano2">
                                                                </div>  	
                                                            </div> 
                                                        </div>   
                                                        <?php
                                                        echo validation_errors();
                                                        ?>  

                                                </div><!-- /.row -->

                                                <div class="form-group">
                                                    <button class="send btn btn-primary btn-primary-color">
                                                        Buscar ahora <i class="icon icon-normal-right-arrow-small"></i>
                                                    </button>
                                                </div><!-- /.form-group -->
                                            </form>
                                        </div><!-- /.tab-pane -->
                                    </div><!-- /.tab-content -->
                                </div><!-- /.inner -->
                            </div><!-- /.content -->                                
                        </div><!-- /.block -->
                    </div><!-- /.filter-block -->
                </div><!-- /.col-md-3 -->
            </div><!-- /.row -->
        </div><!-- /.highlighted -->
    </div><!-- /.slider-filter -->
</div><!-- /.highlighted-wrapper -->





















<?php
if (isset($ads)) {
    ?>

    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div id="main">
                <div class="row-block block" id="best-deals">
                    <div class="page-header">
                        <div class="page-header-inner">
                            <div class="heading col-md-9 col-md-offset-2">
                                <h2>Resultados de tu busqueda</h2>
                            </div><!-- /.heading -->

                            <div class="line">
                                <hr/>
                            </div><!-- /.line -->
                        </div><!-- /.page-header-inner -->
                    </div><!-- /.page-header -->


                    <?php
                    foreach ($ads as $ad) {
                        ?>

                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="content white">
                                    <div class="inner">
                                        <div class="row-item">
                                            <div class="inner">
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-5 col-sm-5">
                                                        <div class="picture">
                                                            <div class="image-slider">
                                                                <a href="/ad_controller/showAd/<?php echo $ad->Unique_Car->VIN; ?>/1" class="slide">
                                                                    <?php
                                                                    $p = $ad->Pictures[0];
                                                                    ?>
                                                                    <img src="/assets/img/<?php echo $p->Picture_Path; ?>" alt="#">
                                                                </a><!-- /.slide -->

                                                                <div class="cycle-pager"></div><!-- /.cycle-pager -->
                                                            </div><!-- /.image-slider -->
                                                        </div><!-- /.picture -->
                                                    </div><!-- /.col-md-4 -->

                                                    <div class="col-lg-8 col-md-7 col-sm-7">

                                                        <div class="content-inner">
                                                            <h3>
                                                                <a href='/ad_controller/showAd/<?php echo $ad->Unique_Car->VIN; ?>/1'><?php echo $ad->Unique_Car->Unique_Model->Brand; ?> <?php echo $ad->Unique_Car->Unique_Model->Model; ?></a>
                                                            </h3>
                                                            <div class="subtitle"><?php echo $ad->Unique_Car->Unique_Model->Body_Style . " " . $ad->Unique_Car->Unique_Model->Trim; ?></div><!-- /.subtitle -->

                                                            <div class="price">RD$ <?php echo number_format((float) $ad->Price); ?></div><!-- /.price -->

                                                            <div class="description">
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu vulputate neque. Fusce hendrerit fermentum elementum.</p>
                                                            </div><!-- /.description -->

                                                            <div class="meta">
                                                                <ul>
                                                                    <li>
                                                                        <i class="icon icon-normal-dashboard"></i> <?php echo $ad->Unique_Car->Unique_Model->Year; ?> </li>
                                                                    <li>
                                                                        <i class="icon icon-normal-car-door"></i> <?php echo $ad->Seller->Dominican_Republic_City; ?> </li>
                                                                    <li>
                                                                        <i class="icon icon-normal-cog-wheel"></i> <?php echo number_format((float) $ad->Mileage); ?>  </li>
                                                                </ul>
                                                            </div><!-- /.meta -->
                                                        </div><!-- /.content-inner -->
                                                    </div><!-- /.col-md-8 -->
                                                </div><!-- /.row -->
                                            </div><!-- /.inner -->
                                        </div><!-- /.row-item -->

                                    </div><!-- /.inner -->
                                </div><!-- /.content -->
                            </div><!-- /.col-md-12 -->

                        </div><!-- /.row -->

                        <?php
                    }
                    ?>


                </div><!-- /.block -->                    </div><!-- /#main -->
        </div><!-- /.col-md-9 -->


    </div><!-- /.row -->
<?php
} else {
    ?>

    <div class="section gray-light">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-sm-12">
                    <div id="main">
                        <div class="row-block block" id="best-deals">
                            <div class="page-header">
                                <div class="page-header-inner">
                                    <div class="heading">
                                        <h2>Mejores ofertas</h2>
                                    </div><!-- /.heading -->

                                    <div class="line">
                                        <hr/>
                                    </div><!-- /.line -->
                                </div><!-- /.page-header-inner -->
                            </div><!-- /.page-header -->


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="content white">
                                        <div class="inner">
                                        <?php

                                        foreach($lastAds as $ad)
                                        {
                                            echo "
                                            <div class='row-item'>
                                                <div class='inner'>
                                                    <div class='row'>
                                                        <div class='col-lg-4 col-md-5 col-sm-5'>
                                                            <div class='picture'>
                                                                <div class='image-slider'>
                                                                    <a href='detail.html' class='slide'>
                                                                        <img src='/assets/img/".$ad->Pictures[0]->Picture_Path."' alt=''#'>
                                                                    </a><!-- /.slide -->

                                                                    <div class='cycle-pager'></div><!-- /.cycle-pager -->
                                                                </div><!-- /.image-slider -->
                                                            </div><!-- /.picture -->
                                                        </div><!-- /.col-md-4 -->

                                                        <div class='col-lg-8 col-md-7 col-sm-7'>

                                                            <div class='content-inner'>
                                                                <h3>
                                                                    <a href='/ad_controller/showAd/".$ad->Unique_Car->VIN."/1'>".$ad->Unique_Car->Unique_Model->Brand." ".$ad->Unique_Car->Unique_Model->Model." </a>
                                                                </h3>
                                                                <div class='subtitle'>".$ad->Unique_Car->Unique_Model->Body_Style . " " . $ad->Unique_Car->Unique_Model->Trim." </div><!-- /.subtitle -->

                                                                <div class='price'>".number_format((float) $ad->Price)." </div><!-- /.price -->

                                                                <div class='description'>
                                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu vulputate neque. Fusce hendrerit fermentum elementum.</p>
                                                                </div><!-- /.description -->

                                                                <div class='meta'>
                                                                    <ul>
                                                                        <li>
                                                                            <i class='icon icon-normal-dashboard'></i> ".$ad->Unique_Car->Unique_Model->Year."                           </li>
                                                                        <li>
                                                                            <i class='icon icon-normal-car-door'></i> ".$ad->Seller->Dominican_Republic_City."                            </li>
                                                                        <li>
                                                                            <i class='icon icon-normal-cog-wheel'></i> ".number_format((float) $ad->Mileage)."                        </li>
                                                                    </ul>
                                                                </div><!-- /.meta -->
                                                            </div><!-- /.content-inner -->
                                                        </div><!-- /.col-md-8 -->
                                                    </div><!-- /.row -->
                                                </div><!-- /.inner -->
                                            </div><!-- /.row-item -->";
                                        }
                                        ?>

          								</div><!-- /.inner -->
                                    </div><!-- /.content -->
                                </div><!-- /.col-md-12 -->
                            </div><!-- /.row -->
                        </div><!-- /.block -->                    </div><!-- /#main -->
                </div><!-- /.col-md-9 -->

                <div class="col-md-3 col-sm-12">
                    <div class="sidebar">
                        <div id="newsletter" class='block default'><br>
                            <div class="block-inner">
                                <div class="block-title">
                                    <h3>Suscribete al boletin</h3>
                                </div>

                                <form>
                                    <div class="form-group">
                                        <input placeholder="Your e-mail" type="text" name="maker" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <button class="send btn btn-primary btn-primary-color">Suscribirs</button>
                                    </div>
                                </form>
                            </div>
                        </div>                        <div class="latest-reviews block block-shadow white">
                            <div class="block-inner">
                                <div class="block-title">
                                    <h3>Ultimas opiniones</h3>
                                </div><!-- /.block-title -->

                                <div class="inner">
                                    <div class="row">
                                        <div class="item-wrapper col-lg-12 col-md-12 col-sm-4">
                                            <div class="item">
                                                <div class="picture hidden-sm">
                                                    <a href="detail.html">
                                                        <img src="assets/img/review.png" alt="#">
                                                    </a>
                                                </div><!-- /.picture -->

                                                <div class="title">
                                                    <a href="detail.html">Toyota Landcruiser</a>
                                                </div><!-- /.title -->

                                                <div class="date">10/12/2013</div><!-- /.date -->

                                                <div class="description">
                                                    <p>
                                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu vulputate...
                                                    </p>
                                                </div><!-- /.description -->
                                            </div><!-- /.item -->
                                        </div><!-- /.item-wrapper -->

                                        <div class="item-wrapper col-lg-12 col-md-12 col-sm-4">
                                            <div class="item">
                                                <div class="title">
                                                    <a href="detail.html">Toyota RAV</a>
                                                </div><!-- /.title -->

                                                <div class="date">12/12/2013</div><!-- /.date -->

                                                <div class="description">
                                                    <p>
                                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu vulputate...
                                                    </p>
                                                </div><!-- /.description -->
                                            </div><!-- /.item -->	
                                        </div><!-- /.item-wrapper -->

                                        <div class="item-wrapper col-lg-12 col-md-12 col-sm-4">
                                            <div class="item">
                                                <div class="title">
                                                    <a href="detail.html">Toyota 4Runner</a>
                                                </div><!-- /.title -->

                                                <div class="date">20/12/2013</div><!-- /.date -->

                                                <div class="description">
                                                    <p>
                                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu vulputate...
                                                    </p>
                                                </div><!-- /.description -->
                                            </div><!-- /.item -->			
                                        </div><!-- /.item-wrapper -->
                                    </div><!-- /.row -->
                                </div><!-- /.inner -->
                            </div><!-- /.block-inner -->
                        </div><!-- /.block -->                        <div id="random-cars" class="random-cars block block-shadow white">


                        </div><!-- /.block -->                    </div><!-- /.sidebar -->
                </div><!-- /.col-md-3 -->
            </div><!-- /.row -->

            <div id="content-bottom">


                <div class="row">
                    <div class="col-md-12">
                        <div class="features-block block">
                            <div class="row">
                                <div class="feature">
                                    <div class="col-xs-12 col-md-4 col-sm-4">
                                        <div class="row">
                                            <div class="col-xs-12 col-md-5">
                                                <div class="feature-icon">
                                                    <div class="feature-icon-inverse">
                                                        <i class="icon-outline-currency-dollar"></i>
                                                    </div><!-- /.feature-icon-inverse -->

                                                    <div class="feature-icon-normal">
                                                        <i class="icon-normal-currency-dollar"></i>
                                                    </div><!-- /.feature-icon-normal -->
                                                </div><!-- /.feature-icon -->
                                            </div><!-- /.col-md-5 -->

                                            <div class="col-xs-12 col-md-7">
                                                <h3>Buenos precios</h3>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed neque dolor, placerat mattis justo id, convallis porta nulla</p>
                                            </div><!-- /.col-md-7 -->
                                        </div><!-- /.row -->
                                    </div><!-- /.col-md-4 -->
                                </div><!-- /.feature -->

                                <div class="feature">
                                    <div class="col-xs-12 col-md-4 col-sm-4">
                                        <div class="row">
                                            <div class="col-xs-12 col-md-5">
                                                <div class="feature-icon">
                                                    <div class="feature-icon-inverse">
                                                        <i class="icon-outline-car"></i>
                                                    </div><!-- /.feature-icon-inverse -->

                                                    <div class="feature-icon-normal">
                                                        <i class="icon-normal-car"></i>
                                                    </div><!-- /.feature-icon-normal -->
                                                </div><!-- /.feature-icon -->
                                            </div><!-- /.col-md-5 -->

                                            <div class="col-xs-12 col-md-7">
                                                <h3>Data Veridica</h3>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed neque dolor, placerat mattis justo id, convallis porta nulla</p>
                                            </div><!-- /.col-md-7 -->
                                        </div><!-- /.row -->
                                    </div><!-- /.col-md-4 -->
                                </div><!-- /.feature -->

                                <div class="feature">
                                    <div class="col-xs-12 col-md-4 col-sm-4">
                                        <div class="row">
                                            <div class="col-xs-12 col-md-5">
                                                <div class="feature-icon">
                                                    <div class="feature-icon-inverse">
                                                        <i class="icon-outline-car-door"></i>
                                                    </div><!-- /.feature-icon-inverse -->

                                                    <div class="feature-icon-normal">
                                                        <i class="icon-normal-car-door"></i>
                                                    </div><!-- /.feature-icon-normal -->
                                                </div><!-- /.feature-icon -->
                                            </div><!-- /.col-md-5 -->

                                            <div class="col-xs-12 col-md-7">
                                                <h3>Gran Selección</h3>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed neque dolor, placerat mattis justo id, convallis porta nulla</p>
                                            </div><!-- /.col-md-7 -->
                                        </div><!-- /.row -->
                                    </div><!-- /.col-md-4 -->
                                </div><!-- /.feature -->
                            </div><!-- /.row -->
                        </div><!-- /.block -->                    </div><!-- /.col-md-12 -->
                </div><!-- /.row -->
            </div><!-- /#content-bottom -->
        </div><!-- /.container -->
    </div><!-- /.section -->


    <?php
}
?>
