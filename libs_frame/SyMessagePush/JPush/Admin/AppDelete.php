<?php
/**
 * 删除app
 * User: 姜伟
 * Date: 2019/6/25 0025
 * Time: 19:47
 */
namespace SyMessagePush\JPush\Admin;

use Constant\ErrorCode;
use Exception\MessagePush\JPushException;
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
        parent::__construct();
        $this->reqHeader['Authorization'] = PushUtilJPush::getReqAuth($key, 'dev');
        $this->objKey = $key;
        $this->reqMethod = self::REQ_METHOD_POST;
    }

    private function __clone()
    {
    }

    /**
     * @param string $appKey
     * @throws \Exception\MessagePush\JPushException
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
        return $this->getContent();
    }
}
