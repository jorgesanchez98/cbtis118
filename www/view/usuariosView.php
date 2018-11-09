<!DOCTYPE html>
<html>
<head>
	<?php include'header.php'; ?>
	<title></title>
</head>
<body>
	<?php include 'asideView.php'; ?>
	<main class="col-md-9 ml-sm-auto col-lg-10 col-xl-10 px-4">
		<div class="d-flex justify-content-between flex-wrap text-white flex-md-nowrap align-items-center pl-5 pt-3 pb-2 mb-3 border-bottom">
					<h1 class="titulo">Usuarios</h1>
				</div>
				<section class="row">
							<button> <i class="fas fa-plus iconButton"></i> Agregar</button>
							<button> <i class="fas fa-trash-alt iconButton"></i> Borrar</button>
							<button> <i class="fas fa-edit iconButton"></i> Editar</button>
							<input class="buscarButton" type="text" name="buscar" placeholder="Buscar">
						</section>
					<div class="container">
						<section class="row mb-3">
							<div class="col col-md-4"></div>
						</section>
						<section class="row">
							<table class="table">
							  <thead>
							    <tr>
							      <th scope="col">Nombre</th>
							      <th scope="col">Apellido Paterno</th>
							      <th scope="col">Apellido Materno</th>
							      <th scope="col">Rol</th>
							    </tr>
							  </thead>
							  <tbody>
							  	<?php foreach($allusers as $user){?>
							    <tr>
							      <td><?php echo $user->nombre ?></td>
							      <td><?php echo $user->paterno ?></td>
							      <td><?php echo $user->materno ?></td>
							      <td><?php echo $this->getRol($user->idRol); ?></td>
							    </tr>
							    <?php } ?>
						</tbody>
					</table>
				</section>
			</div>
		</main>
	</body>
</html>
