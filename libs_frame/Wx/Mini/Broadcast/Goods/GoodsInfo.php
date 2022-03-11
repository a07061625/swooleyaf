<?php
/**
 * 获取商品的信息与审核状态
 * User: 姜伟
 * Date: 2020/6/21 0021
 * Time: 11:39
 */

namespace Wx\Mini\Broadcast\Goods;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseMini;
use Wx\WxUtilAlone;
use Wx\WxUtilBase;

/**
 * Class GoodsInfo
 *
 * @package Wx\Mini\Broadcast\Goods
 */
class GoodsInfo extends WxBaseMini
{
    /**
     * 应用ID
     *
     * @var string
     */
    private $appId = '';
    /**
     * 商品ID列表
     *
     * @var array
     */
    private $goodsIds = [];

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/wxa/business/getgoodswarehouse?access_token=';
        $this->appId = $appId;
        $this->reqData = [];
    }

    private function __clone()
    {
        //do nothing
    }

    public function setGoodsIds(array $goodsIds)
    {
        $this->goodsIds = [];
        foreach ($goodsIds as $eId) {
            if (\is_int($eId) && ($eId > 0)) {
                $this->goodsIds[$eId] = 1;
            }
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function getDetail(): array
    {
        if (empty($this->goodsIds)) {
            throw new WxException('商品ID列表不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        $this->reqData['goods_ids'] = array_keys($this->goodsIds);

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilAlone::getAccessToken($this->appId);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $this->curlConfigs[CURLOPT_SSL_VERIFYPEER] = false;
        $this->curlConfigs[CURLOPT_SSL_VERIFYHOST] = false;
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
