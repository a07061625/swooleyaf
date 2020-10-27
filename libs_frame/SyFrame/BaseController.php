<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/3/4 0004
 * Time: 10:59
 */
namespace SyFrame;

use Response\Result;
use SyConstant\Project;
use SyConstant\SyInner;
use SyReflection\BaseReflect;
use SyTool\SyUser;
use Yaf\Controller_Abstract;
use Yaf\Registry;

abstract class BaseController extends Controller_Abstract
{
    /**
     * @var \Response\Result
     */
    public $SyResult;
    /**
     * @var array
     */
    public $user = [];
    /**
     * 接口签名状态
     *
     * @var bool
     */
    public $signStatus = false;
    /**
     * 切面标识数组
     *
     * @var array
     */
    private $aspectMap = [];

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
     *
     * @param string $data
     */
    public function sendRsp(?string $data = null)
    {
        if (is_string($data)) {
            $this->SyResult->set(Project::DATA_KEY_RESPONSE_CONTENT_STRING, $data);
        }
        $this->getResponse()->setBody($this->SyResult->getJson());
    }

    /**
     * @param string $controllerName
     * @param string $actionName
     *
     * @return array
     *
     * @throws \SyException\Validator\ValidatorException
     */
    private function getAspectList(string $controllerName, string $actionName)
    {
        $aspectKey = $_SERVER['SYKEY-CA'];
        $aspectTag = $this->aspectMap[$aspectKey] ?? null;
        if (is_string($aspectTag)) {
            return Registry::get($aspectTag);
        }

        $controller = $controllerName . 'Controller';
        $action = $actionName . 'Action';
        $aspectList = BaseReflect::getControllerAspects($controller, $action);
        $needStr = hash('crc32b', $aspectKey);
        $aspectBeforeTag = SyInner::REGISTRY_NAME_PREFIX_ASPECT_BEFORE . $needStr;
        $aspectAfterTag = SyInner::REGISTRY_NAME_PREFIX_ASPECT_AFTER . $needStr;
        $this->aspectMap[$aspectKey] = $aspectBeforeTag;
        Registry::set($aspectBeforeTag, $aspectList['before']);
        Registry::set($aspectAfterTag, $aspectList['after']);

        return $aspectList['before'];
    }
}
