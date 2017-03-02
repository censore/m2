<?php
/**
 * Created by PhpStorm.
 * User: Master
 * Date: 02-Mar-17
 * Time: 17:32
 */

namespace Application\Models;


class ModelsModel extends MainModel
{
	public $table = 'models';
	public $fields = [
		'id',
		'brand_id',
		'model_name',
		'model_link'
	];
}