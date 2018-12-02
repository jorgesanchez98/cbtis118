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
		$table='<table class="table"><thead><tr>';
		foreach ($headers as $head) {
			$table.='<th scope="col">'.$head->name.'</th>';	
		}
		$table.='</tr></thead><tbody>';
		while ($row=mysqli_fetch_array($results, MYSQLI_NUM)) {
			$table.='<tr>';
			/*for ($i=0; $i<sizeof($row); $i++) { 
				$table.='<td>'.$row[$i].'</td>';
			}*/
			foreach ($row as $data) {
				$table.='<td>'.$data.'</td>';
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