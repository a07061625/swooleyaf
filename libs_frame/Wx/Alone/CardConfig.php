<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/7/30 0030
 * Time: 19:13
 */
namespace Wx\Alone;

use Wx\WxBaseAlone;

/**
 * wx.chooseCard({
shopId: '', // 门店Id
cardType: '', // 卡券类型
cardId: '', // 卡券Id
timestamp: 0, // 卡券签名时间戳
nonceStr: '', // 卡券签名随机串
signType: '', // 签名方式，默认'SHA1'
cardSign: '', // 卡券签名
success: function (res) {
var cardList= res.cardList; // 用户选中的卡券列表信息
}
});
参数名	必填	类型	示例值	描述
shopId	否	string(24)	1234	门店ID。shopID用于筛选出拉起带有指定location_list(shopID)的卡券列表，非必填。
cardType	否	string(24)	GROUPON	卡券类型，用于拉起指定卡券类型的卡券列表。当cardType为空时，默认拉起所有卡券的列表，非必填。
cardId	否	string(32)	p1Pj9jr90_SQRaVqYI239Ka1erk	卡券ID，用于拉起指定cardId的卡券列表，当cardId为空时，默认拉起所有卡券的列表，非必填。
timestamp	是	string(32)	14300000000	时间戳。
nonceStr	是	string(32)	sduhi123	随机字符串。
signType	是	string(32)	SHA1	签名方式，目前仅支持SHA1
cardSign	是	string(64)	abcsdijcous123	签名。
 */
class CardConfig extends WxBaseAlone
{
    public function __construct()
    {
        parent::__construct();
    }

    private function __clone()
    {
    }

    public function getDetail() : array
    {
        return [];
    }
}
