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
			<h1 class="titulo">Consulta</h1>
		</div>
		<div class="row">
		<section class="col-md-3 customCol">
			<h3> Campo </h3>
			<select class="form-control" name="tipoArchivo">
    			<option selected value="0"></option>
    			<option value="1"> Total</option>
    		</select>
		</section>
		<section class="col-md-6 customCol">
			<h3> Criteria </h3>
			<select class="form-control" name="tipoArchivo">
    			<option selected value="0"></option>
    			<option value="1"> Total</option>
    		</select>
    		<div class="form-check form-check-inline">
  				<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
				<label class="form-check-label" for="inlineCheckbox1">></label>
			</div>
			<div class="form-check form-check-inline">
 				<input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
  				<label class="form-check-label" for="inlineCheckbox2"><</label>
			</div>
			<div class="form-check form-check-inline">
  				<input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3">
  				<label class="form-check-label" for="inlineCheckbox3">=</label>
			</div>
			<div class="form-group row">
    			<label for="inputPassword" class="col-sm-2 col-form-label">Valor</label>
    			<div class="col-sm-10">
     				<input type="text" class="form-control" id="inputPassword">
    			</div>
  			</div>
  			<div class="add">
  				<button><i class="fas fa-plus"></i></button>
  			</div>
		</section>
		<section class="col-md-3 customCol">
			<h3> Ordenar </h3>
			<select class="form-control" name="tipoArchivo">
    			<option selected value="0"></option>
    			<option value="1"> Total</option>
    		</select>
		</section>
	</div>
	</main>
</body>
</html>