<?php
/**
 * 可删除【小程序直播】商品库中的商品,删除后直播间上架的该商品也将被同步删除,不可恢复
 * User: 姜伟
 * Date: 2020/6/21 0021
 * Time: 11:25
 */
namespace Wx\Mini\Broadcast\Goods;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseMini;
use Wx\WxUtilAlone;
use Wx\WxUtilBase;

/**
 * Class GoodsDelete
 * @package Wx\Mini\Broadcast\Goods
 */
class GoodsDelete extends WxBaseMini
{
    /**
     * 应用ID
     * @var string
     */
    private $appId = '';
    /**
     * 商品ID
     * @var int
     */
    private $goodsId = 0;

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/wxaapi/broadcast/goods/delete?access_token=';
        $this->appId = $appId;
        $this->reqData = [];
    }

    private function __clone()
    {
    }

    /**
     * @param int $goodsId
     * @throws \SyException\Wx\WxException
     */
    public function setGoodsId(int $goodsId)
    {
        if ($goodsId > 0) {
            $this->reqData['goodsId'] = $goodsId;
        } else {
            throw new WxException('商品ID不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @return array
     * @throws \SyException\Wx\WxException
     */
    public function getDetail() : array
    {
        if (!isset($this->reqData['goodsId'])) {
            throw new WxException('商品ID不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilAlone::getAccessToken($this->appId);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $this->curlConfigs[CURLOPT_SSL_VERIFYPEER] = false;
        $this->curlConfigs[CURLOPT_SSL_VERIFYHOST] = false;
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if ($sendData['errcode'] == 0) {
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::WX_POST_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}
