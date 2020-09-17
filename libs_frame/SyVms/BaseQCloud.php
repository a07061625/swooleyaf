<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/5/6 0006
 * Time: 19:11
 */
namespace SyVms;

use SyTool\Tool;

/**
 * Class BaseQCloud
 * @package SyVms
 */
abstract class BaseQCloud extends Base
{
    /**
     * 服务地址
     * @var string
     */
    protected $serviceUrl = '';

    public function __construct()
    {
        parent::__construct();
    }

    protected function refreshSign(array $data)
    {
        $createRes = UtilQCloud::createSign($data);
        $this->reqData['sig'] = $createRes['sign'];
        $this->reqData['time'] = $createRes['time'];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . '?' . http_build_query([
            'sdkappid' => $createRes['app_id'],
            'random' => $createRes['random'],
        ]);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
    }

    protected function getContent() : array
    {
        $this->curlConfigs[CURLOPT_SSL_VERIFYPEER] = false;
        $this->curlConfigs[CURLOPT_SSL_VERIFYHOST] = false;
        $this->curlConfigs[CURLOPT_HEADER] = false;
        $this->curlConfigs[CURLOPT_POST] = true;
        $this->curlConfigs[CURLOPT_RETURNTRANSFER] = true;
        if (!isset($this->curlConfigs[CURLOPT_TIMEOUT_MS])) {
            $this->curlConfigs[CURLOPT_TIMEOUT_MS] = 3000;
        }
        return $this->curlConfigs;
    }
}
