<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/6/19 0019
 * Time: 8:55
 */
namespace SyLogistics\Kd100;

use SyConstant\ErrorCode;
use SyException\Logistics\Kd100Exception;
use SyLogistics\LogisticsBaseKd100;
use SyLogistics\LogisticsUtilKd100;

class ExpressQuery extends LogisticsBaseKd100
{
    /**
     * 快递公司编码
     *
     * @var string
     */
    private $com = '';
    /**
     * 快递单号
     *
     * @var string
     */
    private $num = '';
    /**
     * 手机号码
     *
     * @var string
     */
    private $phone = '';
    /**
     * 出发地
     *
     * @var string
     */
    private $from = '';
    /**
     * 目的地
     *
     * @var string
     */
    private $to = '';
    /**
     * 行政区域解析开通状态
     *
     * @var int
     */
    private $resultv2 = 0;

    public function __construct()
    {
        parent::__construct();
        $this->reqData['resultv2'] = 0;
    }

    private function __clone()
    {
    }

    /**
     * @param string $com
     *
     * @throws \SyException\Logistics\Kd100Exception
     */
    public function setCom(string $com)
    {
        if (ctype_alpha($com)) {
            $this->reqData['com'] = $com;
        } else {
            throw new Kd100Exception('快递公司编码不合法', ErrorCode::LOGISTICS_PARAM_ERROR);
        }
    }

    /**
     * @param string $num
     *
     * @throws \SyException\Logistics\Kd100Exception
     */
    public function setNum(string $num)
    {
        $length = strlen($num);
        if (($length > 0) && ($length <= 32)) {
            $this->reqData['num'] = $num;
        } else {
            throw new Kd100Exception('快递单号不合法', ErrorCode::LOGISTICS_PARAM_ERROR);
        }
    }

    /**
     * @param string $phone
     *
     * @throws \SyException\Logistics\Kd100Exception
     */
    public function setPhone(string $phone)
    {
        if (ctype_digit($phone) && (strlen($phone) == 11) && ($phone[0] == '1')) {
            $this->reqData['phone'] = $phone;
        } else {
            throw new Kd100Exception('手机号码不合法', ErrorCode::LOGISTICS_PARAM_ERROR);
        }
    }

    /**
     * @param string $from
     */
    public function setFrom(string $from)
    {
        $this->reqData['from'] = trim($from);
    }

    /**
     * @param string $to
     */
    public function setTo(string $to)
    {
        $this->reqData['to'] = trim($to);
    }

    /**
     * @param int $resultV2
     *
     * @throws \SyException\Logistics\Kd100Exception
     */
    public function setResultV2(int $resultV2)
    {
        if (in_array($resultV2, [0, 1])) {
            $this->reqData['resultv2'] = $resultV2;
        } else {
            throw new Kd100Exception('行政区域解析开通状态不合法', ErrorCode::LOGISTICS_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['com'])) {
            throw new Kd100Exception('快递公司编码不能为空', ErrorCode::LOGISTICS_PARAM_ERROR);
        }
        if (!isset($this->reqData['num'])) {
            throw new Kd100Exception('快递单号不能为空', ErrorCode::LOGISTICS_PARAM_ERROR);
        }
        $signRes = LogisticsUtilKd100::createSign($this->reqData);
        $this->curlConfigs[CURLOPT_POST] = true;
        $this->curlConfigs[CURLOPT_POSTFIELDS] = http_build_query($signRes);

        return $this->getContent();
    }
}
