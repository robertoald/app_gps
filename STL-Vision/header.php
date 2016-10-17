<nav class="site-navbar navbar navbar-default navbar-inverse navbar-fixed-top navbar-mega"
                 role="navigation">
                <div class="navbar-header">
                    <div class="navbar-brand navbar-toggle-left site-gridmenu-toggle" data-toggle="gridmenu" style="width: 300px">
                        <img class="navbar-brand-logo" src="assets/images/logo.png" title="Remark">
                        <span class="navbar-brand-text"> <?php echo $_SESSION['NombreEmpresa_Admin'] ?></span>
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
                        <div class="navbar-brand navbar-toggle-left site-gridmenu-toggle hidden-xs" data-toggle="gridmenu">
                            <img class="navbar-brand-logo" src="assets/images/logo.png" title="Remark">
                            <span class="navbar-brand-text"> <?php echo $_SESSION['NombreEmpresa_Admin'] ?></span>
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
							
							<a data-toggle="dropdown" href="javascript:void(0)" title="Fecha y Hora" aria-expanded="false" data-animation="scale-up" role="button" style="padding-bottom: 10px; padding-top: 10px;">
							  <i class="icon fa-clock-o" aria-hidden="true"></i><span style="font-weight: bold; float: right; margin-left: 3px; text-align: center;" id="fyh"></span>
							</a>
							
						  </li>
							<li class="dropdown">
							
							<a data-toggle="dropdown" href="javascript:void(0)" title="Notificaciones" aria-expanded="false" data-animation="scale-up" role="button">
							  <i class="icon fa-bell" aria-hidden="true"></i>
							  <span class="badge badge-danger up">5</span>
							</a>
							<ul class="dropdown-menu dropdown-menu-right dropdown-menu-media" role="menu">
							  <li class="dropdown-menu-header" role="presentation">
								<h5>Notificaciones</h5>
								<span class="label label-round label-danger">New 5</span>
							  </li>
							  <li class="list-group" role="presentation">
								<div data-role="container">
								  <div data-role="content">
									<a class="list-group-item" href="javascript:void(0)" role="menuitem">
									  <div class="media">
										<div class="media-left padding-right-10">
										  <i class="icon md-receipt bg-red-600 white icon-circle" aria-hidden="true"></i>
										</div>
										<div class="media-body">
										  <h6 class="media-heading">A new order has been placed</h6>
										  <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">5 hours ago</time>
										</div>
									  </div>
									</a>
								  </div>
								</div>
							  </li>
							  <li class="dropdown-menu-footer" role="presentation">
								<a class="dropdown-menu-footer-btn" href="javascript:void(0)" role="button">
								  <i class="icon fa-bell" aria-hidden="true"></i>
								</a>
								<a href="javascript:void(0)" role="menuitem">
									Ver todas las Notificaciones
								  </a>
							  </li>
							</ul>
						  </li>
							<li class="dropdown">
							<a data-toggle="dropdown" href="javascript:void(0)" title="Mensajes" aria-expanded="true" data-animation="scale-up" role="button">
							  <i class="icon fa-envelope" aria-hidden="true"></i>
							  <span class="badge badge-info up">3</span>
							</a>
							<ul class="dropdown-menu dropdown-menu-right dropdown-menu-media" role="menu">
							  <li class="dropdown-menu-header" role="presentation">
								<h5>Mensajes</h5>
								<span class="label label-round label-info">New 3</span>
							  </li>
							  <li class="list-group scrollable is-enabled scrollable-vertical" role="presentation" style="position: relative;">
								<div data-role="container" class="scrollable-container" style="height: 270px; width: 375px;">
								  <div data-role="content" class="scrollable-content" style="width: 358px;">
									<a class="list-group-item" href="javascript:void(0)" role="menuitem">
									  <div class="media">
										<div class="media-left padding-right-10">
										  <span class="avatar avatar-sm avatar-online">
											<img src="../STL-Vision/portraits/2.jpg" alt="...">
											<i></i>
										  </span>
										</div>
										<div class="media-body">
										  <h6 class="media-heading">Mary Adams</h6>
										  <div class="media-meta">
											<time datetime="2015-06-17T20:22:05+08:00">30 minutes ago</time>
										  </div>
										  <div class="media-detail">Anyways, i would like just do it</div>
										</div>
									  </div>
									</a>
								  </div>
								</div>
							  <div class="scrollable-bar scrollable-bar-vertical scrollable-bar-hide" draggable="false"><div class="scrollable-bar-handle" style="height: 196.5px;"></div></div></li>
							  <li class="dropdown-menu-footer" role="presentation">
								<a class="dropdown-menu-footer-btn" href="javascript:void(0)" role="button">
								  <i class="icon md-settings" aria-hidden="true"></i>
								</a>
								<a href="javascript:void(0)" role="menuitem">
									See all messages
								  </a>
							  </li>
							</ul>
						  </li>
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
                                        <a href="javascript:void(0)" id="LogOutLink" onclick="window.location = '../Config/includes/LogIn.php?accion=out_admin'" role="menuitem"><i class="icon wb-power" aria-hidden="true"></i> Salir</a>
                                    </li>
                                </ul>
                            </li>
							<li id="toggleChat">
                                <a id="Mslide" data-toggle="site-sidebar" href="javascript:void(0)" title="Objetos de Rastreo" data-url="site-sidebar.php?<?php echo date('dmYHis') . '&' . $_SESSION['parametros_Admin'] ?>">
                                    <i class="icon fa-bars" aria-hidden="true"></i>
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