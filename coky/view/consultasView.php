<!DOCTYPE html>
<html>
<head>
	<?php include'header.php'; ?>
	<title></title>
</head>
<body>
	<?php include 'asideView.php'; ?>
  <input type="hidden" name="rowColor" id="rowColor" value="1">
	<input type="hidden" name="idFormato" id="idFormato" value="<?php echo $idFormato ?>">
	<main class="col-md-10 ml-sm-auto col-lg-10 col-xl-10 px-4">
		<section class="row backButton">
			<button id="backButtonConsultas"> <i class="fas fa-arrow-left"></i></button>
		</section>
	<div class="d-flex flex-wrap flex-md-nowrap align-items-center pl-5 pt-3 pb-2 mb-3 border-bottom">
			<h1 class="titulo">Consultas</h1>
	</div>
			<div class="row border-bottom">
				<div class="col-1">
					<h1 class="titulo"><?php echo $pregunta->numero ?></h1>
				</div>
				<div class="col-11">
					<p><?php echo $pregunta->texto ?></p>
				</div>
			</div>
				
				<div class="container-full">
				<section class="row">
							<button type="button" data-toggle="modal" data-target="#modal"> <i class="fas fa-plus iconButton"></i>Agregar</button>
							<button id="editarConsulta"> <i class="fas fa-edit iconButton"></i> Editar</button>
							<button type="button" data-toggle="modal" data-target="#borrarModal"> <i class="fas fa-trash-alt iconButton" ></i> Borrar</button>
              <button id="visualizarConsulta"> <i class="fas fa-eye"></i> Visualizar</button>
						</section>
						<section class="row">
							<table class="table">
							  <thead>
							    <tr>
							      <th scope="col">Descripción</th>
							    </tr>
							  </thead>
							  <tbody id="table">
							    <?php foreach($allconsultas as $consulta){?>
							    <tr id="<?php echo $consulta->idConsulta?>">
							      <td><?php echo $consulta->descripcion ?></td>
							    </tr>
							    <?php } ?>
							</tbody>
							</table>
						</section>
            <div class="modal fade" id="borrarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">Borrar Archivo</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <p> ¿Estás seguro que quieres borrar la consulta?</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="borrarConsulta">Borrar</button>
                  </div>
              </div>
            </div>
          </div>
            <div class="modal fade" id="visualizarCon" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">Visualizar Consulta</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <div id="tableConsulta">
                        
                      </div>
                  </div>
                </div>
            </div>  
          </div>
						<div class="modal autoModal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  						<div class="modal-dialog modal-lg" role="dialog">
    						<div class="modal-content">
      							<div class="modal-header">
        							<h5 class="modal-title" id="exampleModalLongTitle">Agregar Consulta</h5>
        							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
        								<span aria-hidden="true">&times;</span>
      								</button>
    							</div>
    							<form action="<?php echo $helper->url("Consultas", "agregarConsulta")?>" method="POST" enctype="multipart/form-data">
    							<div class="modal-body" id="modalBody">
       									<div class="form-group">
       										<label for="exampleInputEmail1">Descripción de Consulta</label>
    										<input type="text" class="form-control" name="descripcion" aria-describedby="emailHelp" id="descripcion" autocomplete="off">
    									</div>
    									<div class="form-row form-group">
    										<section class="col-md-7 customCol">
												<h3> Criterio </h3>
												<div id="criteria">
												<div class="form-group row">
													<div class="col-3">
            											<label class="col-sm-2 col-form-label">Campo</label>
            										</div>
            										<div class="col-9">
														<select class="form-control" name="criteria[]">
    														<option selected value="0"></option>
    														<option value="1"> Sexo</option>
    														<option value="2"> Carrera</option>
                                <option value="3"> Turno</option>
                                <option value="4"> Materias Aprobadas</option>
                                <option value="5"> Materias Reprobadas</option>
                                <option value="6"> Nacido en el Extranjero</option>
    													</select>
    												</div>
    											</div>
    											<div class="form-group row">
    												<div class="col-3">
            											<label class="col-sm-2 col-form-label">Operador</label>
            										</div>
     												<div class="col-9">
    													<select class="form-control" name="operador[]">
    														<option selected value="0"></option>
    														<option value="1"> ></option>
    														<option value="2"> <</option>
    														<option value="3"> =</option>
    													</select>
    												</div>
    											</div>
												<div class="form-group row">
													<div class="col-3">
    													<label for="inputPassword" class="col-sm-2 col-form-label">Valor</label>
    												</div>
    												<div class="col-9">
     													<input type="text" class="form-control" id="inputPassword" name="valor[]">
    												</div>
  												</div>
  											</div>
  												<div id="nuevo0"></div>
  												<div class="add">
  														<button type="button" id="add" class="add"><i class="fas fa-plus"></i></button>
  												</div>

											</section>
											<section class="col-md-5 customCol">
												<h3> Ordenar </h3>
												<div id="ordenar">
													<select class="form-control" name="ordenar" id="ordenarSelect">
    													<option selected value="0"></option>
    													<option value="1"> Semestre</option>
    													<option value="2"> Sexo</option>
    												</select>
    											</div>
										</section>
    								</div>
       									
       								
    							</div>
    							<div class="modal-footer">
    										<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <input type="hidden" name="idPregunta" value="<?php echo $pregunta->idPregunta ?>">
                        <input type="hidden" name="idFormato" value="<?php echo $idFormato ?>">
                         <input type="hidden" name="editando" id="editando" value="0">
                         <input type="hidden" name="idConsulta" id="idConsulta" value="0">
        									<input  class="btn btn-primary" type="submit" name="submit" value="Subir">
    							</div>
    							</form>
    						</div>
						</div>	
					</div>
				</div>

		</main>
		<script type="text/javascript" src="view/javascript/functions.js"></script>
	</body>
</html>