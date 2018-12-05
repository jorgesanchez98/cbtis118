	<!DOCTYPE html>
<html>
<head>
	<?php include'header.php'; ?>
	<title></title>
</head>
<body>
	<?php include 'asideView.php'; ?>
	<input type="hidden" name="rowColor" id="rowColor" value="1">
	<main class="col-md-10 ml-sm-auto col-lg-10 col-xl-10 px-4">
		<div class="d-flex justify-content-between flex-wrap text-white flex-md-nowrap align-items-center pl-5 pt-3 pb-2 mb-3 border-bottom">
					<h1 class="titulo">Usuarios</h1>
				</div>
				<section class="row">
							<a href="" data-toggle="modal" data-target="#modalRegisterForm"><button> <i class="fas fa-plus iconButton"></i> Agregar</button></a>
							<button type="button" data-toggle="modal" data-target="#borrarModal"> <i class="fas fa-trash-alt iconButton" ></i> Borrar</button>
							<a href="" data-toggle="modal" data-target="#modalEditForm"><button id="editarModal"> <i class="fas fa-edit iconButton"></i> Editar</button></a>
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
							    
							    <tr id="<?php echo $user->idUsuario?>">
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
		<div class="modal fade" id="borrarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">Borrar Usuario</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <p> ¿Estás seguro que quieres borrar al usuario?</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="borrarUsuario">Borrar</button>
                  </div>
              </div>
            </div>
          </div>
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

<div class="modal fade" id="modalEditForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-header-title w-100 font-weight-bold">Editar usuario</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
      	<form action="<?php echo $helper->url("Usuarios","editar"); ?>" method="POST">
        <div class="md-form mb-5">
          <input name="nombre" type="text" id="eNombre" class="form-control validate">
          <i class="fa fa-user prefix grey-text"></i><label data-error="wrong" data-success="right" for="orangeForm-name"> Nombre</label>
        </div>
        <div class="md-form mb-5">
          <input name="paterno" type="text" id="ePaterno" class="form-control validate">
          <i class="fa fa-user prefix grey-text"></i><label data-error="wrong" data-success="right" for="orangeForm-name"> Apellido Paterno</label>
        </div>
        <div class="md-form mb-5">
          <input name="materno" type="text" id="eMaterno" class="form-control validate">
          <i class="fa fa-user prefix grey-text"></i><label data-error="wrong" data-success="right" for="orangeForm-name"> Apellido Materno</label>
        </div>
        <div class="md-form mb-5">
          <input name="email" type="email" id="eMail" class="form-control validate">
          <i class="fa fa-envelope prefix grey-text"></i><label data-error="wrong" data-success="right" for="orangeForm-email"> Email</label>
        </div>

        <div class="md-form mb-5">
          <input name="password" type="password" id="orangeForm-pass" class="form-control validate">
          <i class="fa fa-lock prefix grey-text"></i><label data-error="wrong" data-success="right" for="orangeForm-pass"> Contraseña</label>
        </div>
        <input type="hidden" name="idUsuario" id="idUsuario" value="0">
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
        <button type="submit" class="btn btn-deep-orange">Editar</button>
    	</div>
    	</div>
		</form>
      </div>
      <div class="modal-footer d-flex justify-content-center">
      </div>
    </div>
  </div>
</div>
	<script type="text/javascript" src="view/javascript/functions.js"></script>
	</body>
</html>
