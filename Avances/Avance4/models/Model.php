<?php
declare(strict_types=1);

interface Model
{
	public static function getAll(int $pagination=1000):array;
	public static function getById(int $id):self;
	public static function _search(array $array):array;
	public static function _update(array $array):void;
	public static function _delete(array $array):void;
}
?>
