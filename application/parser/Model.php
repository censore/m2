<?php
/**
 * Created by PhpStorm.
 * User: Grad
 * Date: 28.02.2017
 * Time: 20:28
 */

namespace Application\Parser;


use Application\Parser;
use Application\Parser\Interfaces\ContentInterface;
use Curl\MultiCurl;

class Model implements ContentInterface {
    public $cars_url;
    public $url = 'https://www.drive2.ru';
    public $models;
	public $pattern = "/<a class=\"c-link\" href=\"([^\"]*)\"(.*)>(.*)<\/a>/siU";

    public function __construct(){
        $this->models = new \stdClass();
        $this->cars_url = [];
    }
    public function findContent(Parser $parser){
        foreach($parser->curlContent->cars->getLinks() as $car){
            $result = $parser->curl->get($this->url . $car);

            preg_match_all($this->pattern, $result, $found);

			$this->cars_url[$car] = new \stdClass();

	        $this->cars_url[$car]->model = $found[3];
			$this->cars_url[$car]->link = $found[1];
        }
    }
}