<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="">
            
        <title>Auto Experto</title>
            
            
         
        <link href="<?php echo base_url('assets/css/font-awesome.min.css') ?>"          rel="stylesheet">
        <link href="<?php echo base_url('assets/css/slate-bootstrap.min.css') ?>"       rel="stylesheet">
        <link href="<?php echo base_url('assets/css/custom.css') ?>"                    rel="stylesheet">
  
    </head>
    <body>
        
        <div class="navbar navbar-inverse navbar-fixed-top " role="navigation" >    
            
            <div class="navbar-header">
                
                
                
        <?php 
        session_start();
        if($this->session->userdata('logged_in'))
        {
            $sessionInfo = $this->session->userdata('logged_in');
            $id = $sessionInfo['id'];
            $flagValue = $sessionInfo['flag'];
                
            echo "<a class='navbar-brand' href='";
                
             echo base_url();
           echo "'>  Auto Experto ";       
               
                       if($flagValue)
                         {
                             echo " - Vendedor";
                            
                         }
                       else
                        {
                            echo " - Mecanico";
                        }
                               
                    echo " </a></div>
                        
                    <ul class='nav navbar-nav navbar-right' > 
                        <li><a href='/user_controller/showUser/".$id."'>Mi Panel</a></li>
                        <li><a href='/user_controller/userLogOff'>Salir de sesión</a></li>
                        <li> <span> -- </span></li>
                    </ul>";  
        }
        else
        {
            echo "<a class='navbar-brand' href='";
            echo base_url();
            echo "'>  Auto Experto   </a></div>
                
                
                     <ul class='nav navbar-nav navbar-right' '> 
                        <li><a href='/user_controller/userLogin'>Iniciar Sesión</a></li>
                        <li><a href='/user_controller'>Crear Cuenta</a></li>
                         <li> <span> -- </span></li>
                    </ul>
                    "  ;     
        }
            
        ?>
            
            
            
            </div>
        
            