<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta name="description" content="bootstrap admin template">
        <meta name="author" content="">
        <title>Login | STL-Vision Admin</title>
        <link rel="apple-touch-icon" href="assets/images/apple-touch-icon.png">
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        <!-- Stylesheets -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap-extend.min.css">
        <link rel="stylesheet" href="assets/css/site.min.css">
        <!-- Plugins -->
        <link rel="stylesheet" href="plugins/animsition/animsition.css">
        <link rel="stylesheet" href="plugins/asscrollable/asScrollable.css">
        <link rel="stylesheet" href="plugins/switchery/switchery.css">
        <link rel="stylesheet" href="plugins/intro-js/introjs.css">
        <link rel="stylesheet" href="plugins/slidepanel/slidePanel.css">
        <link rel="stylesheet" href="plugins/flag-icon-css/flag-icon.css">
        <link rel="stylesheet" href="assets/examples/css/pages/login-v2.css">
        <link rel="stylesheet" href="plugins/alertify-js/alertify.css">
        <link rel="stylesheet" href="assets/examples/css/advanced/alertify.css">
        <!-- Fonts -->
        <link rel="stylesheet" href="fonts/web-icons/web-icons.min.css">
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
    <body class="page-login-v2 layout-full page-dark">
        <!--[if lt IE 8]>
              <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
          <![endif]-->
        <!-- Page -->
        <div class="page animsition" data-animsition-in="fade-in" data-animsition-out="fade-out">
            <div class="page-content">
                <div class="page-brand-info">
                    <div class="brand">
                      <!--<img class="brand-img" src="assets/images/logo@2x.png" alt="...">-->
                        <h2 class="brand-text font-size-40">STL-Vision</h2>
                    </div>
                    <p class="font-size-20">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
                <div class="page-login-main">
                    <h3 class="font-size-24">Sign In</h3>
                    <form method="post" action="javascript:LogIn_STL('LogIn-Admin')" autocomplete="off">
                        <div class="form-group form-material floating">
                            <input id="login-username" type="text" class="form-control" name="username" >
                            <label class="floating-label">Username</label>
                        </div>
                        <div class="form-group form-material floating">
                            <input id="login-password" type="password" class="form-control" name="password">
                            <label class="floating-label">Password</label>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Log In</button>
                    </form>
                    <footer class="page-copyright">
                        <p>WEBSITE BY amazingSurge</p>
                        <p>© 2016. All RIGHT RESERVED.</p>
                        <div class="social">
                            <a class="btn btn-icon btn-round social-twitter" href="javascript:void(0)">
                                <i class="icon bd-twitter" aria-hidden="true"></i>
                            </a>
                            <a class="btn btn-icon btn-round social-facebook" href="javascript:void(0)">
                                <i class="icon bd-facebook" aria-hidden="true"></i>
                            </a>
                            <a class="btn btn-icon btn-round social-google-plus" href="javascript:void(0)">
                                <i class="icon bd-google-plus" aria-hidden="true"></i>
                            </a>
                        </div>
                    </footer>
                </div>
            </div>
        </div>
        <!-- End Page -->
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
        <script src="plugins/jquery-placeholder/jquery.placeholder.js"></script>
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
        <script src="js/components/jquery-placeholder.js"></script>
        <script src="js/components/material.js"></script>
        <script src="../Config/includes/general.js"></script>
        <script src="plugins/alertify-js/alertify.js"></script>
        <script>
            (function (document, window, $) {
                'use strict';
                var Site = window.Site;
                $(document).ready(function () {
                    Site.run();
                });
            })(document, window, jQuery);
        </script>
    </body>
</html>