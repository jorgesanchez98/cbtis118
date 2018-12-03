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
			<h1 class="titulo">Consulta</h1>
		</div>
		<form action="<?php echo $helper->url("Reportes","consulta"); ?>" method="POST" enctype="multipart/form-data">
			<div class="row">
				<section class="col-md-7 customCol">
					<h3> Criterio </h3>
					<select class="form-control" name="criteria[]">
    					<option selected value="0"></option>
    					<option value="Total"> Total</option>
    					<option value="Sexo"> Sexo</option>
    					<option value="calificacionTotal"> Calificacion</option>
    					<option value="Carrera"> Carrera</option>
    				</select>
            <label class="col-sm-2 col-form-label">Operador</label>
    				<select class="form-control" name="operador[]">
    					<option selected value="0"></option>
    					<option value=">"> ></option>
    					<option value="<"> <</option>
    					<option value="="> =</option>
    				</select>
					<div class="form-group row">
    					<label for="inputPassword" class="col-sm-2 col-form-label">Valor</label>
    					<div class="col-sm-10">
     						<input type="text" class="form-control" id="inputPassword" name="valor[]">
    					</div>
  					</div>
  					<div id="nuevo"></div>
  					<div class="add">
  						<button type="button" id="add"><i class="fas fa-plus"></i></button>
  					</div>

				</section>
				<section class="col-md-5 customCol">
					<h3> Ordenar </h3>
					<select class="form-control" name="ordenar">
    					<option selected value="0"></option>
    					<option value="Semestre"> Semestre</option>
    					<option value="Sexo"> Sexo</option>
    				</select>
				</section>
			</div>
			<div class="row">
				<input type="submit" name="submit" value="Consultar" class="btn-primary">
			</div>
		</form>
	</main>
</body>
</html>