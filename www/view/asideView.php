<aside class="col-md-2 d-none d-md-block sidebar col-lg-2 col-xl-2">
				<div class="row justify-content-md-center">
					<div class="col col-md-6">
					<span class="icon"><i class="fas fa-user"></i></span>
					</div>
					
				</div>

				<nav class="sidebar-sticky">
					<p class="text-white ml-3">Bienvenido usuario <?=$_SESSION["nombre"];?>
					</p>
					<span class="tituloNav">Importar</span>
					<ul class="nav flex-column">
						<li class="nav-item"><a class="nav-link" href="<?php echo $helper->url("Importar","index"); ?>"><i class="fas fa-arrow-circle-up"></i>Calificaciones</a></li>
					</ul>
					<span class="tituloNav">Formatos</span>
					<ul class="nav flex-column">
						<li class="nav-item"><a class="nav-link" href="<?php echo $helper->url("Formatos","index"); ?>"><i class="fas fa-file-alt"></i>Formatos</a></li>
					</ul>
					<span class="tituloNav">Reportes</span>
					<ul class="nav flex-column">
						<li class="nav-item"><a class="nav-link" href="index.php?module=generarReportes"> <i class="fas fa-folder-plus"></i>Generar Reportes</a></li>
						<li class="nav-item"><a class="nav-link" href="index.php?module=graficas"> <i class="fas fa-folder-plus"></i>Generar Graficas</a></li>

					</ul>
					<span class="tituloNav">Inventario</span>
					<ul class="nav flex-column">
						<li class="nav-item"><a class="nav-link" href="<?php echo $helper->url("Inventario","index"); ?>"> <i class="fas fa-file-alt"></i>Inventarios</a></li>
						<li class="nav-item"><a class="nav-link" href="<?php echo $helper->url("Mobiliario","index"); ?>"> <i class="fas fa-file-alt"></i>Mobiliarios</a></li>
					</ul>
					<?php if ($_SESSION["rol"]=="Administracion"):?>
					<span class="tituloNav">Administración</span>
					<ul class="nav flex-column">
						<li class="nav-item"><a class="nav-link" href="<?php echo $helper->url("Usuarios","index"); ?>"> <i class="fas fa-user-alt"></i>Usuarios</a></li>
						<li class="nav-item"><a class="nav-link" href="<?php echo $helper->url("Roles","index"); ?>"> <i class="fas fa-file-alt"></i>Roles</a></li>
					</ul>
					<?php endif; ?>
					<span class="tituloNav">Configuración</span>
					<ul class="nav flex-column">
						<li class="nav-item"><a class="nav-link" href="<?php echo $helper->url("Login","index"); ?>"> <i class="fas fa-sign-out-alt"></i>Salir</a></li>
					</ul>

				</nav>
			</aside>
