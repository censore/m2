<?php
/**
 * Created by PhpStorm.
 * User: Master
 * Date: 01-Mar-17
 * Time: 15:15
 */

namespace Application\Models;


class BrandModel extends MainModel
{
	public $table = 'brand_model';
	public $fields = [
		'id',
		'brand_name',
		'brand_link'
	];
	public $join = [
		'models'=>['id', 'brand_id']
	];
}