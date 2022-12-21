<?php
/**
 * 删除分账接收方
 * User: 姜伟
 * Date: 2022/12/21
 * Time: 15:30
 */

namespace Wx\Merchant\V3\ProfitSharing;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseMerchantV3;
use Wx\WxUtilBase;

/**
 * Class ReceiverDelete
 *
 * @package Wx\Merchant\V3\ProfitSharing
 */
class ReceiverDelete extends WxBaseMerchantV3
{
    /**
     * 分账接收方类型
     *
     * @var string
     */
    private $type = '';
    /**
     * 分账接收方账号
     *
     * @var string
     */
    private $account = '';

    public function __construct(string $appId)
    {
        parent::__construct($appId);
        $this->serviceUrl = 'https://api.mch.weixin.qq.com/v3/profitsharing/receivers/delete';
        $this->reqMethod = self::REQUEST_METHOD_POST;
        $this->setHeadJson();
        $this->reqData['appid'] = $appId;
    }

    private function __clone()
    {
        //do nothing
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setType(string $type)
    {
        if (\in_array($type, ['MERCHANT_ID', 'PERSONAL_OPENID'])) {
            $this->reqData['type'] = $type;
        } else {
            throw new WxException('分账接收方类型不支持', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setAccount(string $account)
    {
        $accountLength = \strlen($account);
        if ($accountLength <= 0) {
            throw new WxException('分账接收方账号不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if ($accountLength > 64) {
            throw new WxException('分账接收方账号长度不能超过64个字节', ErrorCode::WX_PARAM_ERROR);
        }

        $this->reqData['account'] = $account;
    }

    /**
     * @throws \SyException\Common\CheckException
     * @throws \SyException\Wx\WxException
     */
    public function getDetail(): array
    {
        if (!isset($this->reqData['type'])) {
            throw new WxException('分账接收方类型不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['account'])) {
            throw new WxException('分账接收方账号不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl;
        $this->setHeadAuth();
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs, 2);

        return $this->handleRespJson($sendRes);
    }
}
