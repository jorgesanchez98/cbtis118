<?php
declare(strict_types=1);
include("./vendor/autoload.php");
include("Conex.php");
use Box\Spout\Reader\ReaderFactory;
use Box\Spout\Common\Type;

final class Utils
{

	public static function fileToString(string $file):string
	{
		$temp="";
		if(!file_exists($file)) throw new InvalidArgumentException("No existe tal archivo");
		$res = fopen($file,'r');
		if(!$res) throw new InvalidArgumentException("No se pudo cargar el archivo de configuración");
		while(($buffer=fgets($res,4096))!==false) $temp.=$buffer;
		return $temp;
	}

	
	public static function stringToFile(string $str,string $file, bool $ow): void
	{
		if(file_exists($file)&&!$ow) throw new InvalidArgumentException("Se está sobreescribiendo un archivo");
		file_put_contents($file,$str);
	}

	public static function stringToHash(string $str, string $salt, int $rounds): string
	{
		for($i=0; $i<$rounds;  $i++)
		{
			$str=hash('sha256',$str.$salt);
		}
		return $str;
	}
	public static function modelArrayToInsertSQL(array $arr):array
	{
		$columns = "";
		$values = "";
		foreach($arr as $key=>$value)
		{
			$values.=$key.",";
			$key=ltrim($key,':');
			$columns.=$key.",";
		}
		$columns=rtrim($columns, ',');
		$values=rtrim($values, ',');
		return array( 0 => $columns, 1=> $values);
	}
	public static function stringToArray(string $str):array
	{
		$ret=json_decode($str, true);	
		switch(json_last_error()) {
			case JSON_ERROR_NONE:
				break;
			case JSON_ERROR_DEPTH:
				throw new Exception("Se excedió el tamaño de la pila");
			case JSON_ERROR_STATE_MISMATCH:
				throw new InvalidArgumentException("El string '".$str."'tiene errores de syntax");
        		case JSON_ERROR_CTRL_CHAR:
				throw new InvalidArgumentException("El string '".$str."'tiene errores de syntax");
			case JSON_ERROR_SYNTAX:
				throw new InvalidArgumentException("El string '".$str."'tiene errores de syntax");
        		case JSON_ERROR_UTF8:
				throw new InvalidArgumentException("El string '".$str."'tiene errores de codificación");
        		default:
				throw new Exception("Error desconocido");
		}
		return $ret;
	}
	public static function saveFile($file, $tipo):void
	{
		$info = pathinfo($file['name']);
		$ext = $info['extension']; // get the extension of the file
		$newname = hash_file('md5', $file['tmp_name']); 

		$target = dirname(__FILE__).'/uploads/'.$newname.".".$ext;
		move_uploaded_file($file['tmp_name'], $target);
		$reader = ReaderFactory::create(Type::XLSX);
		$reader->open($target);
		foreach ($reader->getSheetIterator() as $sheet) {
    		foreach ($sheet->getRowIterator() as $row) {
			if($row[0]!=="CLV_CENTRO")
			{
			Conex::_query("CALL getInscripcionID('$row[2]', '$row[4]', $row[5], '".substr($row[6],-1)."', '$row[8]','$row[9]', '$row[10]', '$row[11]','".substr($row[11],10,-7)."','$row[12]',$row[16],".substr($row[17],10,-7).", ".substr($row[17],-4).",@id)");			
			}
		}
		}
		$reader->close();
	}
}

?>
