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
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js" type="text/javascript" charset="utf-8"></script>

    <script type="text/javascript">
        $("#first-choice").change(function() {
        $("#second-choice").load("index.php?/ad_controller/getModelsByBrand/" + $("#first-choice").val());
         });
    </script>
    </head>
    <body>

        <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        
                    </button>
                    <a class="navbar-brand" href="<?php echo base_url();?>">Auto Experto</a>
                </div>
        
        <?php 
        session_start();
        if($this->session->userdata('logged_in'))
        {
            $sessionInfo = $this->session->userdata('logged_in');
            $id = $sessionInfo['id'];
            echo "
                    <ul class='nav navbar-nav navbar-right'> 
                        <li><a href='index.php?/user_controller/showUser/$id'>Mi Panel</a></li>
                        <li><a href='index.php?/user_controller/userLogOff'>Salir de sesión</a></li>
                    </ul>";  
        }
        else
        {
            echo "  
                    <form class='navbar-form navbar-right' role='form' method='post' action='index.php?/user_controller/userLogin'>
                        <div class='form-group'>
                            <input type='text' placeholder='RNC o Cedula'  name='cedula_rnc' class='form-control'>
                        </div>
                        <div class='form-group'>
                            <input type='password' placeholder='Contraseña'  name='password' class='form-control'>
                        </div>
                        <button type='submit' class='btn btn-success'>Iniciar Sesión</button>
                    </form>"  ; 
        }
        
        ?>
            </div>
        </div>
        <div class="jumbotron text-center">
      
        <h1>Auto Experto</h1>
        <p>Donde Lo Que Ves... Es lo que compras.</p>
      
        </div>
        <div class="container col-sm-offset-1">