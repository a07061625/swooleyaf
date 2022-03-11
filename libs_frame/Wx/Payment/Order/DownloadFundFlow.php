<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/12/12 0012
 * Time: 9:43
 */

namespace Wx\Payment\Order;

use DesignPatterns\Singletons\WxConfigSingleton;
use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBasePayment;
use Wx\WxUtilAccount;
use Wx\WxUtilBase;

class DownloadFundFlow extends WxBasePayment
{
    const ACCOUNT_TYPE_BASIC = 'Basic';
    const ACCOUNT_TYPE_OPERATION = 'Operation';
    const ACCOUNT_TYPE_FEES = 'Fees';

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
     * 随机字符串
     *
     * @var string
     */
    private $nonce_str = '';
    /**
     * 签名类型
     *
     * @var string
     */
    private $sign_type = '';
    /**
     * 资金账单日期
     *
     * @var string
     */
    private $bill_date = '';
    /**
     * 资金账户类型
     *
     * @var string
     */
    private $account_type = '';
    /**
     * 压缩账单
     *
     * @var string
     */
    private $tar_type = '';
    /**
     * 输出文件全名
     *
     * @var string
     */
    private $output_file = '';
    /**
     * 资金账户类型列表
     *
     * @var array
     */
    private static $totalAccountType = [
        self::ACCOUNT_TYPE_BASIC => 1,
        self::ACCOUNT_TYPE_OPERATION => 1,
        self::ACCOUNT_TYPE_FEES => 1,
    ];

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.mch.weixin.qq.com/pay/downloadfundflow';
        $accountConfig = WxConfigSingleton::getInstance()->getAccountConfig($appId);
        $this->reqData['appid'] = $accountConfig->getAppId();
        $this->reqData['mch_id'] = $accountConfig->getPayMchId();
        $this->reqData['nonce_str'] = Tool::createNonceStr(32, 'numlower');
        $this->reqData['sign_type'] = 'HMAC-SHA256';
        $this->reqData['tar_type'] = 'GZIP';
    }

    private function __clone()
    {
        //do nothing
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setBillDate(string $billDate)
    {
        if (ctype_digit($billDate) && (8 == \strlen($billDate))) {
            $this->reqData['bill_date'] = $billDate;
        } else {
            throw new WxException('资金账单日期不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setAccountType(string $accountType)
    {
        if (isset(self::$totalAccountType[$accountType])) {
            $this->reqData['account_type'] = $accountType;
        } else {
            throw new WxException('资金账户类型不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function setOutputFile(string $outputFile)
    {
        if (\strlen($outputFile) > 0) {
            $this->output_file = $outputFile;
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['bill_date'])) {
            throw new WxException('资金账单日期不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['account_type'])) {
            throw new WxException('资金账户类型不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (0 == \strlen($this->output_file)) {
            throw new WxException('输出文件不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        $this->reqData['sign'] = WxUtilAccount::createSign($this->reqData, $this->reqData['appid'], 'sha256');

        $resArr = [
            'code' => 0,
        ];

        $accountConfig = WxConfigSingleton::getInstance()->getAccountConfig($this->reqData['appid']);
        $tmpKey = tmpfile();
        fwrite($tmpKey, $accountConfig->getSslKey());
        $tmpKeyData = stream_get_meta_data($tmpKey);
        $tmpCert = tmpfile();
        fwrite($tmpCert, $accountConfig->getSslCert());
        $tmpCertData = stream_get_meta_data($tmpCert);
        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl;
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::arrayToXml($this->reqData);
        $this->curlConfigs[CURLOPT_SSLCERTTYPE] = 'PEM';
        $this->curlConfigs[CURLOPT_SSLCERT] = $tmpCertData['uri'];
        $this->curlConfigs[CURLOPT_SSLKEYTYPE] = 'PEM';
        $this->curlConfigs[CURLOPT_SSLKEY] = $tmpKeyData['uri'];
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);
        fclose($tmpKey);
        fclose($tmpCert);
        if ('<xml>' == substr($sendRes, 0, 5)) {
            $sendData = Tool::xmlToArray($sendRes);
            $resArr['code'] = ErrorCode::WX_POST_ERROR;
            $resArr['message'] = 'FAIL' == $sendData['return_code'] ? $sendData['return_msg'] : $sendData['err_code_des'];
        } else {
            file_put_contents($this->output_file, $sendRes);

            $resArr['data'] = [
                'return_code' => 'SUCCESS',
            ];
        }

        return $resArr;
    }
}
