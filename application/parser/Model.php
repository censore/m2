<?php
/**
 * Created by PhpStorm.
 * User: Grad
 * Date: 28.02.2017
 * Time: 20:28
 */

namespace Application\Parser;


use Application\GetContent;
use Application\Models\BrandModel;
use Application\Models\ModelsModel;
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
    	$model = new BrandModel();
    	$model->join = null;
    	$model->setRandom();
		$brand = (object)$model->select()[0];

	    $found = GetContent::get($parser, $this->pattern, $this->url . $brand->brand_link);

	    $this->cars_url[$brand->brand_link] = new \stdClass();
	    $this->cars_url[$brand->brand_link]->model = $found[3];
	    $this->cars_url[$brand->brand_link]->link = $found[1];

		$models = new ModelsModel();
		

    }
}