<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/1/11 0011
 * Time: 8:14
 */
namespace SyPrint\FeYin;

use SyConstant\ErrorCode;
use SyException\SyPrint\FeYinException;
use SyPrint\PrintBaseFeYin;
use SyPrint\PrintUtilBase;
use SyPrint\PrintUtilFeYin;
use SyTool\Tool;

class MsgSend extends PrintBaseFeYin
{
    /**
     * 应用ID
     * @var string
     */
    private $appid = '';
    /**
     * 机器编号列表
     * @var array
     */
    private $devices = [];
    /**
     * 消息ID
     * @var string
     */
    private $msg_no = '';
    /**
     * 消息内容
     * @var string
     */
    private $msg_content = '';
    /**
     * 模板id
     * @var string
     */
    private $template_id = '';
    /**
     * 模板数据
     * @var array
     */
    private $template_data = [];

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->reqData['appid'] = $appId;
        $this->reqData['msg_no'] = Tool::createUniqueId();
    }

    private function __clone()
    {
    }

    /**
     * @param array $devices
     */
    public function setDevices(array $devices)
    {
        $this->devices = [];
        foreach ($devices as $eDeviceNo) {
            if (ctype_digit($eDeviceNo)) {
                $this->devices[$eDeviceNo] = 1;
            }
        }

        if (!empty($this->devices)) {
            $this->reqData['device_no'] = implode(',', array_keys($this->devices));
        }
    }

    /**
     * @param string $msgNo
     * @throws \SyException\SyPrint\FeYinException
     */
    public function setMsgNo(string $msgNo)
    {
        if (ctype_alnum($msgNo)) {
            $this->reqData['msg_no'] = $msgNo;
        } else {
            throw new FeYinException('消息ID不合法', ErrorCode::PRINT_PARAM_ERROR);
        }
    }

    /**
     * @param string $msgContent
     * @throws \SyException\SyPrint\FeYinException
     */
    public function setMsgContent(string $msgContent)
    {
        if (strlen($msgContent) > 0) {
            $this->reqData['msg_content'] = $msgContent;
        } else {
            throw new FeYinException('消息内容不合法', ErrorCode::PRINT_PARAM_ERROR);
        }
    }

    /**
     * @param string $templateId
     * @throws \SyException\SyPrint\FeYinException
     */
    public function setTemplateId(string $templateId)
    {
        if (ctype_alnum($templateId)) {
            $this->reqData['template_id'] = $templateId;
        } else {
            throw new FeYinException('模板id不合法', ErrorCode::PRINT_PARAM_ERROR);
        }
    }

    /**
     * @param array $templateData
     * @throws \SyException\SyPrint\FeYinException
     */
    public function setTemplateData(array $templateData)
    {
        if (empty($templateData)) {
            $this->reqData['template_data'] = $templateData;
        } else {
            throw new FeYinException('模板数据不合法', ErrorCode::PRINT_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['device_no'])) {
            throw new FeYinException('机器编号不能为空', ErrorCode::PRINT_PARAM_ERROR);
        }
        if (isset($this->reqData['template_id'])) {
            if (!isset($this->reqData['template_data'])) {
                throw new FeYinException('模板数据不能为空', ErrorCode::PRINT_PARAM_ERROR);
            }
            unset($this->reqData['msg_content']);
        } else {
            if (!isset($this->reqData['msg_content'])) {
                throw new FeYinException('消息内容不能为空', ErrorCode::PRINT_PARAM_ERROR);
            }
            unset($this->reqData['template_data']);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/msg?access_token=' . PrintUtilFeYin::getAccessToken($this->reqData['appid']);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $this->curlConfigs[CURLOPT_HTTPHEADER] = [
            'Content-Type: application/json; charset=utf-8',
        ];
        $sendRes = PrintUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if (isset($sendData['msg_no'])) {
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::PRINT_POST_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}
