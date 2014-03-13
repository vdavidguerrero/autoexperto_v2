<!DOCTYPE html>
<html lang="en">
    <head>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">

    <title>Auto Experto</title>

    <link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/font-awesome.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/custom.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/slate-bootstrap.min.css') ?>" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
   <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js" type="text/javascript" charset="utf-8"></script>
   
    </head>
    <body>
 
       
          
         <div class="navbar navbar-inverse navbar-fixed-top " role="navigation" >    
           
                <div class="navbar-header">
                  
                    <a class="navbar-brand" href="<?php echo base_url();?>">Auto Experto</a>
                </div>
        
        <?php 
        session_start();
        if($this->session->userdata('logged_in'))
        {
            $sessionInfo = $this->session->userdata('logged_in');
            $id = $sessionInfo['id'];
            echo "
                
                    

                    <ul class='nav navbar-nav navbar-right' > 
                        <li><a href='index.php?/user_controller/showUser/$id'>Mi Panel</a></li>
                        <li><a href='index.php?/user_controller/userLogOff'>Salir de sesión</a></li>
                        <li> <span> -- </span></li>
                    </ul>";  
        }
        else
        {
            echo "
                     <ul class='nav navbar-nav navbar-right' '> 
                        <li><a href='index.php?/user_controller/userLogin'>Iniciar Sesión</a></li>
                        <li><a href='index.php?/user_controller'>Crear Cuenta</a></li>
                         <li> <span> -- </span></li>
                    </ul>

                 
                    
                    "  ;     
        }
        
        ?>
             
             
            
        </div>
        