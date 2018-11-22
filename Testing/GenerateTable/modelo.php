<?php
	function connect(){
		$conexion=	mysqli_connect("localhost", "root", "", "examenparcial");
		if($conexion==NULL){
			die("Error, imposible conectarse a la base de datos");
		}
		$conexion->set_charset("utf8");
		return $conexion;
	}

	function disconnect($conexion){
		mysqli_close($conexion);
	}

	function generateTable($query){
		$conexion=connect();
		$results=$conexion->query($query);
		$headers=$results->fetch_fields();
		$table='<table><thead><tr>';
		foreach ($headers as $head) {
			$table.='<th>'.$head->name.'</th>';	
		}
		$table.='</tr></thead><tbody>';
		while ($row=mysqli_fetch_array($results, MYSQLI_BOTH)) {
			$table.='<tr>';
			for ($i=0; $i<sizeof($row)/2; $i++) { 
				$table.='<td>'.$row[$i].'</td>';
			}
			$table.='</tr>';
			$some=sizeof($row);
		}
		$table.='</tbody></table>';
		mysqli_free_result($results);
		disconnect($conexion);
		return $table;
	}	
?>