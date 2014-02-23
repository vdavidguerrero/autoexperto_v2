<div class="container">
    <br><br><br>

    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Cedula</th>
            </tr>
        </thead>
        <tbody>
            <?php
                echo "
                <tr>
                    <td>".$var->Name."</td>
                    <td>".$var->Address."</td>
                    <td>".$var->ID."</td>
                </tr> "
            ?>
        </tbody>
    </table>
</div>