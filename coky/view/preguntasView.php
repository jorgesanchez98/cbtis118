<!DOCTYPE html>
<html>
<head>
	<?php include'header.php'; ?>
	<title></title>
</head>
<body>
	<?php include 'asideView.php'; ?>
	<input type="hidden" name="rowColor" id="rowColor" value="1">
	<input type="hidden" name="idFormato" id="idFormato" value="<?php echo $formato->idFormato ?>">
	<main class="col-md-10 ml-sm-auto col-lg-10 col-xl-10 px-4">
		<section class="row backButton">
			<button id="backButtonPreguntas"> <i class="fas fa-arrow-left"></i></button>
		</section>
	<div class="d-flex flex-wrap flex-md-nowrap align-items-center pl-5 pt-3 pb-2 mb-3 border-bottom">
		
			<h1 class="titulo">Preguntas del formato "<?php echo $formato->nombre ?>"</h1>
				</div>
				<div class="container-full">
				<section class="row">
							<button type="button" data-toggle="modal" data-target="#exampleModalCenter"> <i class="fas fa-plus iconButton"></i>Agregar</button>
							<button id="editarPregunta"> <i class="fas fa-edit iconButton"></i> Editar</button>
							<button id="borrarPregunta"> <i class="fas fa-trash-alt iconButton" ></i> Borrar</button>
							<button id="visualizarPregunta"> <i class="fas fa-eye"></i> Visualizar</button>
						</section>
						<section class="row">
							<table class="table">
							  <thead>
							    <tr>
							      <th scope="col">Número</th>
							      <th scope="col">Texto</th>
							    </tr>
							  </thead>
							  <tbody id="table">
							    <?php foreach($allpreguntas as $pregunta){?>
							    <tr id="<?php echo $pregunta->idPregunta?>">
							      <td><?php echo $pregunta->numero ?></td>
							      <td><?php echo $pregunta->texto ?></td>
							    </tr>
							    <?php } ?>
							</tbody>
							</table>
						</section>
						<div class="modal fade" id="visualizarPreguntaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">Visualizar Pregunta</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <div id="tablePregunta">
                        
                      </div>
                  </div>
                </div>
            </div>  
          </div>
						<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  						<div class="modal-dialog modal-dialog-centered" role="document">
    						<div class="modal-content">
      							<div class="modal-header">
        							<h5 class="modal-title" id="exampleModalLongTitle">Agregar Pregunta</h5>
        							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
        								<span aria-hidden="true">&times;</span>
      								</button>
    							</div>
    							<div class="modal-body">
       								<form action="<?php echo $helper->url("Preguntas", "agregarPregunta")?>" method="POST" enctype="multipart/form-data">
       									<div class="form-group">
       										<label for="exampleInputEmail1">Número de Pregunta</label>
    										<input type="text" class="form-control" name="numero" aria-describedby="emailHelp" autocomplete="off">
    									</div>
    									<div class="form-row form-group">
    										<div class="col">
    											<label> Texto</label>
    											<textarea class="form-control" name="text" rows="6"></textarea>
    										</div>
    									</div>
       									<div class="modal-footer">
    										<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
    										<input type="hidden" name="idFormato" value="<?php echo $formato-> idFormato?>">
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