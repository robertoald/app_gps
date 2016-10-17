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
                                    <a class="animsition-link" href="javascript:_menu('Clientes', '<?php echo '&' . $_SESSION['parametros_Admin'] ?>',0);">
                                        <i class="site-menu-icon fa fa-user" aria-hidden="true"></i>
                                        <span class="site-menu-title">Clientes</span>
                                    </a>
                                </li>
								
                                <?php
                                if (isset($_SESSION['tipoUser_admin']) && $_SESSION['tipoUser_admin'] == 2) {
                                    ?>
                                    <li class="site-menu-item has-sub" name="Usuarios">
                                        <a id="moduloUsuarios" data-extra="<?php echo '&' . $_SESSION['parametros_Admin'] ?>" class="animsition-link" href="javascript:_menu('Usuarios', '<?php echo '&' . $_SESSION['parametros_Admin'] ?>',0);">
                                            <i class="site-menu-icon fa fa-users" aria-hidden="true"></i>
                                            <span class="site-menu-title">Usuarios</span>
                                        </a>
                                    </li>
                                    <?php
                                }
                                ?>
                                <li class="site-menu-item has-sub">
                                    <a href="javascript:void(0)">
                                        <i class="site-menu-icon fa-file-text-o" aria-hidden="true"></i>
                                        <span class="site-menu-title">Reportes</span>
                                        <span class="site-menu-arrow"></span>
                                    </a>
                                    <ul class="site-menu-sub">
                                        <li class="site-menu-item hidden-xs">
                                            <a href="javascript:_menu('Accesos', '<?php echo '&' . $_SESSION['parametros_Admin'] ?>',0);">
                                                <span class="site-menu-title">Accesos</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
								<li class="site-menu-item" name="realtime">
                                    <a class="animsition-link" href="javascript:_menu('Realtime', '<?php echo '&' . $_SESSION['parametros_Admin'] ?>',1);">
                                        <i class="site-menu-icon fa fa-globe" aria-hidden="true"></i>
                                        <span class="site-menu-title">RealTime</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>