<?php
/**
 * Created by PhpStorm.
 * User: Master
 * Date: 02-Mar-17
 * Time: 17:32
 */

namespace Application\Models;


class TypeModelsModel extends MainModel
{
	public $table = 'type_model';
	public $fields = [
		'id',
		'brand_id',
		'model_name',
		'model_link'
	];
    public function saveArray($brand, $data = null){
        if(!is_array($data)) throw new \Exception('No data to insert');
        foreach($data as $item){
            $array = [
                'brand_id'=>$brand,
                'type_name'=>$item['#text'][0],
                'type_link'=>$item['href']
            ];

            $this->insertIfNonExists($array);
        }
    }
}