<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/12/12 0012
 * Time: 9:43
 */
namespace Wx\Payment\Order;

use SyConstant\ErrorCode;
use DesignPatterns\Singletons\WxConfigSingleton;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBasePayment;
use Wx\WxUtilAccount;
use Wx\WxUtilBase;

class PayCommentQueryBatch extends WxBasePayment
{
    /**
     * 公众号ID
     * @var string
     */
    private $appid = '';
    /**
     * 商户号
     * @var string
     */
    private $mch_id = '';
    /**
     * 随机字符串
     * @var string
     */
    private $nonce_str = '';
    /**
     * 签名类型
     * @var string
     */
    private $sign_type = '';
    /**
     * 开始时间
     * @var string
     */
    private $begin_time = '';
    /**
     * 结束时间
     * @var string
     */
    private $end_time = '';
    /**
     * 位移
     * @var int
     */
    private $offset = 0;
    /**
     * 条数
     * @var int
     */
    private $limit = 0;
    /**
     * 输出文件全名
     * @var string
     */
    private $output_file = '';

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.mch.weixin.qq.com/billcommentsp/batchquerycomment';
        $accountConfig = WxConfigSingleton::getInstance()->getAccountConfig($appId);
        $this->reqData['appid'] = $accountConfig->getAppId();
        $this->reqData['mch_id'] = $accountConfig->getPayMchId();
        $this->reqData['nonce_str'] = Tool::createNonceStr(32, 'numlower');
        $this->reqData['sign_type'] = 'HMAC-SHA256';
        $this->reqData['offset'] = 0;
        $this->reqData['limit'] = 100;
    }

    private function __clone()
    {
    }

    /**
     * @param int $beginTime
     * @param int $endTime
     * @throws \SyException\Wx\WxException
     */
    public function setTime(int $beginTime, int $endTime)
    {
        if ($beginTime <= 0) {
            throw new WxException('开始时间不合法', ErrorCode::WX_PARAM_ERROR);
        } elseif ($endTime <= 0) {
            throw new WxException('结束时间不合法', ErrorCode::WX_PARAM_ERROR);
        } elseif ($beginTime > $endTime) {
            throw new WxException('结束时间不能小于开始时间', ErrorCode::WX_PARAM_ERROR);
        }

        $this->reqData['begin_time'] = date('YmdHis', $beginTime);
        $this->reqData['end_time'] = date('YmdHis', $endTime);
    }

    /**
     * @param int $offset
     * @throws \SyException\Wx\WxException
     */
    public function setOffset(int $offset)
    {
        if ($offset >= 0) {
            $this->reqData['offset'] = $offset;
        } else {
            throw new WxException('位移不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param int $limit
     * @throws \SyException\Wx\WxException
     */
    public function setLimit(int $limit)
    {
        if (($limit > 0) && ($limit <= 200)) {
            $this->reqData['limit'] = $limit;
        } else {
            throw new WxException('条数不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param string $outputFile
     */
    public function setOutputFile(string $outputFile)
    {
        if (strlen($outputFile) > 0) {
            $this->output_file = $outputFile;
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['begin_time'])) {
            throw new WxException('开始时间不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['end_time'])) {
            throw new WxException('结束时间不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (strlen($this->output_file) == 0) {
            throw new WxException('输出文件不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        $this->reqData['sign'] = WxUtilAccount::createSign($this->reqData, $this->reqData['appid'], 'sha256');

        $resArr = [
            'code' => 0
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
        if (substr($sendRes, 0, 5) == '<xml>') {
            $sendData = Tool::xmlToArray($sendRes);
            $resArr['code'] = ErrorCode::WX_POST_ERROR;
            $resArr['message'] = $sendData['return_code'] == 'FAIL' ? $sendData['return_msg'] : $sendData['err_code_des'];
        } else {
            file_put_contents($this->output_file, $sendRes);

            $resArr['data'] = [
                'return_code' => 'SUCCESS',
            ];
        }

        return $resArr;
    }
}
