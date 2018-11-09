<!DOCTYPE html>
<html>
<head>
	<?php include'header.php' ?>
	<title></title>
</head>
<body>
	<?php include 'asideView.php' ?>
	<main class="col-md-9 ml-sm-auto col-lg-10 col-xl-10 px-4">
		<div class="d-flex justify-content-between flex-wrap text-white flex-md-nowrap align-items-center pl-5 pt-3 pb-2 mb-3 border-bottom">
					<h1 class="titulo">Mobiliarios</h1>
				</div>
				<section class="row">
							<button> <i class="fas fa-plus iconButton"></i> Agregar</button>
							<button> <i class="fas fa-trash-alt iconButton"></i> Borrar</button>
							<button> <i class="fas fa-edit iconButton"></i> Editar</button>
							<button> <i class="fas fa-download iconButton"></i>Descargar</button>
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
							      <th scope="col">Descripción</th>
							    </tr>
							  </thead>
							  <tbody>
							    <tr>
							      <td>Computadora genérica</td>
							      <td>Uso escolar</td>
							    </tr>
							    <tr>
							      <td>Mesa 2x2</td>
							      <td>Hecha de madera</td>
							    </tr>
							    <tr>
							      <td>Módulo de internet</td>
							      <td>Marca Cisco </td>
							    </tr>
	
							  </tbody>
							</table>
						</section>
					</div>

		</main>
	</body>
</html>