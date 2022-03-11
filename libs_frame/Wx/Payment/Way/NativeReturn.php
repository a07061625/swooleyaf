<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/12 0012
 * Time: 16:31
 */

namespace Wx\Payment\Way;

use DesignPatterns\Singletons\WxConfigSingleton;
use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use Wx\WxBasePayment;
use Wx\WxUtilAccount;

class NativeReturn extends WxBasePayment
{
    /**
     * 返回状态码
     *
     * @var string
     */
    private $return_code = '';

    /**
     * 返回信息
     *
     * @var string
     */
    private $return_msg = '';

    /**
     * 公众号ID
     *
     * @var string
     */
    private $appid = '';

    /**
     * 商户号
     *
     * @var string
     */
    private $mch_id = '';

    /**
     * 微信返回的随机字符串
     *
     * @var string
     */
    private $nonce_str = '';

    /**
     * 预支付ID
     *
     * @var string
     */
    private $prepay_id = '';

    /**
     * 业务结果
     *
     * @var string
     */
    private $result_code = '';

    /**
     * 错误描述
     *
     * @var string
     */
    private $err_code_des = '';

    public function __construct(string $appId)
    {
        parent::__construct();
        $accountConfig = WxConfigSingleton::getInstance()->getAccountConfig($appId);
        $this->reqData['appid'] = $accountConfig->getAppId();
        $this->reqData['mch_id'] = $accountConfig->getPayMchId();
        $this->reqData['result_code'] = 'SUCCESS';
        $this->reqData['return_code'] = 'SUCCESS';
    }

    public function __clone()
    {
        //do nothing
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setNonceStr(string $nonceStr)
    {
        if (ctype_alnum($nonceStr)) {
            $this->reqData['nonce_str'] = $nonceStr;
        } else {
            throw new WxException('随机字符串不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setPrepayId(string $prepayId)
    {
        if (ctype_alnum($prepayId)) {
            $this->reqData['prepay_id'] = $prepayId;
        } else {
            throw new WxException('预支付ID不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param string $errDes    返回给用户的错误描述
     * @param string $returnMsg 返回微信的信息
     *
     * @throws \SyException\Wx\WxException
     */
    public function setErrorMsg(string $errDes, string $returnMsg)
    {
        if (0 == \strlen($errDes)) {
            throw new WxException('错误描述不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (0 == \strlen($returnMsg)) {
            throw new WxException('返回信息不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $this->reqData['return_code'] = 'FAIL';
        $this->reqData['return_msg'] = mb_substr($returnMsg, 0, 40);
        $this->reqData['result_code'] = 'FAIL';
        $this->reqData['err_code_des'] = mb_substr($errDes, 0, 40);
    }

    public function getDetail(): array
    {
        if ('SUCCESS' == $this->reqData['return_code']) {
            if (!isset($this->reqData['nonce_str'])) {
                throw new WxException('随机字符串不能为空', ErrorCode::WX_PARAM_ERROR);
            }
            if (!isset($this->reqData['prepay_id'])) {
                throw new WxException('预支付ID不能为空', ErrorCode::WX_PARAM_ERROR);
            }
        }
        $this->reqData['sign'] = WxUtilAccount::createSign($this->reqData, $this->reqData['appid']);

        return $this->reqData;
    }
}
