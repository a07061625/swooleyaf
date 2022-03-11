<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/12/22 0022
 * Time: 11:05
 */

namespace Wx\Corp\Tag;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseCorp;
use Wx\WxTraitCorp;
use Wx\WxUtilBase;

/**
 * 更新标签名字
 *
 * @package Wx\Corp\Tag
 */
class TagUpdate extends WxBaseCorp
{
    use WxTraitCorp;

    /**
     * 标签id
     *
     * @var int
     */
    private $tagid = 0;
    /**
     * 名称
     *
     * @var string
     */
    private $tagname = '';

    public function __construct(string $corpId, string $agentTag)
    {
        parent::__construct();
        $this->serviceUrl = 'https://qyapi.weixin.qq.com/cgi-bin/tag/update?access_token=';
        $this->_corpId = $corpId;
        $this->_agentTag = $agentTag;
    }

    private function __clone()
    {
        //do nothing
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setTagId(int $tagId)
    {
        if ($tagId > 0) {
            $this->reqData['tagid'] = $tagId;
        } else {
            throw new WxException('标签id不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setTagName(string $tagName)
    {
        if (\strlen($tagName) > 0) {
            $this->reqData['tagname'] = mb_substr($tagName, 0, 16);
        } else {
            throw new WxException('名称不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['tagid'])) {
            throw new WxException('标签id不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['tagname'])) {
            throw new WxException('名称不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . $this->getAccessToken($this->_tokenType, $this->_corpId, $this->_agentTag);
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
