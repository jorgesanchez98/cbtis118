<?php
    function connect() {
        return new PDO("mysql:host=localhost;dbname=rbac","root","");
    }

function disconnect($con) {
	$con=null;
    }

    function login($user, $pass) {
        $db = connect();
        if ($db != NULL) {

            $stm=$db->prepare("SELECT Id_Usuario FROM usuario WHERE Id_Usuario=:idUser AND Contrasena=:pass");
	    $stm->bindParam(":idUser", $user);
	    $stm->bindParam(":pass", $pass);
	    $stm->execute();	    
	    $count = $stm->fetchColumn();
            if ($count)  {
                return true;
            }
            return false;
        }
        return false;
    }

    function getRol($user) {
        $db = connect();
        if ($db != NULL) {
		$stm=$db->prepare("SELECT Id_Rol FROM roles_usuario WHERE Id_Usuario = :idUser");
	    	$stm->bindParam(":idUser", $user);
		$stm->execute();
            	
		if ($row = $stm->fetch(PDO::FETCH_BOTH)) {
                $rol = $row['Id_Rol'];
            }
            disconnect($db);
            return $rol;
        }
        return false;
    }

    function getPrivilegios($rol) {
        $db = connect();
        if ($db != NULL) {

		$stm=$db->prepare('SELECT DISTINCT Id_Privilegio FROM roles_privilegios WHERE Id_Rol="'.$rol.'"');
		$stm->execute();
            	$privilegios = array();
            	while ($fila = $stm->fetch(PDO::FETCH_BOTH)) {
              		$privilegios[] = $fila['Id_Privilegio'];
            	}
            	disconnect($db);
            	return $privilegios;
        }
        return false;
    }


   function getMTransaccion($min, $max) {
        $db = connect();
        if ($db != NULL) {
		$stm =$db->prepare("SELECT Fecha,Monto FROM usuario_transaccion WHERE Monto between :min and :max  ORDER BY Monto ASC");
		$stm -> bindParam(":min",$min);
		$stm -> bindParam(":max",$max);
		$stm->execute();

            $table = '<div class="container"><div class="jumbotron jumbotron-fluid bg-light">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                        <th>Fecha</th>
                                        <th>Monto</th>
                                        </tr>
                                    </thead>
                                    </tbody>';

		while ($fila = $stm->fetch(PDO::FETCH_BOTH))
		{
                    $table .= '
                                        <tr>
                                        <td>'.$fila["Fecha"].'</td>
                                        <td>'.$fila["Monto"].'</td>
                                        </tr>';
            }
            disconnect($db);
            return $table.'</tbody>
                                </table>
                            </div></div>';
        }
    return "";
 }

echo getMTransaccion(10,100);

function getTNombre($nombre) {
        $db = connect();
        if ($db != NULL) {
            $stm=$db->prepare("SELECT * FROM usuario_transaccion, usuario WHERE usuario.Id_Usuario = usuario_transaccion.Id_Usuario AND Nombre='Estefania'");
	    $stm->bindParam(":nombre",$nombre);
	    $stm->execute();
            $html = '<div class="container"><div class="jumbotron jumbotron-fluid bg-light">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                        <th>Id Transaccion</th>
                                        <th>Usuario</th>
                                        <th>Fecha</th>
                                        </tr>
                                    </thead>
                                    </tbody>';

            while ($fila = $stm->fetch(PDO::FETCH_BOTH)) {
                    $html .= '
                                        <tr>
                                        <td>'.$fila["Id_Us-Trans"].'</td>
                                        <td>'.$fila["Nombre"].'</td>
                                        <td>'.$fila["Fecha"].'</td>
                                        </tr>';
            }

            return $html.'</tbody></table></div></div>';
            disconnect($db);
        }
        return "";
    }
