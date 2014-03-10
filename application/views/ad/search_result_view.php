   <div class="container">
    <br><br><br>  
	  <table class="table table-striped">
        <thead>
            <tr>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Precio</th>
                <th>Millaje</th>
            </tr>
        </thead>
        <tbody>
            
            <?php
              foreach ($var as $var2)
              {
                  echo "
                    <tr>
                        <td>".$var2->Brand."</td>
                        <td>".$var2->Model." ".$var2->Body_Style." ".$var2->Trim. "</td>
                        <td>".$var2->Price."</td>
                        <td>".$var2->Mileage."</td>
                    </tr>
                     ";
              }  
            ?>
           
        </tbody>
    </table>
    </div>