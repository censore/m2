<?php
/**
 * Created by PhpStorm.
 * User: Grad
 * Date: 05.03.2017
 * Time: 20:36
 */

namespace Application\Models;


class CarsModel extends MainModel
{
    public $table='cars';
    public function saveArray(\stdClass $relate, $data){

        if(!is_array($data)) throw new \Exception('No data to insert');

        foreach($data as $item){
            $this->insertIfNonExists([
                'brand_id'=>$relate->brand_id,
                'type_id'=>$relate->id,
                'title'=>$item['#text'][0],
                'link'=>$item['href'],
            ]);
        }
    }
}