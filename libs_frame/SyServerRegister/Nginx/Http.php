<?php
/**
 * nginx http服务注册
 * User: 姜伟
 * Date: 2020/7/18 0018
 * Time: 21:08
 */
namespace SyServerRegister\Nginx;

use SyServerRegister\IRegister;
use SyTool\Tool;

/**
 * Class Http
 * @package SyServerRegister\Nginx
 */
class Http extends Base implements IRegister
{
    public function __construct()
    {
        parent::__construct();
    }

    private function __clone()
    {
    }

    protected function checkData()
    {
        $this->checkCommonData();
    }

    private function sendReq() : array
    {
        $sendRes = Tool::sendCurlReq([
            CURLOPT_URL => $this->url,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_HEADER => false,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/x-www-form-urlencoded;charset=utf-8',
            ],
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => http_build_query($this->reqData),
            CURLOPT_TIMEOUT_MS => 3000,
        ]);
        if ($sendRes['res_no'] > 0) {
            return [
                'code' => $sendRes['res_no'],
                'msg' => $sendRes['res_msg'],
            ];
        }

        $resData = Tool::jsonDecode($sendRes['res_content']);
        if (isset($resData['code'])) {
            return $resData;
        }

        return [
            'code' => 9999,
            'msg' => $sendRes['res_content'],
        ];
    }

    public function operatorServer(string $action) : array
    {
        if ($action == 'remove') {
            $this->setIsDown(1);
        }
        $this->checkData();

        return $this->sendReq();
    }
}
