<?php
/**
 * Created by PhpStorm.
 * User: Grad
 * Date: 28.02.2017
 * Time: 20:30
 */
namespace Application\Parser\Interfaces;

use Application\Parser;

interface ContentInterface{
    public function findContent(Parser $parser);
}