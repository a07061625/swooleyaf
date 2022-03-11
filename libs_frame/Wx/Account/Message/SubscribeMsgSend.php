<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/12/22 0022
 * Time: 11:05
 */

namespace Wx\Account\Message;

use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseAccount;
use Wx\WxUtilAccount;
use Wx\WxUtilBase;

class SubscribeMsgSend extends WxBaseAccount
{
    /**
     * 公众号ID
     *
     * @var string
     */
    private $appid = '';
    /**
     * 用户openid
     *
     * @var string
     */
    private $touser = '';
    /**
     * 模版ID
     *
     * @var string
     */
    private $template_id = '';
    /**
     * 重定向地址
     *
     * @var string
     */
    private $url = '';
    /**
     * 小程序跳转数据
     *
     * @var array
     */
    private $miniprogram = [];
    /**
     * 订阅场景值
     *
     * @var int
     */
    private $scene = 0;
    /**
     * 消息标题
     *
     * @var string
     */
    private $title = '';
    /**
     * 消息内容
     *
     * @var array
     */
    private $data = [];

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/cgi-bin/message/template/subscribe?access_token=';
        $this->appid = $appId;
    }

    private function __clone()
    {
        //do nothing
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setOpenid(string $openid)
    {
        if (preg_match(ProjectBase::REGEX_WX_OPEN_ID, $openid) > 0) {
            $this->reqData['touser'] = $openid;
        } else {
            throw new WxException('用户openid不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setTemplateId(string $templateId)
    {
        if (\strlen($templateId) > 0) {
            $this->reqData['template_id'] = $templateId;
        } else {
            throw new WxException('模版ID不能为空', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setUrl(string $url)
    {
        if (preg_match(ProjectBase::REGEX_URL_HTTP, $url) > 0) {
            $this->reqData['url'] = $url;
        } else {
            throw new WxException('重定向地址不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setMiniProgram(array $miniProgram)
    {
        if (empty($miniProgram)) {
            throw new WxException('小程序跳转数据不合法', ErrorCode::WX_PARAM_ERROR);
        }
        $this->reqData['miniprogram'] = $miniProgram;
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setScene(int $scene)
    {
        if (($scene >= 0) && ($scene <= 10000)) {
            $this->reqData['scene'] = (string)$scene;
        } else {
            throw new WxException('订阅场景值不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setTitle(string $title)
    {
        $titleLength = mb_strlen($title);
        if (($titleLength > 0) && ($titleLength <= 15)) {
            $this->reqData['title'] = $title;
        } else {
            throw new WxException('消息标题不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setData(array $data)
    {
        $content = isset($data['value']) && \is_string($data['value']) ? $data['value'] : '';
        $contentLength = mb_strlen($content);
        if (0 == $contentLength) {
            throw new WxException('消息内容不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if ($contentLength > 200) {
            throw new WxException('消息内容不能超过200个字', ErrorCode::WX_PARAM_ERROR);
        }

        $this->reqData['data'] = [
            'content' => [
                'value' => $content,
                'color' => isset($data['color']) && \is_string($data['color']) ? $data['color'] : '',
            ],
        ];
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['touser'])) {
            throw new WxException('用户openid不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['template_id'])) {
            throw new WxException('模版ID不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['scene'])) {
            throw new WxException('订阅场景值不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['title'])) {
            throw new WxException('消息标题不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['data'])) {
            throw new WxException('消息内容不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilAccount::getAccessToken($this->appid);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if (0 == $sendData['errcode']) {
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::WX_POST_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}
