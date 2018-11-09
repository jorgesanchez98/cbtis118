<?php
declare(strict_types=1);

final class Sexo
{
	final static $table = "Sexos";
	protected $idSexo;
	protected $nombre;
	protected $columns;

	public function __construct(string $nombre)
	{
		$this->nombre = $nombre;
		$this->columns=Array(":nombre"=>$nombre);
		$this->_create();
	}
	public function _create():void
	{
		$pre = Utils::modelArrayToInsertSQL($this->columns);
			try
			{
				Conex::_query("INSERT INTO ".self::$table."(".$pre[0].") VALUES (".$pre[1].");" ,$this->columns);
			}
			catch(Exception $e)
			{
				echo $e->getMessage();
			}
	}
	public static function getId(string $sexo):int
	{
		return Conex::_query("SELECT idSexo FROM ".$table." WHERE nombre = );
	}
}

?>
