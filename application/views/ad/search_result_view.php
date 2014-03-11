   <div class="container">
    <br><br><br>  
	  <table class="table table-striped">
        <thead>
            <tr>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Ano</th>
                <th>Precio</th>
                <th>Millaje</th>
            </tr>
        </thead>
        <tbody>
            
        
            <?php
            
            echo $var2->adID;
            echo  $var2->VIN;
            echo $var2->userID;
            
              foreach ($var as $var2)
              {
                  
                  echo "
                      <a href='index.php?/ad_controller/showAd/".$var2->adID."/".$var2->VIN."/".$var2->userID.">
                    <tr>
                        <td>".$var2->Brand."</td>
                        <td>".$var2->Model." ".$var2->Body_Style." ".$var2->Trim. "</td>
                        <td>".$var2->Year."</td>
                        <td>".$var2->Price."</td>
                        <td>".$var2->Mileage."</td>
                    </tr>
                      <a>
                     ";
              }  
            ?>
           
        </tbody>
    </table>
    </div>