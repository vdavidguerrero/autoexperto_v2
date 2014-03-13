app.controller("formController", function($scope){
		
	
    $scope.loginForm = [
        {
            fieldName:'RNC', name: 'cedula_rnc', field: 'text'
        },    
        {
            fieldName:'Password'    ,name: 'password', field: 'password'
        }       
    ];

});
   