<?php

namespace Wx\Corp\Invoice;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseCorp;
use Wx\WxTraitCorp;
use Wx\WxUtilBase;

/**
 * 批量查询电子发票
 *
 * @package Wx\Corp\Invoice
 */
class InvoiceInfoGetBatch extends WxBaseCorp
{
    use WxTraitCorp;

    /**
     * 发票列表
     *
     * @var array
     */
    private $item_list = [];

    public function __construct(string $corpId, string $agentTag)
    {
        parent::__construct();
        $this->serviceUrl = 'https://qyapi.weixin.qq.com/cgi-bin/card/invoice/reimburse/getinvoiceinfobatch?access_token=';
        $this->reqData['item_list'] = [];
        $this->_corpId = $corpId;
        $this->_agentTag = $agentTag;
    }

    private function __clone()
    {
        //do nothing
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setItemList(array $itemList)
    {
        if (empty($itemList)) {
            throw new WxException('发票列表不合法', ErrorCode::WX_PARAM_ERROR);
        }

        $this->reqData['item_list'] = $itemList;
    }

    public function getDetail(): array
    {
        if (empty($this->reqData['item_list'])) {
            throw new WxException('发票列表不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . $this->getAccessToken($this->_tokenType, $this->_corpId, $this->_agentTag);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if (0 == $sendData['errcode']) {
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::WX_POST_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}
