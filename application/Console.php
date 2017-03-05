<?php
/**
 * Created by PhpStorm.
 * User: Grad
 * Date: 05.03.2017
 * Time: 22:41
 */

namespace Application;

use Application\Parser;

class Console {
    private static $_inst;
    public static function command(){
        if(self::$_inst === null) self::$_inst = new self();
        return self::$_inst;
    }

    public function init(Parser $parser, array $args){
        if(isset($args[1])){
            if($args[1] == 'dont-stop') while(true){ $parser->run();}
            if($args[1] == 'multi' && isset($args[2]) && intval($args[2])){
                for($i = 0; $i<$args[2]; ++$i){
                    echo shell_exec('php init.php ' . (isset($args[3])?:''));
                }
                $parser->run();
            }
        }else{
            $parser->run();
        }

    }
}