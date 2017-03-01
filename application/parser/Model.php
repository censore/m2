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
    public $cars_url = [];
    public $url = 'https://www.drive2.ru';
    public $models;

    public function __construct(){
        $this->models = new \stdClass();
    }
    public function findContent(Parser $parser){
        foreach($parser->curlContent->cars->getLinks() as $car){
            $curl = new MultiCurl();
            $result = $curl->addGet($this->url . $car);
        }
    }
}