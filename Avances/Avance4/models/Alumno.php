<?
	declare(strict_types=1);
class Alumno implements Model
{
	private static $table = "Alumnos";
	protected $id;
	protected $sexo;
	protected $nombre;
	protected $paterno;
	protected $materno;
	protected $CURP;
	protected $columns;
	public function __construct(string $nombre, string $paterno, string $materno, string $CURP)
	{
		$this->nombre = $nombre;
		$this->paterno = $paterno;
		$this->materno = $materno;
		$this->CURP = $CURP;
		$this->Sexo::getId($this->getSexo());
		$this->columns = array(":idSex"=>$this->sexo,":nombre"=>$this->nombre,":paterno"=>$this->paterno,":materno"=>$this->materno,":CURP"=>$this->CURP);
		$this->_create();
	}

	private function _create():void
	{
		$pre = Utils::modelArrayToInsertSQL($this->columns);
		try{
			Conex::_query("INSERT INTO ".self::$table."(".$pre[0].") VALUES (".$pre[1].");" ,$this->columns);
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}
	public function getId():int 
	{
		return 0;
	}

	public static function getAll(int $pagination=1000):array
	{
		return Conex::_query("SELECT * FROM".self::$table);
	}

	public function exists():bool
	{
		$res = Conex::_query("SELECT idAlumno FROM".self::$table."WHERE idAlumno=:idAlumno",array(":idAlumno"=>$this->id));
		if($res==array())
			return false;
		return true;
	}
	
}



?>
