<?php

namespace Wx\Corp\Invoice;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseCorp;
use Wx\WxTraitCorp;
use Wx\WxUtilBase;

/**
 * 查询电子发票
 *
 * @package Wx\Corp\Invoice
 */
class InvoiceInfoGet extends WxBaseCorp
{
    use WxTraitCorp;

    /**
     * 发票id
     *
     * @var string
     */
    private $card_id = '';
    /**
     * 加密密码
     *
     * @var string
     */
    private $encrypt_code = '';

    public function __construct(string $corpId, string $agentTag)
    {
        parent::__construct();
        $this->serviceUrl = 'https://qyapi.weixin.qq.com/cgi-bin/card/invoice/reimburse/getinvoiceinfo?access_token=';
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
    public function setCardId(string $cardId)
    {
        if (\strlen($cardId) > 0) {
            $this->reqData['card_id'] = $cardId;
        } else {
            throw new WxException('发票id不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setEncryptCode(string $encryptCode)
    {
        if (\strlen($encryptCode) > 0) {
            $this->reqData['encrypt_code'] = $encryptCode;
        } else {
            throw new WxException('加密密码不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['card_id'])) {
            throw new WxException('发票id不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['encrypt_code'])) {
            throw new WxException('加密密码不能为空', ErrorCode::WX_PARAM_ERROR);
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
