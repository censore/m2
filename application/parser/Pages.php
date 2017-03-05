<?php
/**
 * Created by PhpStorm.
 * User: Grad
 * Date: 28.02.2017
 * Time: 22:54
 */

namespace Application\Parser;

use Application\Loader;
use Application\Models\CarsModel;
use Application\Models\TypeModelsModel;
use Application\Parser;
use Application\Parser\Interfaces\ContentInterface;
use Application\Parser\Nokogiri\Nokogiri;

class Pages implements ContentInterface{
    public function findContent(Parser $parser){
        $cars = new TypeModelsModel();
        $car = (object)$cars->setRandom()->select()[0];
        $dom = new Nokogiri( file_get_contents(Loader::app()->getConfig('application')->url . $car->type_link) );

        $pages = new CarsModel();
        $pages->saveArray($car, $dom->get('.c-car-title')->toArray());
    }
}