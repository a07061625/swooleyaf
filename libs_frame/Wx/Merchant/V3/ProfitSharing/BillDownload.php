<?php
/**
 * 下载分账账单
 * User: 姜伟
 * Date: 2022/12/21
 * Time: 15:30
 */

namespace Wx\Merchant\V3\ProfitSharing;

use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseMerchantV3;
use Wx\WxUtilBase;

/**
 * Class BillDownload
 *
 * @package Wx\Merchant\V3\ProfitSharing
 */
class BillDownload extends WxBaseMerchantV3
{
    /**
     * 下载地址
     *
     * @var string
     */
    private $download_url = '';
    /**
     * 输出目录
     *
     * @var string
     */
    private $output_dir = '';

    /**
     * 输出文件名
     *
     * @var string
     */
    private $output_name = '';

    /**
     * @throws \Exception
     */
    public function __construct(string $appId)
    {
        parent::__construct($appId);
        $this->reqMethod = self::REQUEST_METHOD_GET;
        $this->output_name = $appId . '_' . Tool::getNowTime() . '_' . Tool::createNonceStr(8, 'numlower');
    }

    private function __clone()
    {
        //do nothing
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setDownloadUrl(string $downloadUrl)
    {
        if (preg_match(ProjectBase::REGEX_URL_HTTP, $downloadUrl) > 0) {
            $this->serviceUrl = $downloadUrl;
        } else {
            throw new WxException('下载地址不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setOutputDir(string $outputDir)
    {
        if (is_dir($outputDir) && is_writable($outputDir)) {
            $this->output_dir = '/' == substr($outputDir, -1) ? $outputDir : $outputDir . '/';
        } else {
            throw new WxException('输出目录不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setOutputName(string $outputName)
    {
        if (0 == \strlen($outputName)) {
            throw new WxException('输出文件名不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (false === strpos($outputName, '/')) {
            throw new WxException('输出文件名不合法', ErrorCode::WX_PARAM_ERROR);
        }

        $this->output_name = $outputName;
    }

    /**
     * @throws \SyException\Common\CheckException
     * @throws \SyException\Wx\WxException
     * @throws \Exception
     */
    public function getDetail(): array
    {
        if (0 == \strlen($this->serviceUrl)) {
            throw new WxException('下载地址不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (0 == \strlen($this->output_dir)) {
            throw new WxException('输出目录不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl;
        $this->setHeadAuth();
        $sendRes = WxUtilBase::sendGetReq($this->curlConfigs, 2);
        if (200 == $sendRes['res_code']) {
            $fileName = $this->output_dir . $this->output_name . '.xlsx';
            file_put_contents($fileName, $sendRes['res_content']);

            $resArr['data'] = [
                'file_name' => $fileName,
            ];
        } else {
            $resArr['code'] = $sendRes['res_code'];
            $resArr['msg'] = \strlen($sendRes['res_content']) > 0 ? $sendRes['res_content'] : '微信请求出错~';
        }

        return $resArr;
    }
}
