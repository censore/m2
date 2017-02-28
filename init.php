<?php
/**
 * Created by PhpStorm.
 * User: Master
 * Date: 28-Feb-17
 * Time: 16:27
 */

require_once dirname(__FILE__) . '/vendor/autoload.php';

$config = (object) (require dirname(__FILE__).'/config/config.php');

$init = \Application\Loader::init($config);

$init->getParser()->run();
