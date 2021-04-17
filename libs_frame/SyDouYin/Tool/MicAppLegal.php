<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/4/15 0015
 * Time: 17:12
 */

namespace SyDouYin\Tool;

use SyConstant\ErrorCode;
use SyDouYin\BaseTool;
use SyDouYin\Util;
use SyException\DouYin\DouYinToolException;

/**
 * 校验小程序是否可挂载到短视频
 *
 * @package SyDouYin\Tool
 */
class MicAppLegal extends BaseTool
{
    public function __construct(string $clientKey)
    {
        parent::__construct($clientKey);
        $this->serviceUri = '/devtool/micapp/is_legal/';
    }

    private function __clone()
    {
    }

    /**
     * @param string $micAppId 小程序id
     *
     * @throws \SyException\DouYin\DouYinToolException
     */
    public function setMicAppId(string $micAppId)
    {
        if (ctype_alnum($micAppId)) {
            $this->reqData['micapp_id'] = $micAppId;
        } else {
            throw new DouYinToolException('小程序id不合法', ErrorCode::DOUYIN_TOOL_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['micapp_id'])) {
            throw new DouYinToolException('小程序id不能为空', ErrorCode::DOUYIN_TOOL_PARAM_ERROR);
        }
        $this->reqData['access_token'] = Util::getClientToken($this->clientKey, $this->serviceHostType);
        $this->serviceUri .= '?' . http_build_query($this->reqData);
        $this->getContent();

        return $this->curlConfigs;
    }
}
