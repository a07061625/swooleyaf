<?php
namespace Wx\Corp\Invoice;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use Tool\Tool;
use Wx\WxBaseCorp;
use Wx\WxTraitCorp;
use Wx\WxUtilBase;

/**
 * 批量更新发票状态
 * @package Wx\Corp\Invoice
 */
class InvoiceStatusUpdateBatch extends WxBaseCorp
{
    use WxTraitCorp;

    /**
     * 用户openid
     * @var string
     */
    private $openid = '';
    /**
     * 报销状态
     * @var string
     */
    private $reimburse_status = '';
    /**
     * 发票列表
     * @var array
     */
    private $invoice_list = [];

    public function __construct(string $corpId, string $agentTag)
    {
        parent::__construct();
        $this->serviceUrl = 'https://qyapi.weixin.qq.com/cgi-bin/card/invoice/reimburse/updatestatusbatch?access_token=';
        $this->reqData['invoice_list'] = [];
        $this->_corpId = $corpId;
        $this->_agentTag = $agentTag;
    }

    private function __clone()
    {
    }

    /**
     * @param string $openid
     * @throws \SyException\Wx\WxException
     */
    public function setOpenid(string $openid)
    {
        if (preg_match('/^[0-9a-zA-Z\-\_]{28}$/', $openid) > 0) {
            $this->reqData['openid'] = $openid;
        } else {
            throw new WxException('用户openid不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param string $reimburseStatus
     * @throws \SyException\Wx\WxException
     */
    public function setReimburseStatus(string $reimburseStatus)
    {
        if (isset(self::$totalInvoiceReimburseStatus[$reimburseStatus])) {
            $this->reqData['reimburse_status'] = $reimburseStatus;
        } else {
            throw new WxException('报销状态不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param array $invoiceList
     * @throws \SyException\Wx\WxException
     */
    public function setInvoiceList(array $invoiceList)
    {
        if (empty($invoiceList)) {
            throw new WxException('发票列表不合法', ErrorCode::WX_PARAM_ERROR);
        }

        $this->reqData['invoice_list'] = $invoiceList;
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['openid'])) {
            throw new WxException('用户openid不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['reimburse_status'])) {
            throw new WxException('报销状态不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (empty($this->reqData['invoice_list'])) {
            throw new WxException('发票列表不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . $this->getAccessToken($this->_tokenType, $this->_corpId, $this->_agentTag);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if ($sendData['errcode'] == 0) {
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::WX_POST_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}
