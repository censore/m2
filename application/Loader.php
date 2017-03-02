<?php
/**
 * Created by PhpStorm.
 * User: Master
 * Date: 28-Feb-17
 * Time: 16:41
 */
namespace Application;



use Vendor\Mysql\MysqliDb;

class Loader {
	public static $_inst;
	public $config;
	public $parser;
	public $databse;
	public static function init(\stdClass $config){
		if(self::$_inst === null) self::$_inst = (new self())->setConfig($config)->setParser();
		return self::$_inst;
	}

	public static function app(){
		if(self::$_inst === null) throw new \Exception('Builder didn\'t initialized');
		return self::$_inst;
	}

	public function getDB(){
		if($this->database === null) $this->databse = new MysqliDb(
			$this->getConfig('db')->host,
			$this->getConfig('db')->user,
			$this->getConfig('db')->password,
			$this->getConfig('db')->database
		);
		return $this->databse;
	}

	/**
	 * @return mixed
	 */

	public function getConfig($item = null)
	{
		return ($item === null || is_array($item) || is_object($item)? $this->config : $this->config->$item);
	}

	/**
	 * @param mixed $config
	 */
	public function setConfig($config)
	{
		$this->config = $config;
		return $this;
	}

	/**
	 * @param mixed $parser
	 */
	private function setParser()
	{
		$this->parser = new Parser();
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getParser()
	{
		return $this->parser;
	}

}