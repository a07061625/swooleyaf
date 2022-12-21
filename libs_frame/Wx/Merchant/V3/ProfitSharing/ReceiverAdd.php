<?php
/**
 * 添加分账接收方
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
use Wx\WxUtilPayment;

/**
 * Class ReceiverAdd
 *
 * @package Wx\Merchant\V3\ProfitSharing
 */
class ReceiverAdd extends WxBaseMerchantV3
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
    /**
     * 分账接收方姓名
     *
     * @var string
     */
    private $name = '';
    /**
     * 关系类型
     *
     * @var string
     */
    private $relation_type = '';
    /**
     * 自定义分账关系
     *
     * @var string
     */
    private $custom_relation = '';

    public function __construct(string $appId)
    {
        parent::__construct($appId);
        $this->serviceUrl = 'https://api.mch.weixin.qq.com/v3/profitsharing/receivers/add';
        $this->reqMethod = self::REQUEST_METHOD_POST;
        $this->setHeadJson();
        $this->reqData['appid'] = $appId;
        $this->reqData['relation_type'] = '';
        $this->reqData['custom_relation'] = '';
    }

    private function __clone()
    {
        //do nothing
    }

    /**
     * @param string $v3PublicKey V3平台证书公钥
     *
     * @throws \SyException\Wx\WxException
     */
    public function setTypeAndName(string $type, string $name, string $v3PublicKey)
    {
        if (!\in_array($type, ['MERCHANT_ID', 'PERSONAL_OPENID'])) {
            throw new WxException('分账接收方类型不支持', ErrorCode::WX_PARAM_ERROR);
        }

        $trueName = trim($name);
        $nameLength = \strlen($trueName);
        if ($nameLength > 1024) {
            throw new WxException('分账接收方姓名长度不能超过1024个字节', ErrorCode::WX_PARAM_ERROR);
        }
        if ((0 == $nameLength) && ('MERCHANT_ID' == $type)) {
            throw new WxException('商户全称不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (($nameLength > 0) && (0 == \strlen($v3PublicKey))) {
            throw new WxException('V3平台证书公钥不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $this->reqData['type'] = $type;
        if ($nameLength > 0) {
            $this->reqData['name'] = WxUtilPayment::v3Encrypt($trueName, $v3PublicKey);
        } else {
            unset($this->reqData['name']);
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
     * @throws \SyException\Wx\WxException
     */
    public function setRelationType(string $relationType)
    {
        if (\in_array($relationType, [
            'STORE',
            'STAFF',
            'STORE_OWNER',
            'PARTNER',
            'HEADQUARTER',
            'BRAND',
            'DISTRIBUTOR',
            'USER',
            'SUPPLIER',
            'CUSTOM',
        ])) {
            $this->reqData['relation_type'] = $relationType;
        } else {
            throw new WxException('关系类型不支持', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setCustomRelation(string $customRelation)
    {
        $relationLength = \strlen($customRelation);
        if ($relationLength > 10) {
            throw new WxException('自定义分账关系长度不能超过10个字节', ErrorCode::WX_PARAM_ERROR);
        }
        if ((0 == $relationLength) && ('CUSTOM' == $this->reqData['relation_type'])) {
            throw new WxException('自定义分账关系不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $this->reqData['custom_relation'] = $customRelation;
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
        if (0 == \strlen($this->reqData['relation_type'])) {
            throw new WxException('关系类型不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (('CUSTOM' == $this->reqData['relation_type']) && (0 == \strlen($this->reqData['custom_relation']))) {
            throw new WxException('自定义分账关系不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl;
        $this->setHeadAuth();
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs, 2);

        return $this->handleRespJson($sendRes);
    }
}
