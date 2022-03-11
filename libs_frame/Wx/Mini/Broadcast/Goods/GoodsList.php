<?php
/**
 * 获取商品列表
 * User: 姜伟
 * Date: 2020/6/21 0021
 * Time: 11:46
 */

namespace Wx\Mini\Broadcast\Goods;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseMini;
use Wx\WxUtilAlone;
use Wx\WxUtilBase;

/**
 * Class GoodsList
 *
 * @package Wx\Mini\Broadcast\Goods
 */
class GoodsList extends WxBaseMini
{
    /**
     * 应用ID
     *
     * @var string
     */
    private $appId = '';
    /**
     * 偏移量
     *
     * @var int
     */
    private $offset = 0;
    /**
     * 分页大小,默认30,不超过100
     *
     * @var int
     */
    private $limit = 0;
    /**
     * 商品状态 0：未审核 1：审核中 2：审核通过 3：审核驳回
     *
     * @var int
     */
    private $status = 0;

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/wxaapi/broadcast/goods/getapproved';
        $this->appId = $appId;
        $this->reqData = [
            'offset' => 0,
            'limit' => 30,
        ];
    }

    private function __clone()
    {
        //do nothing
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setOffset(int $offset)
    {
        if ($offset > 0) {
            $this->reqData['offset'] = $offset;
        } else {
            throw new WxException('偏移量不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setLimit(int $limit)
    {
        if (($limit > 0) && ($limit <= 100)) {
            $this->reqData['limit'] = $limit;
        } else {
            throw new WxException('分页大小不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setStatus(int $status)
    {
        if (\in_array($status, [0, 1, 2, 3])) {
            $this->reqData['status'] = $status;
        } else {
            throw new WxException('商品状态不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        $resArr = [
            'code' => 0,
        ];

        $this->reqData['access_token'] = WxUtilAlone::getAccessToken($this->appId);
        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . '?' . http_build_query($this->reqData);
        $this->curlConfigs[CURLOPT_SSL_VERIFYPEER] = false;
        $this->curlConfigs[CURLOPT_SSL_VERIFYHOST] = false;
        $sendRes = WxUtilBase::sendGetReq($this->curlConfigs);
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
