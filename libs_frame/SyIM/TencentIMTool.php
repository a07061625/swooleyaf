<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/7/7 0007
 * Time: 16:44
 */
namespace SyIM;

use SyConstant\ErrorCode;
use DesignPatterns\Singletons\IMConfigSingleton;
use SyException\IM\TencentException;
use ProjectCache\IMAccount;
use SyIM\Tencent\SingleChatMsg;
use SyIM\Tencent\UserImport;
use SyIM\Tencent\UserInformation;
use SyTool\Tool;
use SyTrait\SimpleTrait;

class TencentIMTool
{
    use SimpleTrait;

    const IM_RSP_SUCCESS = 'OK';
    const IM_RSP_FAIL = 'FAIL';

    /**
     * 生成签名
     * @param string $userTag 用户标识
     * @return string
     * @throws \SyException\IM\TencentException
     */
    public static function createSign(string $userTag)
    {
        $output = [];
        $commandStatus = 0;
        $command = IMConfigSingleton::getInstance()->getTencentConfig()->getCommandSign()
                   . ' ' . escapeshellarg(IMConfigSingleton::getInstance()->getTencentConfig()->getPrivateKey())
                   . ' ' . escapeshellarg(IMConfigSingleton::getInstance()->getTencentConfig()->getAppId())
                   . ' ' . escapeshellarg($userTag);
        exec($command, $output, $commandStatus);
        if ($commandStatus == -1) {
            throw new TencentException('生成即时通讯签名失败', ErrorCode::IM_SIGN_ERROR);
        }

        return $output[0];
    }

    /**
     * 导入用户账号
     * @param \SyIM\Tencent\UserImport $userImport
     * @return array
     */
    public static function importUserAccount(UserImport $userImport)
    {
        $resArr = [
            'code' => 0,
        ];

        $url = self::getReqUrl('import_user_account');
        $importRes = self::sendPostReq($url, 'json', $userImport->getDetail(), [
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
        ]);
        $importData = Tool::jsonDecode($importRes);
        if ($importData['ActionStatus'] == self::IM_RSP_SUCCESS) {
            $resArr['data'] = $importData;
        } else {
            $resArr['code'] = ErrorCode::IM_POST_ERROR;
            $resArr['message'] = $importData['ErrorInfo'];
        }

        return $resArr;
    }

    /**
     * 设置用户资料
     * @param \SyIM\Tencent\UserInformation $information
     * @return array
     */
    public static function setUserInformation(UserInformation $information)
    {
        $resArr = [
            'code' => 0,
        ];

        $url = self::getReqUrl('update_user_info');
        $importRes = self::sendPostReq($url, 'json', $information->getDetail(), [
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
        ]);
        $importData = Tool::jsonDecode($importRes);
        if ($importData['ActionStatus'] == self::IM_RSP_SUCCESS) {
            $resArr['data'] = $importData;
        } else {
            $resArr['code'] = ErrorCode::IM_POST_ERROR;
            $resArr['message'] = strlen($importData['ErrorDisplay']) > 0 ? $importData['ErrorDisplay'] : $importData['ErrorInfo'];
        }

        return $resArr;
    }

    /**
     * 发送单聊消息
     * @param \SyIM\Tencent\SingleChatMsg $chatMsg
     * @return array
     */
    public static function sendSingleMsg(SingleChatMsg $chatMsg)
    {
        $resArr = [
            'code' => 0,
        ];

        $url = self::getReqUrl('send_single_msg');
        $sendRes = self::sendPostReq($url, 'json', $chatMsg->getDetail(), [
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
        ]);
        $sendData = Tool::jsonDecode($sendRes);
        if ($sendData['ActionStatus'] == self::IM_RSP_SUCCESS) {
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::IM_POST_ERROR;
            $resArr['message'] = $sendData['ErrorInfo'];
        }

        return $resArr;
    }

