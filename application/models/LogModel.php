<?php
/**
 * Created by PhpStorm.
 * User: Grad
 * Date: 05.03.2017
 * Time: 21:40
 */

namespace Application\Models;


class LogModel extends MainModel {
    public $table='log';

    public function saveArray(\stdClass $info, $data){
        if(!is_array($data)) throw new \Exception('No data to insert');
        foreach($data as $item){
            $a = $this->getAContent($item);
            $insert = [
                'car_id'=>$info->id,
                'title'=>$a['#text'][0],
                'link'=>$a['href']
            ];
            print_r($insert);
            $this->insertIfNonExists($insert);
        }
    }

    public function getAContent($a){
        return $a['a'][0];
    }
}