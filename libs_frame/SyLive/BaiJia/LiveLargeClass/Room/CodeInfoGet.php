<?php
/**
 * 获取用户参加码信息
 * User: 姜伟
 * Date: 2020/3/30 0030
 * Time: 8:26
 */
namespace SyLive\BaiJia\LiveLargeClass\Room;

use SyLive\BaseBaiJia;
use SyLive\UtilBaiJia;
use SyConstant\ErrorCode;
use SyException\Live\BaiJiaException;

/**
 * Class CodeInfoGet
 * @package SyLive\BaiJia\LiveLargeClass\Room
 */
class CodeInfoGet extends BaseBaiJia
{
    /**
     * 参加码
     * @var string
     */
    private $code = '';

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/room/getCodeInfo';
    }

    private function __clone()
    {
    }

    /**
     * @param string $code
     * @throws \SyException\Live\BaiJiaException
     */
    public function setCode(string $code)
    {
        if (ctype_alnum($code)) {
            $this->reqData['code'] = $code;
        } else {
            throw new BaiJiaException('参加码不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['code'])) {
            throw new BaiJiaException('参加码不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        UtilBaiJia::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
