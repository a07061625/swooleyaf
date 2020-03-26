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

class TemplateDetail extends PrintBaseFeYin
{
    /**
     * 应用ID
     * @var string
     */
    private $appid = '';
    /**
     * 模板id
     * @var string
     */
    private $template_id = '';

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->appid = $appId;
    }

    private function __clone()
    {
    }

    /**
     * @param string $templateId
     * @throws \SyException\SyPrint\FeYinException
     */
    public function setTemplateId(string $templateId)
    {
        if (ctype_alnum($templateId)) {
            $this->template_id = $templateId;
        } else {
            throw new FeYinException('模板id不合法', ErrorCode::PRINT_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (strlen($this->template_id) == 0) {
            throw new FeYinException('模板id不能为空', ErrorCode::PRINT_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/template/detail/' . $this->template_id . '?access_token=' . PrintUtilFeYin::getAccessToken($this->appid);
        $sendRes = PrintUtilBase::sendGetReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if (isset($sendData['errcode'])) {
            $resArr['code'] = ErrorCode::PRINT_GET_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        } else {
            $resArr['data'] = $sendData;
        }

        return $resArr;
    }
}
