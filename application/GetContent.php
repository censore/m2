<?php
/**
 * Created by PhpStorm.
 * User: Master
 * Date: 02-Mar-17
 * Time: 17:34
 */

namespace Application;


class GetContent
{
	public static function get(Parser $parser, $pattern, $url){
		$result = $parser->curl->get($url);
		preg_match_all($pattern, $result, $found);
		return $found;
	}
}