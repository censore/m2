<?php
/**
 * Created by PhpStorm.
 * User: Master
 * Date: 28-Feb-17
 * Time: 16:39
 */
return [
	 'application'=>(object) [
		'imagesDirectory'=>'',
        'url'=>'https://www.drive2.ru',
		'steps'=>  [
			'cars'=>new Application\Parser\Cars(),
            'model'=>new Application\Parser\Model(),
            'pages'=>new Application\Parser\Pages(),
            'log'=>new Application\Parser\Log(),
		],
	],
	'db'=>(object)[
		'host'=>'localhost',
		'database'=>'drive2',
		'user'=>'root',
		'password'=>'',
	]
];