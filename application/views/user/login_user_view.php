<div class="section gray-light">
    <div id="pepe2" class="container">
        <div class="row">

            <div class=" col-sm-12 col-md-6 col-md-offset-3">
                <div class="block block-shadow block-margin white contact">
    
    <div class=" col-sm-offset-1" style="padding-top: 20px;">
        <h2>Inicia Sesion</h2><br>
        
    </div>
    <form class=" form-horizontal col-sm-offset-1" role="form" method="post" action="/user_controller/userLogin">
        <div ng-app='demo' ng-controller='formController'>
            <div ng-repeat='label in loginForm'>
                <div class="form-group " >
                    <label  class="col-sm-3 control-label">{{label.fieldName}}</label>
                    <div class="col-sm-6">
                        <input type="{{label.field}}" class="form-control" ng-model="nombre" name="{{label.name}}" >
                    </div>	  	
                </div>  
            </div>
        </div>
            
         
        <div class="form-group" style="padding-bottom: 20px;">
            <div class="col-sm-offset-3 col-sm-3">   
                <button type="submit" class="btn btn-default">Entrar</button>
            </div>
        </div>  
            
    </form> 
    <div class="col-sm-offset-2 text-danger">
	  	 <?php
                    echo "<b>".$message."</b>";   
                     echo form_error('cedula_rnc'); 
                ?>
    </div>
</div>
            </div>
        </div>
    </div>
</div>
    