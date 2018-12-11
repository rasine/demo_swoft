<?php
/**
 * This file is part of Swoft.
 *
 * @link     https://swoft.org
 * @document https://doc.swoft.org
 * @contact  limingxin@swoft.org
 * @license  https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

return [
    'env' => env('APP_ENV', 'test'),
    'debug' => env('APP_DEBUG', false),
    'version' => '1.0',
    'autoInitBean' => true,
    'bootScan' => [
        'App\Commands',
        'App\Boot',
    ],
    'excludeScan' => [

    ],
    'I18n' => [
        'sourceLanguage' => '@root/resources/messages/',
    ],
    'devtool' => [
        'enable' => false,
        'logEventToConsole' => false,
        'logHttpRequestToConsole' => false,
    ],
    'baseOwnLogger'=>[
        'level' => 1,// 1 debug 2 error
        'maxFiles' => 7,
    ],
    'db' => require __DIR__ . DS . 'db.php',
    'cache' => require __DIR__ . DS . 'cache.php',
    'service' => require __DIR__ . DS . 'service.php',
    'breaker' => require __DIR__ . DS . 'breaker.php',
    'provider' => require __DIR__ . DS . 'provider.php',
    'message' => require __DIR__ . DS . 'message.php',
    'queue' => require __DIR__ . DS . 'queue.php',
    'beanScan' => require __DIR__ . DS . 'beanScan.php',
    'components' => require __DIR__ . DS . 'components.php',
];
