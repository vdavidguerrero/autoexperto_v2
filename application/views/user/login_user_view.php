
    
<div class="container">
    
    <div class=" col-sm-offset-1">
        <h2>Login</h2><br>
        
    </div>
    <form class=" form-horizontal col-sm-offset-1" role="form" method="post" action="/user_controller/userLogin">
        <div ng-app='demo' ng-controller='formController'>
            <div ng-repeat='label in loginForm'>
                <div class="form-group " >
                    <label  class="col-sm-1 control-label">{{label.fieldName}}</label>
                    <div class="col-sm-3">
                        <input type="{{label.field}}" class="form-control" ng-model="nombre" name="{{label.name}}" >
                    </div>	  	
                </div>  
            </div>
        </div>
            
         
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-1">   
                <button type="submit" class="btn btn-default">Login</button>
            </div>
        </div>  
            
    </form> 
    <div class="col-sm-offset-2 text-danger">
	  	 <?php
                    echo "<b>".$var."</b>";   
                     echo form_error('cedula_rnc'); 
                ?>
    </div>
</div>
    
    