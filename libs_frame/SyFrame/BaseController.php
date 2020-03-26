<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/3/4 0004
 * Time: 10:59
 */
namespace SyFrame;

use Response\SyResponseHttp;
use SyConstant\SyInner;
use Reflection\BaseReflect;
use Response\Result;
use SyTool\SyUser;
use SyTool\Tool;
use Yaf\Controller_Abstract;
use Yaf\Registry;

abstract class BaseController extends Controller_Abstract
{
    /**
     * @var \Response\Result
     */
    public $SyResult = null;
    /**
     * @var array
     */
    public $user = [];
    /**
     * 接口签名状态
     * @var bool
     */
    public $signStatus = false;
    /**
     * 切面标识数组
     * @var array
     */
    private $aspectMap = [];

    private function getAspectList(string $controllerName, string $actionName)
    {
        $aspectKey = $_SERVER['SYKEY-CA'];
        $aspectTag = $this->aspectMap[$aspectKey] ?? null;
        if (is_string($aspectTag)) {
            return Registry::get($aspectTag);
        }

        $controller = $controllerName . 'Controller';
        $action = $actionName  . 'Action';
        $aspectList = BaseReflect::getControllerAspectAnnotations($controller, $action);
        $needStr = hash('crc32b', $aspectKey);
        $aspectBeforeTag = SyInner::REGISTRY_NAME_PREFIX_ASPECT_BEFORE . $needStr;
        $aspectAfterTag = SyInner::REGISTRY_NAME_PREFIX_ASPECT_AFTER . $needStr;
        $this->aspectMap[$aspectKey] = $aspectBeforeTag;
        Registry::set($aspectBeforeTag, $aspectList['before']);
        Registry::set($aspectAfterTag, $aspectList['after']);
        return $aspectList['before'];
    }

    public function init()
    {
        $this->SyResult = new Result();
        $this->user = SyUser::getUserInfo(true);

        //执行前置切面
        $controllerName = $this->getRequest()->getControllerName();
        $actionName = $this->getRequest()->getActionName();
        $aspectList = $this->getAspectList($controllerName, $actionName);
        foreach ($aspectList as $aspectName) {
            $aspectName::handleBefore();
        }
    }

    /**
     * 设置响应数据
     * <pre>
     * data为null,设置响应数据为SyResult
     * data不为null,设置响应数据为data
     * </pre>
     * @param string $data
     */
    public function sendRsp(?string $data = null)
    {
        if (SY_SERVER_TYPE != SyInner::SERVER_TYPE_API_MODULE) {
            if (is_string($data)) {
                $dataArr = Tool::jsonDecode($data);
                if (isset($dataArr['code']) && ($dataArr['code'] > 0)) {
                    SyResponseHttp::header(SyInner::SERVER_DATA_KEY_HTTP_RSP_CODE_ERROR, SY_HTTP_RSP_CODE_ERROR);
                }
            } elseif ($this->SyResult->getCode() > 0) {
                SyResponseHttp::header(SyInner::SERVER_DATA_KEY_HTTP_RSP_CODE_ERROR, SY_HTTP_RSP_CODE_ERROR);
            }
        }
        if (is_null($data)) {
            $this->getResponse()->setBody($this->SyResult->getJson());
        } else {
            $this->getResponse()->setBody((string)$data);
        }
    }
}
