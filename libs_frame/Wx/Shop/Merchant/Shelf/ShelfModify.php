<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/12/14 0014
 * Time: 16:01
 */
namespace Wx\Shop\Merchant\Shelf;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use Tool\Tool;
use Wx\WxBaseShop;
use Wx\WxUtilBase;
use Wx\WxUtilShop;

class ShelfModify extends WxBaseShop
{
    /**
     * 公众号ID
     * @var string
     */
    private $appid = '';
    /**
     * 货架ID
     * @var int
     */
    private $shelf_id = 0;
    /**
     * 货架名称
     * @var string
     */
    private $shelf_name = '';
    /**
     * 货架招牌图片Url
     * @var string
     */
    private $shelf_banner = '';
    /**
     * 货架信息列表
     * @var array
     */
    private $shelf_data = [];

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/merchant/shelf/mod?access_token=';
        $this->appid = $appId;
    }

    private function __clone()
    {
    }

    /**
     * @param int $shelfId
     * @throws \SyException\Wx\WxException
     */
    public function setShelfId(int $shelfId)
    {
        if ($shelfId > 0) {
            $this->reqData['shelf_id'] = $shelfId;
        } else {
            throw new WxException('货架ID不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param string $shelfName
     * @throws \SyException\Wx\WxException
     */
    public function setShelfName(string $shelfName)
    {
        if (strlen($shelfName) > 0) {
            $this->reqData['shelf_name'] = $shelfName;
        } else {
            throw new WxException('货架名称不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param string $shelfBanner
     * @throws \SyException\Wx\WxException
     */
    public function setShelfBanner(string $shelfBanner)
    {
        if (preg_match('/^(http|https)\:\/\/\S+$/', $shelfBanner) > 0) {
            $this->reqData['shelf_banner'] = $shelfBanner;
        } else {
            throw new WxException('货架招牌图片Url不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param array $shelfData
     */
    public function setShelfData(array $shelfData)
    {
        foreach ($shelfData as $eShelfInfo) {
            if (isset($eShelfInfo['eid']) && is_int($eShelfInfo['eid']) && ($eShelfInfo['eid'] > 0)
               && isset($eShelfInfo['group_infos']) && is_array($eShelfInfo['group_infos'])) {
                $this->shelf_data[$eShelfInfo['eid']] = $eShelfInfo;
            }
        }
    }

    /**
     * @param array $shelfInfo
     * @throws \SyException\Wx\WxException
     */
    public function addShelfInfo(array $shelfInfo)
    {
        if (isset($shelfInfo['eid']) && is_int($shelfInfo['eid']) && ($shelfInfo['eid'] > 0)
           && isset($shelfInfo['group_infos']) && is_array($shelfInfo['group_infos'])) {
            $this->shelf_data[$shelfInfo['eid']] = $shelfInfo;
        } else {
            throw new WxException('货架信息不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['shelf_id'])) {
            throw new WxException('货架ID不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['shelf_name'])) {
            throw new WxException('货架名称不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['shelf_banner'])) {
            throw new WxException('货架招牌图片Url不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (empty($this->shelf_data)) {
            throw new WxException('货架信息列表不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        $this->reqData['shelf_data'] = [
            'module_infos' => array_values($this->shelf_data),
        ];

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilShop::getAccessToken($this->appid);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
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
