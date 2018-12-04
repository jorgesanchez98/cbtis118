<!DOCTYPE html>
<html>
<head>
	<?php include'header.php'; ?>
	<title></title>
</head>
<body>
	<?php include 'asideView.php'; ?>
	<input type="hidden" name="rowColor" id="rowColor" value="1">
	<main class="col-md-9 ml-sm-auto col-lg-10 col-xl-10 px-4" id="main">
	<div class="d-flex justify-content-between flex-wrap text-white flex-md-nowrap align-items-center pl-5 pt-3 pb-2 mb-3 border-bottom">
		<h1 id="titulo">Detalle Calificaciones</h1>
			</div>
				<div class="container-full">

					<section class="row">
						<button id="cargarBaseDatos"> <i class="fas fa-database iconButton"></i> Cargar a Base de Datos</button>
						<button type="button" data-toggle="modal" data-target="#exampleModalCenter"> <i class="fas fa-upload iconButton"></i>Importar</button>
						<button onclick="location.href= 'baseDatos/excel/5be75839705108.44467296.xls'"> <i class="fas fa-download iconButton"></i>Descargar</button>
						<button id="borrar"> <i class="fas fa-trash-alt iconButton"></i> Borrar</button>
						<input class="buscarButton" type="text" name="buscar" placeholder="Buscar">
					</section>
					<section class="row">
						<table class="table" >
							<thead>
							    <tr>
							    	<th scope="col">Nombre</th>
							    	<th scope="col">Tipo</th>
							    	<th scope="col">Fecha de Importación</th>
							    	<th scope="col">Ciclo Escolar</th>
							    </tr>
							</thead>
							<tbody id="table">
							    <?php foreach($allarchivos as $archivo){?>
							    <tr id="<?php echo $archivo->idArchivo?>">
							      <td><?php echo $archivo->nombre ?></td>
							      <td><?php echo $this->getTipoArchivo($archivo->idTipoArchivo) ?></td>
							      <td><?php echo $archivo->fecha ?></td>
							      <td><?php echo $archivo->cicloEscolar ?></td>
							    </tr>
							    <?php } ?>
							</tbody>
						</table>
					</section>
					<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  						<div class="modal-dialog modal-dialog-centered" role="document">
    						<div class="modal-content">
      							<div class="modal-header">
        							<h5 class="modal-title" id="exampleModalLongTitle">Importar Archivo</h5>
        							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
        								<span aria-hidden="true">&times;</span>
      								</button>
    							</div>
    							<div class="modal-body">
       								<form action="<?php echo $helper->url("Importar", "subirArchivo")?>" method="POST" enctype="multipart/form-data">
       									<div class="form-group">
       										<label for="exampleInputEmail1">Nombre de Archivo</label>
    										<input type="text" class="form-control" name="nombre" aria-describedby="emailHelp">
    									</div>
    									<div class="form-row form-group">
    										<div class="col">
    											<label> Ciclo Escolar</label>
    											<input type="text" class="form-control" name="cicloEscolar" aria-describedby="emailHelp">
    										</div>
    										<div class="col">
    											<label> Tipo</label>
    											<select class="form-control" name="tipoArchivo">
    												<option selected value="0"></option>
    												<option value="1"> Detalle Calificación</option>
    											</select>
    										</div>
    									</div>
    									<div class="form-group">
       										<label for="exampleInputEmail1">Elegir Archivo:</label> <br/>
    										<input type="file" name="file">
    									</div>
       									<div class="modal-footer">
    										<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        									<input  class="btn btn-primary" type="submit" name="submit">
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