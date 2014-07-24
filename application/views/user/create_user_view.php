<div class="section gray-light">
    <div id="pepe2" class="container">
        <div class="row">

            <div class=" col-sm-12 col-md-6 col-md-offset-3">
                <div class="block block-shadow block-margin white contact">

                    <div class=" col-sm-offset-1" style="padding-top: 20px;">
                        <h2>Crea una cuenta</h2><br>
                        <h3 style="margin-top: 0;">Tan solo ingresa tus datos</h3><br>

                    </div>


                    <form class="form-horizontal col-sm-offset-1 " role="form" method="post" action="/user_controller/CreateUser">

                        <div class="form-group ">
                            <label  class="col-sm-3 control-label">Nombre</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control"  name="Name" value="<?php echo set_value('name'); ?>"  >
                            </div>	  	
                        </div>

                        <div class="form-group ">
                            <label  class="col-sm-3 control-label ">Contraseña</label>
                            <div class="col-sm-6 ">
                                <input type="password" class="form-control  "  name="Password" id="passwordCreate" >
                            </div>	  	
                            <div class="text-danger"><?php echo form_error('Password'); ?></div>
                        </div>

                        <div class="form-group ">
                            <label  class="col-sm-3 control-label">RNC O Cédula</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control"  name="ID" id="rnc" value="<?php echo set_value('cedula_rnc'); ?>" >
                            </div>	  
                            <div class="text-danger" id="rncError"><?php echo form_error('ID'); ?></div>
                        </div>


                        <div class="form-group ">
                            <label class="col-sm-3 control-label">Dirección</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control"  name="Address" value="<?php echo set_value('address'); ?>" >
                            </div>	  	
                        </div>

                        <div class="form-group ">
                            <label  class="col-sm-3 control-label">Ciudad</label>
                            <div class="col-sm-6">
                                <select class="form-control"  name="Dominican_Republic_City">   
                                    <option selected disabled>Seleccione Una Ciudad</option>
                                    <?php
                                    foreach ($cities as $city) {
                                        echo "<option value='" . $city->Dominican_Republic_City . "'>" . $city->Dominican_Republic_City . "</option>";
                                    }
                                    ?>
                                </select>  
                            </div>	  	
                        </div>

                        <div class="form-group ">
                            <label class="col-sm-3 control-label">Télefono</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control"  name="Phone" value="<?php echo set_value('phone'); ?>" >
                            </div>	  	
                        </div>

                        <div class="form-group ">
                            <label  class="col-sm-3 control-label">Correo</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control"  name="Email" value="<?php echo set_value('email'); ?>" >
                            </div>	  	
                            <div class="text-danger"><?php echo form_error('Email'); ?></div>
                        </div>


                        <div class="form-group ">
                            <label  class="col-sm-3 control-label">Tipo</label>
                            <div class="col-sm-6">
                                <select class="form-control"  name="Flag">   
                                    <option selected disabled>Seleccione un tipo</option>
                                    <option value=0>Vendedor</option>
                                    <option value=1>Mecanico</option>;

                                </select>  
                            </div>	  	
                        </div>


                        <div class="form-group" style="padding-bottom: 20px;">
                            <div class="col-sm-offset-3 col-sm-30">
                                <button type="submit" class="btn btn-default">Create</button>
                            </div>
                        </div>

                    </form>

                    <div class="col-sm-offset-2 text-danger">
                        <?php
                        echo "<b>" . $message . "</b>";
                        ?>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>