app.controller("formController", function($scope){
		
	
    $scope.loginForm = [
        {
            fieldName:'RNC', name: 'cedula_rnc', field: 'text'
        },    
        {
            fieldName:'Password'    ,name: 'password', field: 'password'
        }       
    ];
    
    if($scope.nombre !== ""){
        $scope.errorMessage = "Está mal";
    }
    else
        $scope.errorMessage = "Está Bien";

});
   