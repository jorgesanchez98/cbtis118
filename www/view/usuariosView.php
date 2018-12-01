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
							<a href="" data-toggle="modal" data-target="#modalRegisterForm"><button> <i class="fas fa-plus iconButton"></i> Agregar</button></a>
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
		<div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-header-title w-100 font-weight-bold">Registro usuario</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
      	<form action="<?php echo $helper->url("Usuarios","crear"); ?>" method="POST">
        <div class="md-form mb-5">
          <input name="nombre" type="text" id="orangeForm-name" class="form-control validate">
          <i class="fa fa-user prefix grey-text"></i><label data-error="wrong" data-success="right" for="orangeForm-name"> Nombre</label>
        </div>
        <div class="md-form mb-5">
          <input name="paterno" type="text" id="orangeForm-name" class="form-control validate">
          <i class="fa fa-user prefix grey-text"></i><label data-error="wrong" data-success="right" for="orangeForm-name"> Apellido Paterno</label>
        </div>
        <div class="md-form mb-5">
          <input name="materno" type="text" id="orangeForm-name" class="form-control validate">
          <i class="fa fa-user prefix grey-text"></i><label data-error="wrong" data-success="right" for="orangeForm-name"> Apellido Materno</label>
        </div>
        <div class="md-form mb-5">
          <input name="email" type="email" id="orangeForm-email" class="form-control validate">
          <i class="fa fa-envelope prefix grey-text"></i><label data-error="wrong" data-success="right" for="orangeForm-email"> Email</label>
        </div>

        <div class="md-form mb-5">
          <input name="password" type="password" id="orangeForm-pass" class="form-control validate">
          <i class="fa fa-lock prefix grey-text"></i><label data-error="wrong" data-success="right" for="orangeForm-pass"> Contraseña</label>
        </div>
        <div class="md-form mb-5">
        <div class="form-group">
		    <label for="exampleFormControlSelect1">Rol Asignado</label>
		    <select class="form-control" id="exampleFormControlSelect1" name="idRol">
		      <option value="1">Administrador</option>
		      <option value="2">Usuario</option>
			  </select>
		</div>
		</div>
        <div class="text-center">
        <div class="md-form mb-5">
        <button type="submit" class="btn btn-deep-orange">Registrar</button>
    	</div>
    	</div>
		</form>
      </div>
      <div class="modal-footer d-flex justify-content-center">
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	</body>
</html>
