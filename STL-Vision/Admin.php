<?php
session_start();
if (isset($_SESSION['name_admin']) or(isset($_SESSION['name_customer']))) {
	require_once '../Config/conexiones_config.php';
	if(isset($_SESSION['name_admin']))
	{
		
		$parametro =  $_SESSION['parametros_Admin'];
		$generales = '&' . _desordenar($parametro);
		$vehiculos = _desordenar(str_replace('&acc=userPass','',$parametro) . '&acc=Clientes');
		//$notificaciones = _desordenar($parametro . '&acc=Notificaciones');
		//$geocercas = _desordenar($parametro . '&acc=Geocercas');
		$_SESSION['vehiculos']=$vehiculos;
		//$_SESSION['notificaciones']=$notificaciones;
		//$_SESSION['geocercas']=$geocercas;
	}	
	if(isset($_SESSION['name_customer']))
	{
		$parametro = 'idcliente=' . $_SESSION['id_customer'];
		$generales = '&' . _desordenar($parametro);
		$vehiculos = _desordenar($parametro . '&acc=Vehiculos');
		$notificaciones = _desordenar($parametro . '&acc=Notificaciones');
		$geocercas = _desordenar($parametro . '&acc=Geocercas');
		$_SESSION['vehiculos']=$vehiculos;
		$_SESSION['notificaciones']=$notificaciones;
		$_SESSION['geocercas']=$geocercas;
	}	
    ?>
    <!DOCTYPE html>
    <html class="no-js css-menubar" lang="en">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
            <meta name="description" content="bootstrap admin template">
            <meta name="author" content="">
            <title>Admin | Admin STL-Vision</title>
            <link rel="apple-touch-icon" href="assets/images/apple-touch-icon.png">
            <link rel="shortcut icon" href="assets/images/favicon.ico">
            <!-- Stylesheets -->
            <link rel="stylesheet" href="css/bootstrap.min.css">
            <link rel="stylesheet" href="css/bootstrap-extend.min.css">
            <link rel="stylesheet" href="assets/css/site.min.css">
            <!-- CSS-Personalizados -->
            <link rel="stylesheet" href="css/STL-Vision.css">
            <!-- Plugins -->
            <link rel="stylesheet" href="plugins/animsition/animsition.css">
            <link rel="stylesheet" href="plugins/asscrollable/asScrollable.css">
            <link rel="stylesheet" href="plugins/switchery/switchery.css">
            <link rel="stylesheet" href="plugins/intro-js/introjs.css">
            <link rel="stylesheet" href="plugins/slidepanel/slidePanel.css">
            <link rel="stylesheet" href="plugins/flag-icon-css/flag-icon.css">
            <link rel="stylesheet" href="assets/examples/css/pages/profile.css">
            <link rel="stylesheet" href="plugins/ladda-bootstrap/ladda.css">
            <link rel="stylesheet" href="assets/examples/css/uikit/buttons.css">
            <link rel="stylesheet" href="plugins/alertify-js/alertify.css">
            <link rel="stylesheet" href="assets/examples/css/advanced/alertify.css">
            <link rel="stylesheet" href="plugins/formvalidation/formValidation.css">
            <link rel="stylesheet" href="assets/examples/css/forms/validation.css">
            <link rel="stylesheet" href="assets/examples/css/uikit/modals.css">
            <link rel="stylesheet" href="plugins/bootstrap-table/bootstrap-table.css">
            <link rel="stylesheet" href="plugins/jquery-wizard/jquery-wizard.css">
            <link rel="stylesheet" href="plugins/cropper/cropper.css">
            <link rel="stylesheet" href="assets/examples/css/forms/image-cropping.css">
            <link rel="stylesheet" href="plugins/multi-select/multi-select.css">
			
            <!-- Fonts -->
            <link rel="stylesheet" href="fonts/weather-icons/weather-icons.css">
            <link rel="stylesheet" href="fonts/web-icons/web-icons.min.css">
            <link rel="stylesheet" href="fonts/octicons/octicons.min.css">
            <link rel="stylesheet" href="fonts/font-awesome/font-awesome.min.css">
            <link rel="stylesheet" href="fonts/brand-icons/brand-icons.min.css">
            <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>
            <!--[if lt IE 9]>
              <script src="plugins/html5shiv/html5shiv.min.js"></script>
              <![endif]-->
            <!--[if lt IE 10]>
              <script src="plugins/media-match/media.match.min.js"></script>
              <script src="plugins/respond/respond.min.js"></script>
              <![endif]-->
            <!-- Scripts -->
            <script src="plugins/modernizr/modernizr.js"></script>
            <script src="plugins/breakpoints/breakpoints.js"></script>
			  <!-- Scripts GEOIP -->
            <script>
                Breakpoints();
            </script>
        </head>
        <body class="dashboard">
            <!--[if lt IE 8]>
                  <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
              <![endif]-->

            <?php include('header.php');?>           
            <?php include('hmenu.php');?>
			<div id="Mapa-STL2" class="col-md-12" style="height:100%;padding-left:0px"></div>
            <div class="animsition panel" id="Seccion-Modulos">
                <!-- Modal -->
                <div class="modal fade modal-3d-flip-horizontal modal-primary" id="myModal" aria-hidden="true" aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <h4 class="modal-title" id="modal_title">Modal Title</h4>
                            </div>
                            <div class="modal-body" id="modal_body">
                                <p>One fine body…</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

			<!-- AMMN: INput de control de insercion de informacion en el sidebar-->
            <input type="hidden" id="vsidebar" value="0">
            <!-- Core  -->
            <script src="plugins/jquery/jquery.js"></script>
            <script src="plugins/bootstrap/bootstrap.js"></script>
            <script src="plugins/animsition/animsition.js"></script>
            <script src="plugins/asscroll/jquery-asScroll.js"></script>
            <script src="plugins/mousewheel/jquery.mousewheel.js"></script>
            <script src="plugins/asscrollable/jquery.asScrollable.all.js"></script>
            <script src="plugins/ashoverscroll/jquery-asHoverScroll.js"></script>
            <!-- Plugins -->
            <script src="plugins/switchery/switchery.min.js"></script>
            <script src="plugins/intro-js/intro.js"></script>
            <script src="plugins/screenfull/screenfull.js"></script>
            <script src="plugins/slidepanel/jquery-slidePanel.js"></script>
            <script src="plugins/skycons/skycons.js"></script>
            <script src="plugins/aspieprogress/jquery-asPieProgress.min.js"></script>
            <script src="plugins/matchheight/jquery.matchHeight-min.js"></script>
            <script src="plugins/jquery-placeholder/jquery.placeholder.js"></script>
            <script src="plugins/ladda-bootstrap/spin.js"></script>
            <script src="plugins/ladda-bootstrap/ladda.js"></script>
            <script src="plugins/formvalidation/formValidation.min.js"></script>
            <script src="plugins/formvalidation/framework/bootstrap.min.js"></script>
            <script src="js/plugins/selectable.js"></script>
            <script src="plugins/alertify-js/alertify.js"></script>
            <script src="../Config/includes/general.js"></script>
            <script src="../Config/includes/sesion.js"></script>
            <script src="plugins/bootstrap-table/bootstrap-table.js"></script>
            <script src="plugins/bootstrap-table/extensions/mobile/bootstrap-table-mobile.js"></script>
            <script src="plugins/jquery-wizard/jquery-wizard.js"></script>
            <script src="plugins/cropper/cropper.js"></script>
            <script src="plugins/multi-select/jquery.multi-select.js"></script>
            <!-- Scripts -->
            <script src="js/core.js"></script>
            <script src="assets/js/site.js"></script>
            <script src="assets/js/sections/menu.js"></script>
            <script src="assets/js/sections/menubar.js"></script>
            <script src="assets/js/sections/sidebar.js"></script>
            <script src="js/configs/config-colors.js"></script>
            <script src="assets/js/configs/config-tour.js"></script>
            <script src="js/components/asscrollable.js"></script>
            <script src="js/components/animsition.js"></script>
            <script src="js/components/slidepanel.js"></script>
            <script src="js/components/switchery.js"></script>
            <script src="js/components/matchheight.js"></script>
            <script src="js/components/selectable.js"></script>
            <script src="js/components/ladda-bootstrap.js"></script>
            <script src="js/components/table.js"></script>            
            <script src="js/components/jquery-placeholder.js"></script>
            <script src="js/components/material.js"></script>
            <script src="js/components/panel.js"></script>
            <script src="assets/examples/js/uikit/panel-actions.js"></script>
            <script src="assets/examples/js/tables/bootstrap.js"></script>
			<!-- Google Map JavaScript -->
            <script src="http://maps.googleapis.com/maps/api/js?sensor=false&extension=.js&output=embed&libraries=geometry,drawing"></script>
            <script src="js/google-map.js"></script>
            <!-- Personalizado JavaScript -->
            <script src="js/general.js"></script>
            <!-- isLoading JavaScript -->
            <script src="js/plugins/isLoading.js"></script>
			<script src="js/datepicker.js"></script>
            <script src="js/datepicker-es.js"></script>
			<input type="hidden" id="control_sidebar" value="0">
			<input type="hidden" id="c_sidebar_usuarios" value="">
			<input type="hidden" id="c_sidebar_objetos" value="">
			<input type="hidden" id="c_didebar_geocercas" value="">
			<script src="http://gd.geobytes.com/gd?after=-1&variables=GeobytesCountry,GeobytesCity"></script>
            <script>



			<?php
			if(isset($_SESSION['name_admin']))
			{
				?> 
				////////////////////////Operaciones SIdebar usuario Final/////////////////////////////////// 
				function init_sidebar()
				{
					setInterval(function () 
					{
                        if ($('div.slidePanel').length > 0 && $('div.slidePanel').hasClass('slidePanel-show'))  ///
						{
							_Recargar('Vehiculos');
						}	
                    }, 30000);
					setInterval(function () 
					{
                        if ($('div.slidePanel').length > 0 && $('div.slidePanel').hasClass('slidePanel-show'))  ///
						{
							_Recargar('Geocercas');
						}	
                    }, 60000);
				
				}	
				function _Recargar(modelo)
				{
				var x=$('#control_sidebar').val();
                if (modelo === 'Notificaciones')
					_CargarNotificacionesAdmin('<?php echo $notificaciones ?>',x);
                if (modelo === 'Vehiculos')
					_CargarVehiculosAdmin('<?php echo $vehiculos ?>',x);
                if (modelo === 'Geocercas') 
                     _CargarGeocercasAdmin('<?php echo $geocercas ?>',x);
				$('#control_sidebar').val('1');	 
				}    
				////////////////////////////////////////////////////////////////////////////////////////////
				<?php
			}
			if(isset($_SESSION['name_customer']))
			{
				?> 
				////////////////////////Operaciones SIdebar usuario Final/////////////////////////////////// 
				function init_sidebar()
				{
					setInterval(function () 
					{
                        if ($('div.slidePanel').length > 0 && $('div.slidePanel').hasClass('slidePanel-show'))  ///
						{
							_Recargar('Vehiculos');
						}	
                    }, 10000);
					setInterval(function () 
					{
                        if ($('div.slidePanel').length > 0 && $('div.slidePanel').hasClass('slidePanel-show'))  ///
						{
							_Recargar('Geocercas');
						}	
                    }, 60000);
				}	
				////////////////////////////////////////////////////////////////////////////////////////////
				function _Recargar(modelo)
				{
				var x=$('#control_sidebar').val();
                if (modelo === 'Notificaciones')
					_CargarNotificaciones('<?php echo $notificaciones ?>',x);
                if (modelo === 'Vehiculos')
					_CargarVehiculos('<?php echo $vehiculos ?>',x);
                if (modelo === 'Geocercas') 
                     _CargarGeocercas('<?php echo $geocercas ?>',x);
				$('#control_sidebar').val('1');	 
				}    
				<?php
				
			}	 
			?>
			                
			$(document).ready(function ($) 
			{
                Site.run();
				startTime();
				init_sidebar();
				var x =new Date();
				$("#date").val(x);
				$(document).click(function() //Validar session Activa al hacer click
				{
					var Fvieja = new Date($("#date").val());
					var Fnueva = new Date();
					$("#date").val(Fnueva);
					var segundos = ((Fnueva-Fvieja)/1000);
							if(segundos.toFixed(2)>10)
								ValidarSession(<?php $_SESSION['user_admin'];?>)
				});
            }); 
					/*$(document).ready(function () {
                                    
                                    

                                    $('.Desde').datepicker({
                                        'format': "yyyy/mm/dd",
                                        'enableOnReadonly': true,
                                        'todayHighlight': true,
                                        'language': 'es',
                                        'clearBtn': true,
                                        'endDate': "2d"
                                    }).on('changeDate', function (e) {
                                        var dd, mm, yyyy, startDate, endDate, today = new Date(), end;
                                        if ($(this).val() != '') {
                                            dd = e.date.getDate();
                                            mm = e.date.getMonth() + 1;
                                            yyyy = e.date.getFullYear();
                                            endDate = new Date(new Date(yyyy + '/' + mm + '/' + dd).getTime() + (7 * 24 * 3600 * 1000));
                                            startDate = new Date(new Date(yyyy + '/' + mm + '/' + dd).getTime() + (1 * 24 * 3600 * 1000));
                                            if (endDate > today) {
                                                end = today;
                                            } else {
                                                end = endDate;
                                            }
                                        } else {
                                            startDate = null;
                                            end = "2d";
                                        }
                                        $('.Hasta').datepicker('setStartDate', startDate);
                                        $('.Hasta').datepicker('setEndDate', end);
                                    });

                                    $('.Hasta').datepicker({
                                        'format': "yyyy/mm/dd",
                                        'enableOnReadonly': true,
                                        'todayHighlight': true,
                                        'language': 'es',
                                        'clearBtn': true,
                                        'endDate': "0d"
                                    }).on('changeDate', function (e) {
                                        var dd, mm, yyyy, startDate, endDate;
                                        if ($(this).val() != '') {
                                            dd = e.date.getDate();
                                            mm = e.date.getMonth() + 1;
                                            yyyy = e.date.getFullYear();
                                            startDate = new Date(new Date(yyyy + '/' + mm + '/' + dd).getTime() - (7 * 24 * 3600 * 1000));
                                            endDate = new Date(new Date(yyyy + '/' + mm + '/' + dd).getTime() - (1 * 24 * 3600 * 1000));

                                        } else {
                                            startDate = null;
                                            endDate = "0d";
                                        }
                                        $('.Desde').datepicker('setStartDate', startDate);
                                        $('.Desde').datepicker('setEndDate', endDate);
                                    });
                                });*/
            </script>
			<input type="hidden" id="date" value="">
		<script>
			
   
</script>	
<?php

    function objectToArray($d) {
        if (is_object($d)) {
            // Gets the properties of the given object
            // with get_object_vars function
            $d = get_object_vars($d);
        }
 
        if (is_array($d)) {
            /*
            * Return array converted to object
            * Using __FUNCTION__ (Magic constant)
            * for recursive call
            */
            return array_map(__FUNCTION__, $d);
        }
        else {
            // Return array
            return $d;
        }
    }
	   function getIP() {
      foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
         if (array_key_exists($key, $_SERVER) === true) {
            foreach (explode(',', $_SERVER[$key]) as $ip) {
               if (filter_var($ip, FILTER_VALIDATE_IP) !== false) {
                  return $ip;
               }
            }
         } 
      }
   } 
   
   $json = file_get_contents('http://getcitydetails.geobytes.com/GetCityDetails?fqcn='. getIP()); 
   $data = json_decode($json);
	$data2=objectToArray($data);
   echo '<input type="hidden" value="'.$data2['geobyteslatitude'].'" id="lat">';
   echo '<input type="hidden" value="'.$data2['geobyteslongitude'].'" id="lng">';
   echo '</br></br> resolves to:'. var_dump($_SESSION);	  
    ?>
        </body>
    </html>
     <?php
} else {
    header('location: LogIn.php'); 
}
?>