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
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\Http\Server\Bean\Annotation\RequestMethod;
use Swoft\View\Bean\Annotation\View;
use Swoft\Http\Message\Server\Response;
use Swoft\Http\Message\Server\Request;
use App\Core\Utils\CommUtils;
use App\Core\Utils\LogUtils;
use Swoft\Core\Config;
use Swoft\Core\RequestContext;
use App\Models\Entity\TUser;
use App\Core\Utils\EncryptUtils;
use Swoft\Db\Db;
use Swoft\Db\Query;


/**
 * Class IndexController
 * @Controller("")
 * @package App\Controllers
 */
class IndexController extends BaseController
{
    protected $modLogger;
    protected $modLoggerName = "test";

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @RequestMapping(route="/", method={RequestMethod::GET,RequestMethod::POST})
     */
    public function index(Request $request): Response
    {
        $data = config('message');

        if ($request->getMethod() === 'POST') {
            return $this->response->success($data);
        }
        return view('index/index', $data);
    }

    /**
     * @RequestMapping(route="/get", method={RequestMethod::GET,RequestMethod::POST})
     */
    public function get(Request $request) : Response
    {
        $timeData = CommUtils::timestamp2time();

        App::debug("this errro log 13541362457 {$timeData}");

        $param = $request->query();
        $param['a'] = isset($param['a']) ? CommUtils::getValueI($param['a']) : "";
        $this->modLogger->debug("参数如下：",$param);

        $tmp = RequestContext::getContextData();

        return $this->response->render_json(0, array(
            'time'      => $timeData,
            'method'    => $request->getServerParams(),
            'url'       => $request->url(),
            'fullUrl'   => $request->fullUrl(),
            'cookie'    => $request->getCookieParams(),
            'param'     => $param,
            'log'       => $tmp,
        ));
    }

    /**
     * @RequestMapping(route="/test", method={RequestMethod::GET,RequestMethod::POST})
     */
    public function testOrm(Request $request) : Response
    {
        // add
        // $salt = EncryptUtils::randNoRepeatCode("salt", 32);
        // $last = EncryptUtils::getLastPw("e10adc3949ba59abbe56e057f20f883e",$salt,"rasine");
        // $user = new TUser();
        // $user->setFNickname("rasine");
        // $user->setFSalt($salt);
        // $user->setFPassword($last);
        // $user->setFCreateTime(CommUtils::timestamp2time());
        // $user->setFModifyTime(CommUtils::timestamp2time());
        // $userId = $user->save()->getResult();
        // $swl = get_last_sql();
        // $this->modLogger->debug("[sql:{$swl}]");
        // return $this->response->render_json(0,array($userId));

        // get 
        // $user = TUser::findById(10000)->getResult();
        // $name = $user->getFNickname();
        // $this->modLogger->debug("用户信息：user");
        $user = Query::table(TUser::class)->where('f_id', 10000)->limit(1)->get()->getResult();
        var_dump($user);
        $this->modLogger->debug("用户信息：user",$user[0]);
        $swl = get_last_sql();
        $this->modLogger->debug("[sql:{$swl}]");
        return $this->response->render_json(0, $user);
    }
}
