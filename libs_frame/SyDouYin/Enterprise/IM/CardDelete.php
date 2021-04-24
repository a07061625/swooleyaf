<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/4/15 0015
 * Time: 17:12
 */

namespace SyDouYin\Enterprise\IM;

use SyConstant\ErrorCode;
use SyDouYin\BaseEnterprise;
use SyDouYin\TraitOpenId;
use SyDouYin\Util;
use SyException\DouYin\DouYinEnterpriseException;
use SyTool\Tool;

/**
 * 删除消息卡片
 *
 * @package SyDouYin\Enterprise\IM
 */
class CardDelete extends BaseEnterprise
{
    use TraitOpenId;

    public function __construct(string $clientKey)
    {
        parent::__construct($clientKey);
        $this->serviceUri = '/enterprise/im/card/delete/';
    }

    private function __clone()
    {
    }

    /**
     * @param string $id 卡片id
     *
     * @throws \SyException\DouYin\DouYinEnterpriseException
     */
    public function setId(string $id)
    {
        if (\strlen($id) > 0) {
            $this->reqData['id'] = $id;
        } else {
            throw new DouYinEnterpriseException('卡片id不合法', ErrorCode::DOUYIN_ENTERPRISE_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['open_id'])) {
            throw new DouYinEnterpriseException('用户openid不能为空', ErrorCode::DOUYIN_ENTERPRISE_PARAM_ERROR);
        }
        if (!isset($this->reqData['id'])) {
            throw new DouYinEnterpriseException('卡片id不能为空', ErrorCode::DOUYIN_ENTERPRISE_PARAM_ERROR);
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
