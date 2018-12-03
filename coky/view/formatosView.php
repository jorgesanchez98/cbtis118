<!DOCTYPE html>
<html>
<head>
	<?php include'header.php'; ?>
	<title></title>
</head>
<body>
	<?php include 'asideView.php'; ?>
	<main class="col-md-10 ml-sm-auto col-lg-10 col-xl-10 px-4">
	<div class="d-flex justify-content-between flex-wrap text-white flex-md-nowrap align-items-center pl-5 pt-3 pb-2 mb-3 border-bottom">
			<h1 class="titulo">Formatos</h1>
				</div>
				<div class="container-full">
				<section class="row">
							<button type="button" data-toggle="modal" data-target="#exampleModalCenter"> <i class="fas fa-plus iconButton"></i>Agregar</button>
							<button id="editarFormato"> <i class="fas fa-edit iconButton"></i> Editar</button>
							<button id="borrarFormato"> <i class="fas fa-trash-alt iconButton" ></i> Borrar</button>
							<button> <i class="fas fa-download iconButton"></i>Descargar</button>
							<input class="buscarButton" type="text" name="buscar" placeholder="Buscar">
						</section>
						<section class="row">
							<table class="table">
							  <thead>
							    <tr>
							      <th scope="col">Nombre</th>
							      <th scope="col">Descripción</th>
							    </tr>
							  </thead>
							  <tbody id="table">
							    <?php foreach($allformatos as $formato){?>
							    <tr id="<?php echo $formato->idFormato?>">
							      <td><?php echo $formato->nombre ?></td>
							      <td><?php echo $formato->descripcion ?></td>
							    </tr>
							    <?php } ?>
							</tbody>
							</table>
						</section>
						<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  						<div class="modal-dialog modal-dialog-centered" role="document">
    						<div class="modal-content">
      							<div class="modal-header">
        							<h5 class="modal-title" id="exampleModalLongTitle">Agregar Formato</h5>
        							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
        								<span aria-hidden="true">&times;</span>
      								</button>
    							</div>
    							<div class="modal-body">
       								<form action="<?php echo $helper->url("Formatos", "subirFormato")?>" method="POST" enctype="multipart/form-data">
       									<div class="form-group">
       										<label for="exampleInputEmail1">Nombre</label>
    										<input type="text" class="form-control" name="nombre" aria-describedby="emailHelp">
    									</div>
    									<div class="form-row form-group">
    										<div class="col">
    											<label> Descripción</label>
    											<input type="text" class="form-control" name="descripcion" aria-describedby="emailHelp">
    										</div>
    									</div>
       									<div class="modal-footer">
    										<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        									<input  class="btn btn-primary" type="submit" name="submit" value="Subir">
    									</div>
       								</form>
    							</div>
    						</div>
						</div>	
					</div>
				</div>

		</main>
		<script type="text/javascript" src="view/javascript/functions.js"></script>
	</body>
</html>