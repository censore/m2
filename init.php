<?php
/**
 * Created by PhpStorm.
 * User: Master
 * Date: 28-Feb-17
 * Time: 16:27
 */

require_once dirname(__FILE__) . '/vendor/autoload.php';

use Application\Console;

$config = (object) (require dirname(__FILE__).'/config/config.php');

Console::command()->init(\Application\Loader::init($config)->getParser(), $argv);

//->run();

