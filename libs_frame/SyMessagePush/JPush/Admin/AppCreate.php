<?php
/**
 * 创建app
 * User: 姜伟
 * Date: 2019/6/25 0025
 * Time: 15:40
 */
namespace SyMessagePush\JPush\Admin;

use SyConstant\ErrorCode;
use SyException\MessagePush\JPushException;
use SyMessagePush\JPush\AdminBase;
use SyMessagePush\PushUtilJPush;
use SyTool\Tool;

class AppCreate extends AdminBase
{
    /**
     * 应用名称
     * @var string
     */
    private $app_name = '';
    /**
     * 应用Android包名
     * @var string
     */
    private $android_package = '';
    /**
     * 应用分组名称
     * @var string
     */
    private $group_name = '';

    public function __construct(string $key)
    {
        parent::__construct($key);
        $this->reqHeader['Authorization'] = PushUtilJPush::getReqAuth($key, 'dev');
        $this->serviceUri = '/v1/app';
        $this->reqData['group_name'] = '';
    }

    private function __clone()
    {
    }

    /**
     * @param string $appName
     * @throws \SyException\MessagePush\JPushException
     */
    public function setAppName(string $appName)
    {
        $trueName = trim($appName);
        if (strlen($trueName) > 0) {
            $this->reqData['app_name'] = $trueName;
        } else {
            throw new JPushException('应用名称不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
    }

    /**
     * @param string $androidPackage
     * @throws \SyException\MessagePush\JPushException
     */
    public function setAndroidPackage(string $androidPackage)
    {
        $truePackage = trim($androidPackage);
        if (strlen($truePackage) > 0) {
            $this->reqData['android_package'] = $truePackage;
        } else {
            throw new JPushException('应用Android包名不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
    }

    /**
     * @param string $groupName
     */
    public function setGroupName(string $groupName)
    {
        $this->reqData['group_name'] = trim($groupName);
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['app_name'])) {
            throw new JPushException('应用名称不能为空', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
        if (!isset($this->reqData['android_package'])) {
            throw new JPushException('应用Android包名不能为空', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }

        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . $this->serviceUri;
        $this->curlConfigs[CURLOPT_POST] = true;
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        return $this->getContent();
    }
}
