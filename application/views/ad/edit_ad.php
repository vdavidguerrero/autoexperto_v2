
<div class="container">
    <?php echo "
            <form class='form-horizontal col-sm-offset-4' role='form' method='post' action='/ad_controller/photoUpload/".$id."/".$vin."' enctype='multipart/form-data'>"; ?>

            <h4> Foto 1</h4>
            <input type="file" name="userfile"  />

            <br />
            <h4> Foto 2</h4>
            <input type="file" name="userfile2"  />


            <br />
            <h4> Foto 3</h4>
            <input type="file" name="nombre"  /><br>

<?php
    if($statitics == 1){
        echo "<h4><b>Precios sugerido para que el vehículo se venda en:</b> </h2><br>";
        echo "<b>1 Dia</b> ";
        echo number_format(round($first));
        echo "<br>";

        echo "<b>15 Dias</b> ";
        echo number_format(round($second));
        echo "<br>";

        echo "<b>30 Dias</b> ";
        echo number_format(round($third));
        echo "<br>";

        echo "<b>45 Dias</b> ";
        echo number_format(round($fourth));
        echo "<br>";
        echo "<h4><b> Desea Cambiar El Precio?</b></h4>";
        echo "<input type='text' name='price' value='".$ad->Price."'><br>";

    }
    else
    {
        echo "<h4 class='text-danger'><b>No hay suficientes datos para estimar un precio</b></h4>
        <br>";
        echo "<input type='hidden' name='price' value='".$ad->Price."'><br>";
        echo "<br>";
    }




?>

    <br><input type="submit" value="Editar" class="col-sm-offset-1" />
        </form>

</div>