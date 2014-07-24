</body>

<footer id="footer">


	<div class="footer-bottom">
		<div class="container">
			<div class="row">
				<div class="col-md-12 clearfix">
					<div class="copyright">
						© Auto Experto<span class="separator">/</span> All rights reserved
					</div><!-- /.pull-left -->

					<ul class="nav nav-pills">
                        <?php
                        if($this->session->userdata('logged_in'))
                        {
                            $sessionInfo = $this->session->userdata('logged_in');
                            $id = $sessionInfo['id'];
                            $flagValue = $sessionInfo['flag'];
                            ?>
                            <li><a href="<?php echo base_url(); ?>">Auto Experto [<?php echo !$flagValue ? 'Vendedor' : 'Mecanico'; ?>]</a></li>
                            <li><a href='/user_controller/showUser/'>Mi Panel</a></li>
                            <li><a href='/user_controller/userLogOff'>Salir de sesión</a></li>
                        <?php
                        }
                        else
                        { ?>
                            <li><a href="/index.html">Auto Experto</a></li>
                            <li><a href='/user_controller/userLogin'>Iniciar Sesión</a></li>
                            <li><a href='/user_controller'>Crear Cuenta</a></li>
                        <?php }
                        ?>
					</ul><!-- /.nav -->
				</div><!-- /.col-md-12 -->
			</div><!-- /.row -->
		</div><!-- /.container -->
	</div><!-- /.footer-bottom -->
</footer>




<script src="/assets/js/jquery.js"></script>
<script src="http://code.jquery.com/jquery-migrate-1.2.1.js"></script>
<script src="/assets/js/jquery.ui.js"></script>
<script src="/assets/js/bootstrap.js"></script>
<script src="/assets/js/cycle.js"></script>
<script src="/assets/js/jquery.bxslider/jquery.bxslider.js"></script>
<script src="/assets/js/easy-tabs/lib/jquery.easytabs.min.js"></script>
<script src="/assets/js/chosen/chosen.jquery.js"></script>
<script src="/assets/js/star-rating/jquery.rating.js"></script>
<script src="/assets/js/colorbox/jquery.colorbox-min.js"></script>
<script src="/assets/js/jslider/bin/jquery.slider.min.js"></script>
<script src="/assets/js/ezMark/js/jquery.ezmark.js"></script>

<script type="text/javascript" src="/assets/js/flot/jquery.flot.js"></script>
<script type="text/javascript" src="/assets/js/flot/jquery.flot.canvas.js"></script>
<script type="text/javascript" src="/assets/js/flot/jquery.flot.resize.js"></script>
<script type="text/javascript" src="/assets/js/flot/jquery.flot.time.js"></script>


<script src="http://maps.googleapis.com/maps/api/js?sensor=true&amp;v=3.13"></script>
<script src="/assets/js/carat.js"></script>


<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.0.7/angular.min.js" type="text/javascript"></script>   
<script src="<?php echo base_url('assets/js/js/app.js') ?>"                        type="text/javascript"></script>        
<script src="<?php echo base_url('assets/js/js/maincontroller.js') ?>"             type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/plugin.js') ?>"                        type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/custom.js') ?>"                        type="text/javascript"></script>


</body>
</html>


