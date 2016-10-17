<?php
session_start();
if (isset($_SESSION['name_SupraAdmin'])) {
    ?>
    <!DOCTYPE html>
    <html class="no-js css-menubar" lang="en">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
            <meta name="description" content="bootstrap admin template">
            <meta name="author" content="">
            <title>SupraAdmin | Admin STL-Vision</title>
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
            <link rel="stylesheet" href="plugins/cropper/cropper.css">
            <link rel="stylesheet" href="assets/examples/css/forms/image-cropping.css">
            <link rel="stylesheet" href="plugins/multi-select/multi-select.css">
            <!-- Fonts -->
            <link rel="stylesheet" href="fonts/weather-icons/weather-icons.css">
            <link rel="stylesheet" href="fonts/web-icons/web-icons.min.css">
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
            <script>
                Breakpoints();
            </script>
        </head>
        <body class="dashboard">
            <!--[if lt IE 8]>
                  <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
              <![endif]-->
            <nav class="site-navbar navbar navbar-default navbar-inverse navbar-fixed-top navbar-mega"
                 role="navigation">
                <div class="navbar-header">
                    <div class="navbar-brand navbar-toggle-left site-gridmenu-toggle" data-toggle="gridmenu" style="width: 300px">
                        <img class="navbar-brand-logo" src="assets/images/logo.png" title="Remark">
                        <span class="navbar-brand-text"> <?php echo $_SESSION['NombreEmpresa_SupraAdmin'] ?></span>
                    </div>
                    <button type="button" class="navbar-toggle hamburger hamburger-close navbar-toggle-left hided"
                            data-toggle="menubar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="hamburger-bar"></span>
                    </button>
                    <button type="button" class="navbar-toggle collapsed" data-target="#site-navbar-collapse"
                            data-toggle="collapse">
                        <i class="icon wb-more-horizontal" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="navbar-container container-fluid">
                    <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
                        <div class="navbar-brand navbar-toggle-left site-gridmenu-toggle hidden-xs" data-toggle="gridmenu" style="width: 300px">
                            <img class="navbar-brand-logo" src="assets/images/logo.png" title="Remark">
                            <span class="navbar-brand-text"> <?php echo $_SESSION['NombreEmpresa_SupraAdmin'] ?></span>
                        </div>
                        <ul class="nav navbar-toolbar">
                            <li class="hidden-float" id="toggleMenubar">
                                <a data-toggle="menubar" href="#" role="button">
                                    <i class="icon hamburger hamburger-arrow-left">
                                        <span class="sr-only">Toggle menubar</span>
                                        <span class="hamburger-bar"></span>
                                    </i>
                                </a>
                            </li>
                            <li class="hidden-xs" id="toggleFullscreen">
                                <a class="icon icon-fullscreen" data-toggle="fullscreen" href="#" role="button">
                                    <span class="sr-only">Toggle fullscreen</span>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
                            <li class="dropdown">
                                <a class="navbar-avatar dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false"
                                   data-animation="scale-up" role="button">
                                    <span class="avatar avatar-online">
                                        <img src="../STL-Vision/portraits/5.jpg" alt="...">
                                        <i></i>
                                    </span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li role="presentation">
                                        <a href="javascript:void(0)" onclick="_menu('Perfil', '<?php echo '&' . $_SESSION['parametros_SupraAdmin'] ?>')" role="menuitem"><i class="icon wb-user" aria-hidden="true"></i> Perfil</a>
                                    </li>
                                    <li class="divider" role="presentation"></li>
                                    <li role="presentation">
                                        <a href="javascript:void(0)" id="LogOutLink" onclick="window.location = '../Config/includes/LogIn.php?accion=out_SupraAdmin'" role="menuitem"><i class="icon wb-power" aria-hidden="true"></i> Salir</a>
                                    </li>
                                </ul>
                            </li>
                            <li id="toggleChat">
                                <a data-toggle="site-sidebar" href="javascript:void(0)" title="Chat" data-url="site-sidebar.php?<?php echo date('dmYHis') . '&' . $_SESSION['parametros_SupraAdmin'] ?>">
                                    <i class="icon wb-chat" aria-hidden="true"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="collapse navbar-search-overlap" id="site-navbar-search">
                        <form role="search">
                            <div class="form-group">
                                <div class="input-search">
                                    <i class="input-search-icon wb-search" aria-hidden="true"></i>
                                    <input type="text" class="form-control" name="site-search" placeholder="Search...">
                                    <button type="button" class="input-search-close icon wb-close" data-target="#site-navbar-search" data-toggle="collapse" aria-label="Close"></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </nav>
            <div class="site-menubar">
                <div class="site-menubar-header">
                    <div class="cover overlay">
                        <img class="cover-image" src="assets//examples/images/dashboard-header.jpg" alt="...">
                        <div class="overlay-panel vertical-align overlay-background">
                            <div class="vertical-align-middle">
                                <a class="avatar avatar-lg" href="javascript:void(0)">
                                    <img src="portraits/1.jpg" alt="">
                                </a>
                                <div class="site-menubar-info">
                                    <h5 class="site-menubar-user">Machi</h5>
                                    <p class="site-menubar-email">machidesign@gmail.com</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="site-menubar-body">
                    <div>
                        <div>
                            <ul class="site-menu" id="Lista-Menu">
                                <li class="site-menu-item active" name="Index">
                                    <a class="animsition-link" href="">
                                        <i class="site-menu-icon fa fa-home" style="font-size: 17px" aria-hidden="true"></i>
                                        <span class="site-menu-title">Inicio</span>
                                        <!--<div class="site-menu-label">
                                            <span class="label label-danger label-round">new</span>
                                        </div>-->
                                    </a>
                                </li>
                                <li class="site-menu-item" name="Empresas">
                                    <a class="animsition-link" href="javascript:_menu('Empresas','',0);">
                                        <i class="site-menu-icon fa fa-university" aria-hidden="true"></i>
                                        <span class="site-menu-title">Empresas</span>
                                    </a>
                                </li>
                                <li class="site-menu-item" name="Usuarios">
                                    <a id="moduloUsuarios" data-extra="<?php echo '&' . $_SESSION['parametros_SupraAdmin'] ?>" class="animsition-link" href="javascript:_menu('Usuarios', '<?php echo '&' . $_SESSION['parametros_SupraAdmin'] ?>',0);">
                                        <i class="site-menu-icon fa fa-users" aria-hidden="true"></i>
                                        <span class="site-menu-title">Usuarios</span>
                                    </a>
                                </li>
                                <li class="site-menu-item has-sub">
                                    <a href="javascript:void(0)">
                                        <i class="site-menu-icon fa-file-text-o" aria-hidden="true"></i>
                                        <span class="site-menu-title">Reportes</span>
                                        <span class="site-menu-arrow"></span>
                                    </a>
                                    <ul class="site-menu-sub">
                                        <li class="site-menu-item">
                                            <a href="javascript:_menu('Accesos', '<?php echo '&' . $_SESSION['parametros_SupraAdmin'] ?>',0);">
                                                <span class="site-menu-title">Accesos</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page animsition panel" id="Seccion-Modulos">
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
            <footer class="site-footer">
                <div class="site-footer-legal">© 2016 <a href="#">STL-Vision</a></div>
                <div class="site-footer-right">

                </div>
            </footer>
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
            <script src="plugins/bootstrap-table/bootstrap-table.js"></script>
            <script src="plugins/bootstrap-table/extensions/mobile/bootstrap-table-mobile.js"></script>
            <script src="plugins/cropper/cropper.min.js"></script>
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
            <script>
                                            $(document).ready(function ($) {
                                                Site.run();
                                                setInterval(function () {
                                                    if ($('div.slidePanel').length > 0 && $('div.slidePanel').hasClass('slidePanel-show')) {
                                                        RecargarPanel(new Date().getTime() + '<?php echo '&' . $_SESSION['parametros_SupraAdmin'] ?>');
                                                    }
                                                }, 20000);
                                            });
            </script>
        </body>
    </html>
    <?php
} else {
    header('location: LogIn.php');
}
?>