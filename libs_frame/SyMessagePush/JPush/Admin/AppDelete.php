<?php
/**
 * 删除app
 * User: 姜伟
 * Date: 2019/6/25 0025
 * Time: 19:47
 */
namespace SyMessagePush\JPush\Admin;

use SyConstant\ErrorCode;
use SyException\MessagePush\JPushException;
use SyMessagePush\JPush\AdminBase;
use SyMessagePush\PushUtilJPush;

class AppDelete extends AdminBase
{
    /**
     * 应用标识
     * @var string
     */
    private $app_key = '';

    public function __construct(string $key)
    {
        parent::__construct($key);
        $this->reqHeader['Authorization'] = PushUtilJPush::getReqAuth($key, 'dev');
    }

    private function __clone()
    {
    }

    /**
     * @param string $appKey
     * @throws \SyException\MessagePush\JPushException
     */
    public function setAppKey(string $appKey)
    {
        if (ctype_alnum($appKey)) {
            $this->app_key = $appKey;
            $this->serviceUri = '/v1/app/' . $appKey . '/delete';
        } else {
            throw new JPushException('应用标识不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (strlen($this->app_key) == 0) {
            throw new JPushException('应用标识不能为空', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }

        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . $this->serviceUri;
        $this->curlConfigs[CURLOPT_POST] = true;
        return $this->getContent();
    }
}
