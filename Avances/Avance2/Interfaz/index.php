<?php
$module = $_GET['module'];

if($module=="login")
{
	include 'templates/_login.html';
}
else{
	$aside = "templates/_aside.html";
	$main = "templates/_main.html";
if($module=="home")
{
	$maincontent = "templates/_home.html";
}
if($module=="formato")
{
	$maincontent = "templates/_formato.html";
}
if($module=="formatos")
{
	$maincontent = "templates/_formatos.html";
}
if($module=="inventarios")
{
	$maincontent = "templates/_inventarios.html";
}
if($module=="inventario")
{
	$maincontent = "templates/_inventario.html";
}
if($module=="importar")
{
	$maincontent = "templates/_importar.html";
}
if($module=="generarReportes")
{
	$maincontent = "templates/_generarReportes.html";
}

if($module=="mobiliarios")
{
	$maincontent = "templates/_mobiliarios.html";
}
if($module=="mobiliario")
{
	$maincontent = "templates/_mobiliario.html";
}
if($module=="usuarios")
{
	$maincontent = "templates/_usuarios.html";
}
if($module=="usuario")
{
	$maincontent = "templates/_usuario.html";
}

if($module=="roles")
{
	$maincontent = "templates/_roles.html";
}
if($module=="rol")
{
	$maincontent = "templates/_rol.html";
}








	include 'templates/_index.html';
}
?>
