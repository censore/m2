<?php
/**
 * Created by PhpStorm.
 * User: Master
 * Date: 28-Feb-17
 * Time: 17:49
 */

namespace Application;

use Application\Loader;
use Curl\Curl;
use Curl\MultiCurl;
use Application\Parser\Cars;


class Parser
{
	public $curl;
	public $curlContent;

	use Cars;

	public function run(){
		foreach (Loader::app()->config->application->steps as $step){

		}
	}
	public function __construct()
	{
		$this->curl = new Curl();
	}
	public function __destruct()
	{
		$this->curl->close();
	}
}