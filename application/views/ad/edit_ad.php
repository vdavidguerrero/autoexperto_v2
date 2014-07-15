
<div class="container">
    <?php echo "
            <form class='form-horizontal col-sm-offset-4' role='form' method='post' action='/ad_controller/photoUpload/".$id."/".$vin."' enctype='multipart/form-data'>"; ?>

            <h4> Foto 1</h4><br>
            <input type="file" name="userfile"  />

            <br /><br />
            <h4> Foto 2</h4><br>
            <input type="file" name="userfile2"  />

<?php

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

?>

    <input type="submit" value="upload" class="col-sm-offset-1" />
        </form>

</div>