<?php
/**
 * Created by PhpStorm.
 * User: Master
 * Date: 28-Feb-17
 * Time: 17:49
 */

namespace Application;

use Curl\Curl;
use Curl\MultiCurl;

class Parser
{
	public $curl;
	public $curlMulti;
	public $curlContent;


	public function run(){
		foreach (Loader::app()->config->application->steps as $stepName=>$step){
            $this->curlContent->$stepName = $step->findContent($this);
		}
	}
	public function __construct()
	{
		$this->curl = new Curl();
		$this->curlMulti = new MultiCurl();
        $this->curlContent = new \stdClass();
	}
	public function __destruct()
	{
		$this->curl->close();
	}
}