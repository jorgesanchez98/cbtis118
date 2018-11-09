<?php
include("Utils.php");
if (isset($_FILES['archivo']['name']))
{
	Utils::saveFile($_FILES['archivo'],2);
}
?>
