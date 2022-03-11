<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/12/14 0014
 * Time: 16:01
 */

namespace Wx\Merchant\PostageTemplate;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseMerchant;
use Wx\WxUtilBase;
use Wx\WxUtilMerchant;

class TemplateAdd extends WxBaseMerchant
{
    /**
     * 公众号ID
     *
     * @var string
     */
    private $appid = '';
    /**
     * 模板名称
     *
     * @var string
     */
    private $Name = '';
    /**
     * 支付方式(0-买家承担运费 1-卖家承担运费)
     *
     * @var int
     */
    private $Assumer = 0;
    /**
     * 计费单位(0-按件计费 1-按重量计费 2-按体积计费 目前只支持按件计费,默认为0)
     *
     * @var int
     */
    private $Valuation = 0;
    /**
     * 运费计算列表
     *
     * @var array
     */
    private $TopFee = [];

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/merchant/express/add?access_token=';
        $this->appid = $appId;
        $this->reqData['Valuation'] = 0;
    }

    private function __clone()
    {
        //do nothing
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setName(string $name)
    {
        if (0 == \strlen($name)) {
            $this->reqData['Name'] = $name;
        } else {
            throw new WxException('模板名称不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setAssumer(int $assumer)
    {
        if (\in_array($assumer, [0, 1], true)) {
            $this->reqData['Assumer'] = $assumer;
        } else {
            throw new WxException('支付方式不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function setTopFee(array $feeList)
    {
        foreach ($feeList as $eFee) {
            if (isset($eFee['Type']) && ctype_digit($eFee['Type'])) {
                $this->TopFee[$eFee['Type']] = $eFee;
            }
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function addFee(array $feeInfo)
    {
        if (isset($feeInfo['Type']) && ctype_digit($feeInfo['Type'])) {
            $this->TopFee[$feeInfo['Type']] = $feeInfo;
        } else {
            throw new WxException('运费计算信息不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['Name'])) {
            throw new WxException('模板名称不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['Assumer'])) {
            throw new WxException('支付方式不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (empty($this->TopFee)) {
            throw new WxException('运费计算列表不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        $this->reqData['TopFee'] = array_values($this->TopFee);

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilMerchant::getAccessToken($this->appid);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode([
            'delivery_template' => $this->reqData,
        ], JSON_UNESCAPED_UNICODE);
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
