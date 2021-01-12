<?php
/**
 * 增加登陆信息跟踪
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:40
 */

namespace SyPromotion\TBK\Promoter;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;
use SyPromotion\TBK\Traits\SetTrackIdTypeTrait;
use SyPromotion\TBK\Traits\SetUniqIdTrait;

/**
 * Class TraceLoginInfoAdd
 *
 * @package SyPromotion\TBK\Promoter
 */
class TraceLoginInfoAdd extends BaseTBK
{
    use SetUniqIdTrait;
    use SetTrackIdTypeTrait;

    /**
     * 淘宝买家昵称
     *
     * @var string
     */
    private $nick = '';
    /**
     * 买家无线设备唯一永久编号
     *
     * @var string
     */
    private $uniq_id = '';
    /**
     * 登录时间,单位为毫秒
     *
     * @var int
     */
    private $login_time = 0;
    /**
     * 平台类型 1:pc 2:mobile 3:TV
     *
     * @var int
     */
    private $track_id_type = 0;

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.trace.logininfo.add');
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setNick(string $nick)
    {
        if (\strlen($nick) > 0) {
            $this->reqData['nick'] = $nick;
        } else {
            throw new TBKException('买家昵称不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setLoginTime(int $loginTime)
    {
        if ($loginTime > 1262275200) {
            $this->reqData['login_time'] = $loginTime * 1000;
        } else {
            throw new TBKException('登录时间不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['nick'])) {
            throw new TBKException('买家昵称不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['uniq_id'])) {
            throw new TBKException('设备编号不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['login_time'])) {
            throw new TBKException('登录时间不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['track_id_type'])) {
            throw new TBKException('平台类型不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
