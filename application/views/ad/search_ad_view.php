

<div class="container">
    
    <div class="col-sm-4 ">
        
        <div class="col-md-offset-2">
            <h3>¿Qué Andas Buscando?</h3>
        </div>
        
        <form class="form-horizontal " role="form" method="post" action="/ad_controller/showSearchResults">
            <br>
            
            <div class="form-group "> 
                <label  class="col-md-2">Ciudad</label>
                <div class="dropdown">
                    <div class="col-md-10">
                        <button class="btn btn-sm btn-default col-md-10" id="ciudad"  >Seleccione una Ciudad </button>
                        <button class="btn btn-sm btn-info col-md-2" data-toggle="dropdown" ><span class="caret"></span></button>
                        <ul class="dropdown-menu col-md-12 " id="listaCiudad">
                           <?php
                            foreach ($cities as $city)
                           {
                             echo "<li ><a>".$city->City."</a></li>";
                           }
                           ?>
                        </ul>
                    </div>
                    <input type="hidden" name="city" value="" id="laCiudad">
                </div>   
            </div> 
            
            
            <div class="form-group ">
                <label class="col-md-2 control-label">Marca</label>
                <div class="dropdown">
                    <div class="col-md-10">
                        <button class="btn btn-sm btn-default col-md-10" id="marca"  >Seleccione una Marca </button>
                        <button class="btn btn-sm btn-info col-md-2" data-toggle="dropdown" ><span class="caret"></span></button>
                        <ul class="dropdown-menu col-md-12 " id="listaMarca">
                           <?php
                            foreach ($brands as $brand)
                           {
                             echo "<li><a >".$brand->Brand."</a></li>";
                           }
                           ?>
                        </ul>
                        <input type="hidden" name="brands" value="" id="laMarca">
                    </div>	  
                </div>
            </div>
            
            <div class="form-group ">
                <label  class="col-md-2 control-label">Modelo</label>
                <div class="dropdown">
                    <div class="col-md-10">
                        <button class="btn btn-sm btn-default col-md-10" id="modelo"  >Seleccione Un Modelo</button>
                        <button class="btn btn-sm btn-info col-md-2" data-toggle="dropdown" ><span class="caret"></span></button>
                        <ul class="dropdown-menu col-md-12 " id="listaModelo">
                            
                          
                        </ul>
                         <input type="hidden" name="model" value="" id="elModelo">
                    </div>	  	
                </div>
            </div>
            
            <div class="form-group ">
                <label  class="col-md-2 control-label">Tipo</label>
                <div class="dropdown">
                    <div class="col-md-10">
                        <button class="btn btn-sm btn-default col-md-10" id="tipo"  >Seleccione un Tipo</button>
                        <button class="btn btn-sm btn-info col-md-2" data-toggle="dropdown" ><span class="caret"></span></button>
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
                <label  class="col-md-2 control-label">Precio</label>
                <div class="dropdown">
                    <div class="col-md-5" id="pepe">
                        <button class="btn btn-sm btn-default col-md-9" id="precioDesde"  >Desde </button>
                        <button class="btn btn-sm btn-info col-md-2" data-toggle="dropdown" ><span class="caret"></span></button>
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
                
                <div class="col-md-5" >
                    <button class="btn btn-sm btn-default col-md-9" id="precioHasta"  >Hasta</button>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-info col-md-2" data-toggle="dropdown" ><span class="caret"></span></button>
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
                <label class="col-md-2 control-label">Año</label>
                <div class="dropdown">
                    <div class="col-md-5" >
                        <button class="btn btn-sm btn-default col-md-9" id="anoDesde"  >Desde</button>
                        <button class="btn btn-sm btn-info col-md-2" data-toggle="dropdown" ><span class="caret"></span></button>
                        <ul class="dropdown-menu col-md-12 " id="listaAnoDesde">
                           <?php
                            foreach ($years as $year)
                           {
                             echo "<li value='".$year."'><a >".$year."</a></li>";
                           }
                           ?>
                        </ul>
                        <input type="hidden" name="lowYear" value="" id="elano1">
                    </div>
                </div>  
                <div class="col-md-5" >
                    <button class="btn btn-sm btn-default col-md-9" id="anoHasta"  >Hasta</button>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-info col-md-2" data-toggle="dropdown" ><span class="caret"></span></button>
                        <ul class="dropdown-menu col-md-12 " id="listaAnoHasta">
                           <?php
                            foreach ($years as $year)
                           {
                             echo "<li value='".$year."'><a >".$year."</a></li>";
                           }
                           ?>
                        </ul>
                        <input type="hidden" name="highYear" value="" id="elano2">
                    </div>  	
                </div> 
            </div>   
            
            
            
            <div class="form-group">
                <div class="  col-md-offset-9">
                    <button type="submit" class="btn btn-primary" > Search </button>
                </div>
            </div> 
	  	<?php
                    echo validation_errors();              
                ?>  
        </form>
    </div>
    
    
    
    
    <div class="col-sm-6 col-sm-offset-1">
   <?php
            if(isset($var))
            {
                echo "       

                 <h2> Anuncios Encontrados </h2>

                <table class='table table-striped table-hover'>
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
                    <tbody>"    ;
                        foreach ($adsPreviewData as $adPreviewData)
                            { 
                               echo "
                            <tr class='active'>
                                <td> <a href='/ad_controller/showAd/".$adPreviewData->adID."/".$adPreviewData->VIN."/".$adPreviewData->userID."'>".$adPreviewData->Brand." </a></td>
                                <td>".$adPreviewData->Model." ".$adPreviewData->Body_Style." ".$adPreviewData->Trim. "</td>
                                <td>".$adPreviewData->Year."</td>
                                <td>".number_format($adPreviewData->Price)."</td>
                                <td>".number_format($adPreviewData->Mileage)."</td>
                                <td>".$adPreviewData->City."</td>    
                            </tr>

                             ";
                              
                            }  
                             echo "</tbody> </table></div>   ";
             }
                
               
            ?>
        
    </div >
    
</div >

