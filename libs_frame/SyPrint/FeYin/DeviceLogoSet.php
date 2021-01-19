<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/1/11 0011
 * Time: 8:14
 */

namespace SyPrint\FeYin;

use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyException\SyPrint\FeYinException;
use SyPrint\PrintBaseFeYin;
use SyPrint\PrintUtilBase;
use SyPrint\PrintUtilFeYin;
use SyTool\Tool;

class DeviceLogoSet extends PrintBaseFeYin
{
    /**
     * 应用ID
     *
     * @var string
     */
    private $appid = '';
    /**
     * 机器编号
     *
     * @var string
     */
    private $device_no = '';
    /**
     * LOGO图片链接
     *
     * @var string
     */
    private $path = '';
    /**
     * 图片灰度值
     *
     * @var int
     */
    private $threshold = 0;

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->appid = $appId;
        $this->reqData['threshold'] = 200;
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\SyPrint\FeYinException
     */
    public function setDeviceNo(string $deviceNo)
    {
        if (ctype_digit($deviceNo)) {
            $this->device_no = $deviceNo;
        } else {
            throw new FeYinException('机器编号不合法', ErrorCode::PRINT_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\SyPrint\FeYinException
     */
    public function setPath(string $path)
    {
        if (preg_match(ProjectBase::REGEX_URL_HTTP, $path) > 0) {
            $this->reqData['path'] = $path;
        } else {
            throw new FeYinException('LOGO图片链接不合法', ErrorCode::PRINT_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\SyPrint\FeYinException
     */
    public function setThreshold(int $threshold)
    {
        if (($threshold > 0) && ($threshold <= 255)) {
            $this->reqData['threshold'] = $threshold;
        } else {
            throw new FeYinException('图片灰度值不合法', ErrorCode::PRINT_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (0 == \strlen($this->device_no)) {
            throw new FeYinException('机器编号不能为空', ErrorCode::PRINT_PARAM_ERROR);
        }
        if (!isset($this->reqData['path'])) {
            throw new FeYinException('LOGO图片链接不能为空', ErrorCode::PRINT_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/device/' . $this->device_no . '/setting/logo?access_token=' . PrintUtilFeYin::getAccessToken($this->appid);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $this->curlConfigs[CURLOPT_HTTPHEADER] = [
            'Content-Type: application/json; charset=utf-8',
        ];
        $sendRes = PrintUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if (0 == $sendData['errcode']) {
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::PRINT_POST_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}
