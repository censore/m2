<?php
/**
 * Created by PhpStorm.
 * User: Master
 * Date: 28-Feb-17
 * Time: 16:41
 */
namespace Application;

class Loader {
	public static $_inst;
	public $config;
	public $parser;
	public static function init(\stdClass $config){
		if(self::$_inst === null) self::$_inst = (new self())->setConfig($config)->setParser();
		return self::$_inst;
	}

	public static function app(){
		if(self::$_inst === null) throw new \Exception('Builder didn\'t initialized');
		return self::$_inst;
	}
	/**
	 * @return mixed
	 */

	public function getConfig($item = null)
	{
		return ($item === null || is_array($item) || is_a($item)? $this->config : $this->config->$item);
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