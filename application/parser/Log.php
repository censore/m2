<?php
/**
 * Created by PhpStorm.
 * User: Grad
 * Date: 28.02.2017
 * Time: 20:28
 */

namespace Application\Parser;


use Application\Loader;
use Application\Models\CarsModel;
use Application\Models\LogModel;
use Application\Parser;
use Application\Parser\Interfaces\ContentInterface;
use Application\Parser\Nokogiri\Nokogiri;
class Log implements ContentInterface{
    public function findContent(Parser $parser){
        $carsModel = new CarsModel();
        $carsModel->setRandom();
        $car = (object)$carsModel->select()[0];
        $bort = new Nokogiri( file_get_contents(Loader::app()->getConfig('application')->url . $car->link . '/logbook/') );
        $jornals = $bort->get('.c-post-preview__title')->toArray();
        (new LogModel())->saveArray(
            $car,
            $jornals
        );
    }
}