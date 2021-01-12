<?php
/**
 * 日志上报
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:40
 */

namespace SyPromotion\TBK\Provider;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;

/**
 * Class DataReport
 *
 * @package SyPromotion\TBK\Provider
 */
class DataReport extends BaseTBK
{
    /**
     * 日志类型 1:推广日志 2:内容日志
     *
     * @var string
     */
    private $type = '';
    /**
     * 日志内容
     *
     * @var string
     */
    private $data = '';

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.data.report');
        $this->reqData['type'] = '1';
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setType(string $type)
    {
        if (\in_array($type, ['1', '2'])) {
            $this->reqData['type'] = $type;
        } else {
            throw new TBKException('日志类型不支持', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setData(string $data)
    {
        if ('dataId=' == substr($data, 0, 7)) {
            $this->reqData['data'] = $data;
        } else {
            throw new TBKException('日志内容不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['data'])) {
            throw new TBKException('日志内容不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
