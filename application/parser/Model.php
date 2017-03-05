<?php
/**
 * Created by PhpStorm.
 * User: Grad
 * Date: 28.02.2017
 * Time: 20:28
 */

namespace Application\Parser;


use Application\GetContent;
use Application\Loader;
use Application\Models\BrandModel;
use Application\Models\ModelsModel;
use Application\Models\TypeModelsModel;
use Application\Parser;
use Application\Parser\Interfaces\ContentInterface;
use Curl\MultiCurl;
use Application\Parser\Nokogiri\Nokogiri;

class Model implements ContentInterface {
    public $cars_url;
    public $models;

    public function __construct(){
        $this->models = new \stdClass();
        $this->cars_url = [];
    }
    public function findContent(Parser $parser){
    	$model = new BrandModel();
    	$model->join = null;
    	$model->setRandom();
		$brand = (object)$model->select()[0];
        $dom = new Nokogiri( file_get_contents(Loader::app()->getConfig('application')->url . $brand->brand_link) );
        $save = new TypeModelsModel();
        $save->saveArray($brand->id,
            $this->getCars(
                $dom->get('a.c-link')->toArray(),
                $brand
            )
        );

    }
    public function getCars($items, $brand){
        $links = [];
        foreach($items as $item){
            $pos = stripos($item['href'], $brand->brand_link.'m');
            if($pos!==false){
                $links[] = $item;
            }
        }

        return $links;
    }
}