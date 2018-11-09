<?php
include("Session.php");
include("utils.php");
$module = $_GET['module'];
$session = Session::getInstance();

if(!isset($session->rol))
{
		if(isset($_POST['user'])&&isset($_POST['pass']))
	{
		if($_POST['user']!="" && $_POST['pass']!="")
		{
			$user = login($_POST['user'],$_POST['pass']);
			if($user!=array())
			{
				$session->nombre  = $user['Nombre'];
				$session->apellidos = $user['Apellido'];
				$session->balance =$user['Balance'];
				$session->id = $user['Id_Usuario'];
				$session->rol = getRol($user['Id_Usuario']);
				header("Location: index.php?module=home");
				$error = "Datos de inicio malos";
			}
		}
		else
			$error = "Falta usuario o contraseña";
	}
	include 'templates/_login.html';
}
	else
		{
		$aside = "templates/_aside.html";
		$main = "templates/_main.html";
		if($module=="Salir")
		{
			$session->destroy();
			header("Location: index.php?module=login");
		}
		if($module=="home")
		{
			$maincontent = "templates/_home.html";
		}
		if($module=="Sub-consultas")
		{
			if(isset($_GET['consulta']))
			{	if($_GET['consulta']=="1")
				{
					if(isset($_GET['min']) && isset($_GET['max']))
					{
						$min = $_GET['min'];
						$max = $_GET['max'];
						$maincontent = "templates/_rmonto.html";
					}
					else
						$maincontent = "templates/_tform.html";
				}
	
			if($_GET['consulta']=="2")
			{
				if(isset($_GET['nombre']))
					{
						$nombre = $_GET['nombre'];
						$maincontent = "templates/_rest.html";
					}
					else
						$maincontent = "templates/_tnform.html";
			}
				if($_GET['consulta']=="3")
					$maincontent = "templates/_p.html";
				if($_GET['consulta']=="4")
					$maincontent = "templates/_areat.html";
				if($_GET['consulta']=="5")
					$maincontent = "templates/_tt.html";
				if($_GET['consulta']=="6")
				{
					if(isset($_GET['nombre']))
					{
						$nombre = $_GET['nombre'];
						$maincontent = "templates/_resc.html";
					}
					else
						$maincontent = "templates/_cform.html";
				}
			}
			else
			$maincontent = "templates/_sub.html";
		}
		include 'templates/_index.html';
	}
?>
