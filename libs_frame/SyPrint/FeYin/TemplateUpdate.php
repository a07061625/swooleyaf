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

class TemplateUpdate extends PrintBaseFeYin
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
    /**
     * 模板名称
     * @var string
     */
    private $name = '';
    /**
     * 模板内容
     * @var string
     */
    private $content = '';
    /**
     * 模板归类
     * @var string
     */
    private $catalog = '';
    /**
     * 模板说明
     * @var string
     */
    private $desc = '';

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

    /**
     * @param string $name
     * @throws \SyException\SyPrint\FeYinException
     */
    public function setName(string $name)
    {
        $nameLength = strlen($name);
        if (($nameLength > 0) && ($nameLength <= 30)) {
            $this->reqData['name'] = $name;
        } else {
            throw new FeYinException('模板名称不合法', ErrorCode::PRINT_PARAM_ERROR);
        }
    }

    /**
     * @param string $content
     * @throws \SyException\SyPrint\FeYinException
     */
    public function setContent(string $content)
    {
        if (strlen($content) > 0) {
            $this->reqData['content'] = $content;
        } else {
            throw new FeYinException('模板内容不合法', ErrorCode::PRINT_PARAM_ERROR);
        }
    }

    /**
     * @param string $catalog
     * @throws \SyException\SyPrint\FeYinException
     */
    public function setCatalog(string $catalog)
    {
        if (ctype_alnum($catalog)) {
            $this->reqData['catalog'] = $catalog;
        } else {
            throw new FeYinException('模板归类不合法', ErrorCode::PRINT_PARAM_ERROR);
        }
    }

    /**
     * @param string $desc
     */
    public function setDesc(string $desc)
    {
        if (strlen($desc) > 0) {
            $this->reqData['desc'] = $desc;
        }
    }

    public function getDetail() : array
    {
        if (strlen($this->template_id) == 0) {
            throw new FeYinException('模板id不能为空', ErrorCode::PRINT_PARAM_ERROR);
        }
        if (empty($this->reqData)) {
            throw new FeYinException('模板数据不能为空', ErrorCode::PRINT_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/template/' . $this->template_id . '?access_token=' . PrintUtilFeYin::getAccessToken($this->appid);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $this->curlConfigs[CURLOPT_HTTPHEADER] = [
            'Content-Type: application/json; charset=utf-8',
        ];
        $sendRes = PrintUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if ($sendData['errcode'] == 0) {
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::PRINT_POST_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}