    /**
     * 获取请求地址
     * @param string $tag
     * @return string
     * @throws \SyException\IM\TencentException
     */
    private static function getReqUrl(string $tag)
    {
        $url = 'https://console.tim.qq.com/v4';

        switch ($tag) {
            case 'import_user_account':
                $url .= '/im_open_login_svc/account_import';
                break;
            case 'update_user_info':
                $url .= '/profile/portrait_set';
                break;
            case 'send_single_msg':
                $url .= '/openim/sendmsg';
                break;
            default:
                throw new TencentException('请求标识不存在', ErrorCode::IM_PARAM_ERROR);
        }

        $config = IMConfigSingleton::getInstance()->getTencentConfig();
        $reqParams = [
            'contenttype' => 'json',
            'random' => random_int(10000000, 99999999),
            'sdkappid' => $config->getAppId(),
            'identifier' => $config->getAccountAdmin(),
            'usersig' => IMAccount::getAccountSign($config->getAccountAdmin()),
        ];
        $url .= '?' . http_build_query($reqParams);

        return $url;
    }

    /**
     * 发送post请求
     * @param string $url 请求地址
     * @param string $dataType 数据类型
     * @param string|array $data 数据
     * @param array $curlConfig curl配置数组
     * @return mixed
     * @throws \SyException\IM\TencentException
     */
    private static function sendPostReq(string $url, string $dataType, $data, array $curlConfig = [])
    {
        switch ($dataType) {
            case 'string':
                $dataStr = $data;
                break;
            case 'json':
                $dataStr = Tool::jsonEncode($data, JSON_UNESCAPED_UNICODE);
                break;
            case 'query':
                $dataStr = http_build_query($data);
                break;
            default:
                $dataStr = '';
        }
        if ((!is_string($dataStr)) || (strlen($dataStr) == 0)) {
            throw new TencentException('数据格式不合法', ErrorCode::IM_PARAM_ERROR);
        }

        $curlConfig[CURLOPT_URL] = $url;
        $curlConfig[CURLOPT_POST] = true;
        $curlConfig[CURLOPT_POSTFIELDS] = $dataStr;
        $curlConfig[CURLOPT_RETURNTRANSFER] = true;
        if (!isset($curlConfig[CURLOPT_TIMEOUT_MS])) {
            $curlConfig[CURLOPT_TIMEOUT_MS] = 2000;
        }
        if (!isset($curlConfig[CURLOPT_HEADER])) {
            $curlConfig[CURLOPT_HEADER] = false;
        }
        if (!isset($curlConfig[CURLOPT_SSL_VERIFYPEER])) {
            $curlConfig[CURLOPT_SSL_VERIFYPEER] = true;
        }
        if (!isset($curlConfig[CURLOPT_SSL_VERIFYHOST])) {
            $curlConfig[CURLOPT_SSL_VERIFYHOST] = 2;
        }
        $sendRes = Tool::sendCurlReq($curlConfig);
        if ($sendRes['res_no'] == 0) {
            return $sendRes['res_content'];
        } else {
            throw new TencentException('curl出错，错误码=' . $sendRes['res_no'], ErrorCode::IM_POST_ERROR);
        }
    }

    /**
     * 发送get请求
     * @param string $url 请求地址
     * @param array $curlConfig curl配置数组
     * @return mixed
     * @throws \SyException\IM\TencentException
     */
    private static function sendGetReq(string $url, array $curlConfig = [])
    {
        $curlConfig[CURLOPT_URL] = $url;
        $curlConfig[CURLOPT_SSL_VERIFYPEER] = false;
        $curlConfig[CURLOPT_SSL_VERIFYHOST] = false;
        $curlConfig[CURLOPT_HEADER] = false;
        $curlConfig[CURLOPT_RETURNTRANSFER] = true;
        if (!isset($curlConfig[CURLOPT_TIMEOUT_MS])) {
            $curlConfig[CURLOPT_TIMEOUT_MS] = 2000;
        }
        $sendRes = Tool::sendCurlReq($curlConfig);
        if ($sendRes['res_no'] == 0) {
            return $sendRes['res_content'];
        } else {
            throw new TencentException('curl出错，错误码=' . $sendRes['res_no'], ErrorCode::IM_GET_ERROR);
        }
    }
}
