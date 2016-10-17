<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="bootstrap admin template">
  <meta name="author" content="">
  <title>Lockscreen | Remark Admin Template</title>
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
  <link rel="stylesheet" href="assets/examples/css/pages/lockscreen.css">
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
<body class="page-locked layout-full page-dark">
  <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
  <!-- Page -->
  <div class="page animsition vertical-align text-center" data-animsition-in="fade-in"
  data-animsition-out="fade-out">
    <div class="page-content vertical-align-middle">
      <div class="avatar avatar-lg">
        <img src="portraits/3.jpg" alt="...">
      </div>
      <p class="locked-user">Machi</p>
      <form method="post" role="form">
        <div class="input-group">
          <input type="password" class="form-control last" id="inputPassword" name="password"
          placeholder="Enter password">
          <span class="input-group-btn">
            <button type="submit" class="btn btn-primary"><i class="icon wb-unlock" aria-hidden="true"></i>
              <span class="sr-only">unLock</span>
            </button>
          </span>
        </div>
      </form>
      <p>Enter your password to retrieve your session</p>
      <p><a href="login.html">Or sign in as a different user</a></p>
      <footer class="page-copyright page-copyright-inverse">
        <p>WEBSITE BY amazingSurge</p>
        <p>© 2015. All RIGHT RESERVED.</p>
        <div class="social">
          <a href="javascript:void(0)">
            <i class="icon bd-twitter" aria-hidden="true"></i>
          </a>
          <a href="javascript:void(0)">
            <i class="icon bd-facebook" aria-hidden="true"></i>
          </a>
          <a href="javascript:void(0)">
            <i class="icon bd-dribbble" aria-hidden="true"></i>
          </a>
        </div>
      </footer>
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
  <script src="js/components/animate-list.js"></script>
  <script>
  (function(document, window, $) {
    'use strict';
    var Site = window.Site;
    $(document).ready(function() {
      Site.run();
    });
  })(document, window, jQuery);
  </script>
</body>
</html>