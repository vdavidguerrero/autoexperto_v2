<!doctype html>

<html>

<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Pragmatic Mate s.r.o. - http://pragmaticmates.com">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="#">
    <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css" media="screen, projection">
    <link rel="stylesheet" type="text/css" href="/assets/js/chosen/chosen.min.css" media="screen, projection">
    <link rel="stylesheet" type="text/css" href="/assets/js/pictopro-outline/pictopro-outline.css" media="screen, projection">
    <link rel="stylesheet" type="text/css" href="/assets/js/pictopro-normal/pictopro-normal.css" media="screen, projection">
    <link rel="stylesheet" type="text/css" href="/assets/js/colorbox/colorbox.css" media="screen, projection">
    <link rel="stylesheet" type="text/css" href="/assets/js/jslider/bin/jquery.slider.min.css" media="screen, projection">
    <link rel="stylesheet" type="text/css" href="/assets/css/carat.css" media="screen, projection">
    <link rel="stylesheet" type="text/css" href="/assets/css/carat.css" media="screen, projection">

    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:100,400,700,400italic,700italic" rel="stylesheet" type="text/css"  media="screen, projection">


    <title>Auto Experto</title>
</head>
<body>
  <div class="topbar gray">
	<div class="container">
		<div class="row">
            <div class="col-md-6 col-xs-12 header-top-left">
                
            </div>

            <div class="col-md-6 col-xs-12 header-top-right">
                <div>
                    <div class="social">
                        <div class="inner">
<!--                                <ul class="social-links">-->
<!--                                    <li class="social-icon google-plus"><a href="#">Google+</a></li>-->
<!--                                    <li class="social-icon youtube"><a href="#">YouTube</a></li>-->
<!--                                    <li class="social-icon twitter"><a href="#">Twitter</a></li>-->
<!--                                    <li class="social-icon pinterest"><a href="#">Pinterest</a></li>-->
<!--                                    <li class="social-icon facebook"><a href="#">Facebook</a></li>-->
<!--                                </ul><!-- /.social-links -->
                        </div><!-- /.inner -->
                    </div><!-- /.social -->

                </div>
            </div><!-- /.col-md-5 -->
		</div><!-- /.row -->
	</div><!-- /.container -->
</div><!-- /.topbar -->

<header id="header">
	<div class="header-inner">
		<div class="container">
			<div class="row">
				<div class="col-md-12 clearfix">
					<div class="brand">
						<div class="logo">
							<a href="/">
								<img src="/assets/img/logo1_small.png">
							</a>
						</div><!-- /.logo -->

						<div class="slogan">Expertos en tu vehiculo ideal!</div><!-- /.slogan -->
					</div><!-- /.brand -->
					
					<button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
					    <span class="sr-only">Toggle navigation</span>
					    <span class="icon-bar"></span>
					    <span class="icon-bar"></span>
					    <span class="icon-bar"></span>
					</button>

					<nav class="collapse navbar-collapse navbar-collapse" role="navigation">
                                            <ul class='navigation' >
                                            <?php 
                                            session_start();
                                            if($this->session->userdata('logged_in'))
                                            {
                                                $sessionInfo = $this->session->userdata('logged_in');
                                                $id = $sessionInfo['id'];
                                                $flagValue = $sessionInfo['flag'];
                                            ?>
                                                <li><a class="navbar-brand" href="<?php echo base_url(); ?>">Auto Experto [<?php echo !$flagValue ? 'Vendedor' : 'Mecanico'; ?>]</a></li>
                                                <li><a href='/user_controller/showUser/'>Mi Panel</a></li>
                                                <li><a href='/user_controller/userLogOff'>Salir de sesión</a></li>
                                            <?php
                                            }
                                            else
                                            { ?>
                                                <li><a href="<?php echo base_url(); ?>">Auto Experto</a></li>
                                                <li><a href='/user_controller/userLogin'>Iniciar Sesión</a></li>
                                                <li><a href='/user_controller'>Crear Cuenta</a></li>
                                            <?php }
                                            ?>
                                            </ul>
					</nav>
				</div><!-- /.col-md-12 -->
			</div><!-- /.row -->
		</div><!-- /.container -->
	</div><!-- /.header-inner -->
</header><!-- /#header -->