echo getTNombre("Estefania");

    function getPersonalF() {
        $db = connect();
        if ($db != NULL) {
            $stm = $db->prepare('SELECT DISTINCT * FROM usuario U, trabajadores T, trabajadores_areatrabajo TA WHERE U.Id_Usuario=T.Id_Usuario AND T.Id_Usuario=TA.Id_Usuario');
            $stm->execute();
            $TN = '<div class="container"><div class="jumbotron jumbotron-fluid bg-light">
                                <table class="table table-hover">
                                    <thead>
					<tr>				
                                        <th>Nombre</th>
                                        <th>Fecha</th>
                                        </tr>
                                    </thead>
                                    </tbody>';

            while ($fila = $stm->fetch()) {
                    $TN .= '
                                        <tr>
                                        <td>'.$fila["Nombre"].'</td>
                                        <td>'.$fila["Fecha"].'</td>
                                        </tr>';
            }
            disconnect($db);

            return $TN.'</tbody>
                                </table>
                            </div></div>';
        }
        return false;
    }


function getAreaTrabajo() {
        $db = connect();
        if ($db != NULL) {

	    $stm=$db->prepare('SELECT * FROM areatrabajo');
            $stm->execute();
            $table = '<div class="container"><div class="jumbotron jumbotron-fluid bg-light">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                        <th>Id_AreaTrabajo</th>
                                        </tr>
                                    </thead>
                                    </tbody>';

            while ($fila = $stm->fetch(PDO::FETCH_BOTH)) {
                    $table .= '
                                        <tr>
                                        <td>'.$fila["Id_AreaTrabajo"].'</td>
                                        </tr>';
            }
            disconnect($db);
            return $table.'</tbody>
                                </table>
                            </div></div>';
        }
        return "";
    }

    function getTTipo() {
        $db = connect();
        if ($db != NULL) {
            $stm=$db->prepare('SELECT Tipo FROM transaccion');
            $stm->execute();
            $table = '<div class="container"><div class="jumbotron jumbotron-fluid bg-light">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                        <th>Tipo de Trasaccion</th>
                                        </tr>
                                    </thead>
                                    </tbody>';

            while ($fila = $stm->fetch(PDO::FETCH_BOTH)) {
                    $table .= '
                                        <tr>
                                        <td>'.$fila["Tipo"].'</td>
                                        </tr>';
            }

            disconnect($db);
            return $table.'</tbody>
                                </table>
                            </div></div>';
        }
        return "";
    }

    function getCuentas($nombre) {
        $db = connect();
        if ($db != NULL) {
		$stm = $db->prepare("SELECT * FROM usuario WHERE Nombre LIKE :nombre");
		$nombre="%".$nombre;
	    $stm->bindParam(":nombre",$nombre);
	    $stm->execute();
            $table = '<div class="container"><div class="jumbotron jumbotron-fluid bg-light">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                        <th>Id_Usuario</th>
                                        <th>Nombre</th>
                                        <th>Apellidos</th>
                                        <th>Creado en</th>
                                        <th>Nacimiento</th>
                                        <th>Balance</th>
                                        <th>Contraseña</th>
                                        <th>Habilitado</th>
                                        </tr>
                                    </thead>
                                    </tbody>';

            while ($fila = $stm->fetch(PDO::FETCH_BOTH)) {
                    $table .= '
                                        <tr>
                                        <td>'.$fila["Id_Usuario"].'</td>
                                        <td>'.$fila["Nombre"].'</td>
                                        <td>'.$fila["Apellidos"].'</td>
                                        <td>'.$fila["Fecha_Creacion"].'</td>
                                        <td>'.$fila["Fecha_Nacimiento"].'</td>
                                        <td>'.$fila["Balance"].'</td>
                                        <td>'.$fila["Contrasena"].'</td>
                                        <td>'.$fila["Habilitado"].'</td>
                                        </tr>';
            }

            disconnect($db);
            return $table.'</tbody>
                                </table>
                            </div></div>';
        }
        return "";
    }
    var_dump(login("A00000001","hello"));
    var_dump(getRol("A00000001"));
    var_dump(getPrivilegios(getRol("A00000001")));
    echo getPersonalF();
    echo getAreaTrabajo();
    echo getTTipo();
    echo getCuentas("Estefania");
 

?>

