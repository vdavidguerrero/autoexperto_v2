
<div class="container">
    <?php echo "
            <form class='form-horizontal col-sm-offset-4' role='form' method='post' action='/ad_controller/photoUpload/".$id."/".$vin."' enctype='multipart/form-data'>"; ?>

            <h4> Foto 1</h4><br>
            <input type="file" name="userfile"  />

            <br /><br />
            <h4> Foto 2</h4><br>
            <input type="file" name="userfile2"  />

<?php
    if($statitics == 1){
        echo "<h4>Precios sugerido para que el vehículo se venda </h2><br>";
        echo "En 1 Dia ";
        echo number_format(round($first));
        echo "<br>";

        echo "En 15 Dias ";
        echo number_format(round($second));
        echo "<br>";

        echo "En 30 Dias ";
        echo number_format(round($third));
        echo "<br>";

        echo "En 45 Dias ";
        echo number_format(round($fourth));
        echo "<br>";
        echo "<h4> Cambiar Precio?</h4><br>";
        echo "<input type='text' name='price' value='".$ad->Price."'><br>";

    }
    else
    {
        echo "<h4>No hay suficientes datos para estimar un precio</h4>
        <br>";

        echo "<br>";
    }




?>

    <input type="submit" value="Editar" class="col-sm-offset-1" />
        </form>

</div>