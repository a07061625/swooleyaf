<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/4/15 0015
 * Time: 17:12
 */

namespace SyDouYin\Enterprise\Leads;

use SyConstant\ErrorCode;
use SyDouYin\BaseEnterprise;
use SyDouYin\TraitOpenId;
use SyDouYin\Util;
use SyException\DouYin\DouYinEnterpriseException;
use SyTool\Tool;

/**
 * 创建标签
 *
 * @package SyDouYin\Enterprise\Leads
 */
class TagCreate extends BaseEnterprise
{
    use TraitOpenId;

    public function __construct(string $clientKey)
    {
        parent::__construct($clientKey);
        $this->serviceUri = '/enterprise/leads/tag/create/';
    }

    private function __clone()
    {
    }

    /**
     * @param string $tagName 标签名称
     *
     * @throws \SyException\DouYin\DouYinEnterpriseException
     */
    public function setTagName(string $tagName)
    {
        if (\strlen($tagName) > 0) {
            $this->reqData['tag_name'] = $tagName;
        } else {
            throw new DouYinEnterpriseException('标签名称不合法', ErrorCode::DOUYIN_ENTERPRISE_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['open_id'])) {
            throw new DouYinEnterpriseException('用户openid不能为空', ErrorCode::DOUYIN_ENTERPRISE_PARAM_ERROR);
        }
        if (!isset($this->reqData['tag_name'])) {
            throw new DouYinEnterpriseException('标签名称不能为空', ErrorCode::DOUYIN_ENTERPRISE_PARAM_ERROR);
        }

        $this->serviceUri .= '?' . http_build_query([
            'open_id' => $this->reqData['open_id'],
            'access_token' => Util::getAccessToken([
                'client_key' => $this->clientKey,
                'host_type' => $this->serviceHostType,
                'open_id' => $this->reqData['open_id'],
            ]),
        ]);
        unset($this->reqData['open_id']);
        $this->getContent();
        $this->curlConfigs[CURLOPT_HTTPHEADER] = [
            'Content-Type: application/json',
        ];
        $this->curlConfigs[CURLOPT_POST] = true;
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);

        return $this->curlConfigs;
    }
}
