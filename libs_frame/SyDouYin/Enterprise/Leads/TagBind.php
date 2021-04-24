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
 * 给用户设置标签
 *
 * @package SyDouYin\Enterprise\Leads
 */
class TagBind extends BaseEnterprise
{
    use TraitOpenId;

    public function __construct(string $clientKey)
    {
        parent::__construct($clientKey);
        $this->serviceUri = '/enterprise/leads/tag/user/update/';
    }

    private function __clone()
    {
    }

    /**
     * @param bool $bindTag 绑定标识
     */
    public function setBind(bool $bindTag)
    {
        $this->reqData['bind'] = $bindTag;
    }

    /**
     * @param int $tagId 标签id
     *
     * @throws \SyException\DouYin\DouYinEnterpriseException
     */
    public function setTagId(int $tagId)
    {
        if ($tagId > 0) {
            $this->reqData['tag_id'] = $tagId;
        } else {
            throw new DouYinEnterpriseException('标签id不合法', ErrorCode::DOUYIN_ENTERPRISE_PARAM_ERROR);
        }
    }

    /**
     * @param string $userId 意向用户openid
     *
     * @throws \SyException\DouYin\DouYinEnterpriseException
     */
    public function setUserId(string $userId)
    {
        if (\strlen($userId) > 0) {
            $this->reqData['user_id'] = $userId;
        } else {
            throw new DouYinEnterpriseException('意向用户openid不合法', ErrorCode::DOUYIN_ENTERPRISE_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['open_id'])) {
            throw new DouYinEnterpriseException('用户openid不能为空', ErrorCode::DOUYIN_ENTERPRISE_PARAM_ERROR);
        }
        if (!isset($this->reqData['bind'])) {
            throw new DouYinEnterpriseException('绑定标识不能为空', ErrorCode::DOUYIN_ENTERPRISE_PARAM_ERROR);
        }
        if (!isset($this->reqData['tag_id'])) {
            throw new DouYinEnterpriseException('标签id不能为空', ErrorCode::DOUYIN_ENTERPRISE_PARAM_ERROR);
        }
        if (!isset($this->reqData['user_id'])) {
            throw new DouYinEnterpriseException('意向用户openid不能为空', ErrorCode::DOUYIN_ENTERPRISE_PARAM_ERROR);
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
