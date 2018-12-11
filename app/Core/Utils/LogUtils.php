<?php

/**
 * 日志操作对象
 * @author: rasine
 */

namespace App\Core\Utils;

use Swoft\App;
use Monolog\Logger;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\ErrorLogHandler;
use App\Core\Logger\Config;

class LogUtils
{
    /**
     * 获取日志操作对象  按时间存放
     * @param string $fileName
     * @return mixed
     */
    public static function getLogger($fileName = 'base')
    {
        static $loggers;

        if (empty($fileName)) {
            $fileName = 'base';
        }

        if (!isset($loggers[$fileName])) {
            $maxFiles = App::getBean('config')->get('baseOwnLogger.maxFiles');
            $fileDebugPath = App::getAlias("@runtime/logs/{$fileName}/{$fileName}_debug.log");
            $fileErrorPath = App::getAlias("@runtime/logs/{$fileName}/{$fileName}_error.log");
            $level = App::getBean('config')->get('baseOwnLogger.level');

            $loger = new Logger($fileName);
            if($level == 1){
                // debug
                $loger->pushHandler(new RotatingFileHandler($fileDebugPath, $maxFiles, Logger::DEBUG));
            }
            $loger->pushHandler(new RotatingFileHandler($fileErrorPath, $maxFiles, Logger::ERROR));
            $loggers[$fileName] = $loger;
        }
        return $loggers[$fileName];
    }
}