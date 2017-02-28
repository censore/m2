<?php
/**
 * Created by PhpStorm.
 * User: Master
 * Date: 28-Feb-17
 * Time: 18:15
 */

namespace Application\Parser;


trait Cars
{
	public $cars_url = 'https://www.drive2.ru/cars/';
	public $content;
	public function getCarsContent(){
		$this->content = $this->curl->get($this->cars_url, ['all'=>null]);
	}
}