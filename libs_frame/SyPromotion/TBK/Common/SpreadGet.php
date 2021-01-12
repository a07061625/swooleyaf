<?php
/**
 * 长链转短链
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:38
 */

namespace SyPromotion\TBK\Common;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;
use SyTool\Tool;

/**
 * Class SpreadGet
 *
 * @package SyPromotion\TBK\Common
 */
class SpreadGet extends BaseTBK
{
    /**
     * 请求列表
     *
     * @var array
     */
    private $requests = [];

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.spread.get');
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setRequests(array $requests)
    {
        $reqList = [];
        foreach ($requests as $eRequest) {
            $trueUrl = isset($eRequest['url']) && \is_string($eRequest['url']) ? trim($eRequest['url']) : '';
            if (\strlen($trueUrl) > 0) {
                $reqList[] = [
                    'url' => $trueUrl,
                ];
            }
        }
        if (empty($reqList)) {
            throw new TBKException('请求列表不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        $this->reqData['requests'] = Tool::jsonEncode($reqList, JSON_UNESCAPED_UNICODE);
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['requests'])) {
            throw new TBKException('请求列表不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
