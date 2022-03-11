<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/1/24 0024
 * Time: 16:29
 */

namespace Wx\Corp\Agent;

use DesignPatterns\Singletons\WxConfigSingleton;
use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseCorp;
use Wx\WxTraitCorp;
use Wx\WxUtilBase;

/**
 * 设置应用
 *
 * @package Wx\Corp\Agent
 */
class AgentSet extends WxBaseCorp
{
    use WxTraitCorp;

    /**
     * 应用ID
     *
     * @var string
     */
    private $agentid = '';
    /**
     * 地理位置上报标识 0:不上报 1:上报
     *
     * @var int
     */
    private $report_location_flag = 0;
    /**
     * 应用头像
     *
     * @var string
     */
    private $logo_mediaid = '';
    /**
     * 应用名称
     *
     * @var string
     */
    private $name = '';
    /**
     * 应用详情
     *
     * @var string
     */
    private $description = '';
    /**
     * 应用可信域名
     *
     * @var string
     */
    private $redirect_domain = '';
    /**
     * 用户进入上报标识 0:不接收 1:接收
     *
     * @var int
     */
    private $isreportenter = 0;
    /**
     * 应用主页url
     *
     * @var string
     */
    private $home_url = '';

    public function __construct(string $corpId, string $agentTag)
    {
        parent::__construct();
        $this->serviceUrl = 'https://qyapi.weixin.qq.com/cgi-bin/agent/set?access_token=';
        $this->_corpId = $corpId;
        $this->_agentTag = $agentTag;
        $agentInfo = WxConfigSingleton::getInstance()->getCorpConfig($corpId)->getAgentInfo($agentTag);
        $this->reqData['agentid'] = $agentInfo['id'];
        $this->reqData['report_location_flag'] = 0;
        $this->reqData['isreportenter'] = 0;
    }

    private function __clone()
    {
        //do nothing
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setReportLocationFlag(int $reportLocationFlag)
    {
        if (\in_array($reportLocationFlag, [0, 1], true)) {
            $this->reqData['report_location_flag'] = $reportLocationFlag;
        } else {
            throw new WxException('地理位置上报标识不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function setLogoMediaId(string $logoMediaId)
    {
        if (\strlen($logoMediaId) > 0) {
            $this->reqData['logo_mediaid'] = $logoMediaId;
        } else {
            unset($this->reqData['logo_mediaid']);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setName(string $name)
    {
        if (\strlen($name) > 0) {
            $this->reqData['name'] = mb_substr($name, 0, 16);
        } else {
            throw new WxException('应用名称不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setDescription(string $description)
    {
        $length = \strlen($description);
        if ($length < 4) {
            throw new WxException('应用详情不能少于4个字节', ErrorCode::WX_PARAM_ERROR);
        }
        if ($length > 120) {
            throw new WxException('应用详情不能大于120个字节', ErrorCode::WX_PARAM_ERROR);
        }

        $this->reqData['description'] = $description;
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setRedirectDomain(string $redirectDomain)
    {
        if (\strlen($redirectDomain) > 0) {
            $this->reqData['redirect_domain'] = $redirectDomain;
        } else {
            throw new WxException('应用可信域名不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setReportEnterFlag(int $reportEnterFlag)
    {
        if (\in_array($reportEnterFlag, [0, 1], true)) {
            $this->reqData['isreportenter'] = $reportEnterFlag;
        } else {
            throw new WxException('用户进入上报标识不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setHomeUrl(string $homeUrl)
    {
        if (preg_match(ProjectBase::REGEX_URL_HTTP, $homeUrl) > 0) {
            $this->reqData['home_url'] = $homeUrl;
        } else {
            throw new WxException('应用主页url不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . $this->getAccessToken(WxBaseCorp::ACCESS_TOKEN_TYPE_CORP, $this->_corpId, $this->_agentTag);
        $sendRes = WxUtilBase::sendGetReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if (0 == $sendData['errcode']) {
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::WX_GET_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}
