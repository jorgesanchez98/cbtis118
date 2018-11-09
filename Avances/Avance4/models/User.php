<?php
	declare(strict_types=1);

class User //implements Model
{
	private static $table = "users";
	protected $id;
	protected $user;
	protected $password;
	protected $roleid;

	protected $columns;

	public function __construct(string $user,string $password,int $roleid)
	{
		$this->user=$user;
		$this->password=$password;
		$this->roleid=$roleid;
		$this->columns = array(":user"=>$user,":password"=>$password,":roleid"=>$roleid);
		$this->_create();
	}

	private function _create():void
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
	public function getId():int
	{
		return 2;
	}
	public static function getAll(int $pagination=1000):array
	{
		return Conex::_query("SELECT * FROM ".self::$table);
	}
	public function exists():bool
	{
		$res=Conex::_query("SELECT id FROM ".self::$table." WHERE user=:user",array(":user"=>$this->user));
		if($res==array())
			return false;
		return true;
	}

}
?>
