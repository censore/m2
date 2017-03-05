<?php
/**
 * Created by PhpStorm.
 * User: Master
 * Date: 28-Feb-17
 * Time: 18:15
 */

namespace Application\Parser;

use Application\Models\BrandModel;
use Application\Parser;
use Application\Parser\Interfaces\ContentInterface;

class Cars implements ContentInterface
{
	public $cars_url = 'https://www.drive2.ru/cars/';
    public $pattern = "/<a class=\"c-link\" href=\"([^\"]*)\"(.*)>(.*)<\/a>/siU";
	public $content;
    public $cars;
    public $lock = true;
    public function __construct(){
        $this->cars = new \stdClass();
    }
	public function findContent(Parser $parser){
		$this->content = $parser->curl->get($this->cars_url, ['all'=>null]);
        preg_match_all($this->pattern, $this->content, $result);
        $this->setLinks($result[1])->setBrands($result[3])->save();
        return $this;
	}

    public function save(){
        $model = new BrandModel();
        foreach ($this->getLinks() as $id=>$link){
        	$model->join = null;
            $model->setLock()->insertIfNonExists(  [
                'brand_name'=>$this->getBrandByKey($id),
                'brand_link'=>$link,
            ]);
	        $model->setUnlock();
        }
    }

    public function getLinks(){
        return $this->cars->links;
    }

    public function setLinks(array $links){
        $this->cars->links = $links;
        return $this;
    }

    public function getBrands(){
        return $this->cars->brands;
    }

    public function setBrands(array $brands){
        $this->cars->brands = $brands;
        return $this;
    }
    public function getLinkByBrand($brand){ // : string
        return $this->getLinks()[array_search($brand, $this->getBrands())];
    }
    public function getBrandByKey( $key){
        return $this->getBrands()[$key];
    }
    public function getBrandByLink($link){
        return $this->getBrands()[array_search($link, $this->getLinks())];
    }
    public function getLinkByKey( $key){
        return $this->getLinks()[$key];
    }

}
