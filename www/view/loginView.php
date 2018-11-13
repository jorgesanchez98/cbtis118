
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"> 
		<title>Login</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"></link>
		<link rel="stylesheet" href="view/css/estilos.css">
	</head>
	<body>
		<main>
			<div class="login-form text-center">
				
				<img src="https://raw.githubusercontent.com/google/material-design-icons/master/action/2x_web/ic_lock_black_48dp.png">
				
				<h2 class="h2 mb-3">Inicio de sesión</h2>
				<form action="<?php echo $helper->url("login","login"); ?>" method="POST">
				<div class="form-group">
					<input class="login-input" type="text" name="nombre" placeholder="usuario">
				</div>
				<div class="form-group">
					<input class="login-input" type="password" name="password" placeholder="contraseña">
				</div>
 				  <div class="text-center">
			      <button type="submit" class="btn btn-primary">Registrar</button>
			      </div> 
			   	  </form>

			      </div>
			</div>
		</main>	
		<footer>
	</footer>
	</body>
</html>

