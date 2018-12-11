<?php
/**
 * This file is part of Swoft.
 *
 * @link     https://swoft.org
 * @document https://doc.swoft.org
 * @contact  limingxin@swoft.org
 * @license  https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace App\Core\HttpServer;

use App\Core\Constants\ErrorCode;
use Swoft\Bean\Annotation\Bean;
use Swoft\Core\RequestContext;
use Swoft\Http\Message\Server\Response as HttpServerResponse;

/**
 * @Bean()
 * Class Response
 * @author  limx
 * @package App\Core\HttpServer
 */
class Response
{
    /**
     * 统一json返回
     * @author rasine
     * @param int $iRet
     * @param array $data
     * @return HttpServerResponse
     */
    public function render_json($iRet=0,$data=[]): HttpServerResponse
    {
        $response = RequestContext::getResponse();
        return $response->json([
            'code' => $iRet,
            'data' => $data,
        ]);
    }
}
