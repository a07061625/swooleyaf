<?php
/**
 * 推送唯一标识符列表
 * User: 姜伟
 * Date: 2019/6/25 0025
 * Time: 14:54
 */
namespace SyMessagePush\JPush\Push;

use SyConstant\ErrorCode;
use SyException\MessagePush\JPushException;
use SyMessagePush\JPush\PushBase;
use SyMessagePush\PushUtilJPush;

class CidList extends PushBase
{
    /**
     * 标识符数量
     * @var int
     */
    private $count = 0;
    /**
     * 标识符类型
     * @var string
     */
    private $type = '';

    public function __construct(string $key)
    {
        parent::__construct($key);
        $this->reqHeader['Authorization'] = PushUtilJPush::getReqAuth($key, 'app');
        $this->serviceUri = '/v3/push/cid';
        $this->reqData['count'] = 1;
        $this->reqData['type'] = 'push';
    }

    private function __clone()
    {
    }

    /**
     * @param int $count
     * @throws \SyException\MessagePush\JPushException
     */
    public function setCount(int $count)
    {
        if (($count > 0) && ($count <= 1000)) {
            $this->reqData['count'] = $count;
        } else {
            throw new JPushException('标识符数量不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
    }

    /**
     * @param string $type
     * @throws \SyException\MessagePush\JPushException
     */
    public function setType(string $type)
    {
        if (in_array($type, ['push', 'schedule'])) {
            $this->reqData['type'] = $type;
        } else {
            throw new JPushException('标识符类型不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        $url = $this->serviceDomain . $this->serviceUri . '?' . http_build_query($this->reqData);
        $this->curlConfigs[CURLOPT_URL] = $url;
        return $this->getContent();
    }
}
