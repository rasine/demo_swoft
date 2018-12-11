<?php
/**
 * This file is part of Swoft.
 *
 * @link     https://swoft.org
 * @document https://doc.swoft.org
 * @contact  limingxin@swoft.org
 * @license  https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace App\Controllers;

use Swoft\App;
use Swoft\Bean\Annotation\Inject;
use App\Core\HttpServer\Response;
use App\Core\Utils\LogUtils;
use Swoft\Core\RequestContext;

/**
 * Class BaseController
 * @package App\Controllers
 */
class BaseController
{

    protected $modLogger;
    protected $modLoggerName="";

    /**
     * 注入自定义Response
     * @Inject()
     *
     * @var Response
     */
    protected $response;

    public function __construct()
    {
        $this->modLogger = LogUtils::getLogger($this->modLoggerName);
    }
}
