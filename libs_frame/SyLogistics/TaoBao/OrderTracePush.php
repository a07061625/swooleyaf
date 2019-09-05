<?php
/**
 * 物流订单流转信息推送接口
 * User: 姜伟
 * Date: 2019/7/12 0012
 * Time: 9:56
 */
namespace SyLogistics\TaoBao;

use SyConstant\ErrorCode;
use SyException\Logistics\TaoBaoException;
use SyLogistics\LogisticsBaseTaoBao;

class OrderTracePush extends LogisticsBaseTaoBao
{
    /**
     * 快递单号
     * @var string
     */
    private $mail_no = '';
    /**
     * 流转节点发生时间
     * @var string
     */
    private $occure_time = '';
    /**
     * 流转节点详情
     * @var string
     */
    private $operate_detail = '';
    /**
     * 物流公司名称
     * @var string
     */
    private $company_name = '';
    /**
     * 快递业务员名称
     * @var string
     */
    private $operator_name = '';
    /**
     * 快递业务员联系方式
     * @var string
     */
    private $operator_contact = '';
    /**
     * 流转节点城市
     * @var string
     */
    private $current_city = '';
    /**
     * 网点名称
     * @var string
     */
    private $facility_name = '';
    /**
     * 流转节点描述 TMS_ACCEPT:揽收 TMS_DELIVERING:派送 TMS_SIGN:签收
     * @var string
     */
    private $node_description = '';

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.logistics.ordertrace.push');
    }

    private function __clone()
    {
    }

    /**
     * @param string $mailNo
     * @throws \SyException\Logistics\TaoBaoException
     */
    public function setMailNo(string $mailNo)
    {
        if (strlen($mailNo) > 0) {
            $this->reqData['mail_no'] = $mailNo;
        } else {
            throw new TaoBaoException('快递单号不能为空', ErrorCode::LOGISTICS_PARAM_ERROR);
        }
    }

    /**
     * @param int $occureTime
     * @throws \SyException\Logistics\TaoBaoException
     */
    public function setOccureTime(int $occureTime)
    {
        if ($occureTime > 0) {
            $this->reqData['occure_time'] = date('Y-m-d H:i:s', $occureTime);
        } else {
            throw new TaoBaoException('流转节点发生时间不能为空', ErrorCode::LOGISTICS_PARAM_ERROR);
        }
    }

    /**
     * @param string $operateDetail
     * @throws \SyException\Logistics\TaoBaoException
     */
    public function setOperateDetail(string $operateDetail)
    {
        $length = strlen($operateDetail);
        if ($length == 0) {
            throw new TaoBaoException('流转节点详情不能为空', ErrorCode::LOGISTICS_PARAM_ERROR);
        } elseif ($length > 200) {
            throw new TaoBaoException('流转节点详情长度不能超过200字节', ErrorCode::LOGISTICS_PARAM_ERROR);
        }

        $this->reqData['operate_detail'] = $operateDetail;
    }

    /**
     * @param string $companyName
     * @throws \SyException\Logistics\TaoBaoException
     */
    public function setCompanyName(string $companyName)
    {
        $length = strlen($companyName);
        if ($length == 0) {
            throw new TaoBaoException('物流公司名称不能为空', ErrorCode::LOGISTICS_PARAM_ERROR);
        } elseif ($length > 20) {
            throw new TaoBaoException('物流公司名称长度不能超过20字节', ErrorCode::LOGISTICS_PARAM_ERROR);
        }

        $this->reqData['company_name'] = $companyName;
    }

    /**
     * @param string $operatorName
     * @throws \SyException\Logistics\TaoBaoException
     */
    public function setOperatorName(string $operatorName)
    {
        $length = strlen($operatorName);
        if ($length == 0) {
            throw new TaoBaoException('快递业务员名称不能为空', ErrorCode::LOGISTICS_PARAM_ERROR);
        } elseif ($length > 20) {
            throw new TaoBaoException('快递业务员名称长度不能超过20字节', ErrorCode::LOGISTICS_PARAM_ERROR);
        }

        $this->reqData['operator_name'] = $operatorName;
    }

    /**
     * @param string $operatorContact
     * @throws \SyException\Logistics\TaoBaoException
     */
    public function setOperatorContact(string $operatorContact)
    {
        $length = strlen($operatorContact);
        if ($length == 0) {
            throw new TaoBaoException('快递业务员联系方式不能为空', ErrorCode::LOGISTICS_PARAM_ERROR);
        } elseif ($length > 20) {
            throw new TaoBaoException('快递业务员联系方式长度不能超过20字节', ErrorCode::LOGISTICS_PARAM_ERROR);
        }

        $this->reqData['operator_contact'] = $operatorContact;
    }

    /**
     * @param string $currentCity
     * @throws \SyException\Logistics\TaoBaoException
     */
    public function setCurrentCity(string $currentCity)
    {
        $length = strlen($currentCity);
        if ($length == 0) {
            throw new TaoBaoException('流转节点城市不能为空', ErrorCode::LOGISTICS_PARAM_ERROR);
        } elseif ($length > 20) {
            throw new TaoBaoException('流转节点城市长度不能超过20字节', ErrorCode::LOGISTICS_PARAM_ERROR);
        }

        $this->reqData['current_city'] = $currentCity;
    }

    /**
     * @param string $facilityName
     * @throws \SyException\Logistics\TaoBaoException
     */
    public function setFacilityName(string $facilityName)
    {
        $length = strlen($facilityName);
        if ($length == 0) {
            throw new TaoBaoException('网点名称不能为空', ErrorCode::LOGISTICS_PARAM_ERROR);
        } elseif ($length > 100) {
            throw new TaoBaoException('网点名称长度不能超过100字节', ErrorCode::LOGISTICS_PARAM_ERROR);
        }

        $this->reqData['facility_name'] = $facilityName;
    }

    /**
     * @param string $nodeDescription
     * @throws \SyException\Logistics\TaoBaoException
     */
    public function setNodeDescription(string $nodeDescription)
    {
        if (in_array($nodeDescription, ['TMS_ACCEPT', 'TMS_DELIVERING', 'TMS_SIGN'])) {
            $this->reqData['node_description'] = $nodeDescription;
        } else {
            throw new TaoBaoException('流转节点描述不合法', ErrorCode::LOGISTICS_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['mail_no'])) {
            throw new TaoBaoException('快递单号不能为空', ErrorCode::LOGISTICS_PARAM_ERROR);
        }
        if (!isset($this->reqData['occure_time'])) {
            throw new TaoBaoException('流转节点发生时间不能为空', ErrorCode::LOGISTICS_PARAM_ERROR);
        }
        if (!isset($this->reqData['operate_detail'])) {
            throw new TaoBaoException('流转节点详情不能为空', ErrorCode::LOGISTICS_PARAM_ERROR);
        }
        if (!isset($this->reqData['company_name'])) {
            throw new TaoBaoException('物流公司名称不能为空', ErrorCode::LOGISTICS_PARAM_ERROR);
        }
        return $this->getContent();
    }
}
