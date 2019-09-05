<?php
/**
 * 上传门店照片和视频接口
 * User: 姜伟
 * Date: 2018/11/1 0001
 * Time: 17:52
 */
namespace AliPay\Shop;

use AliPay\AliPayBase;
use SyConstant\ErrorCode;
use SyException\AliPay\AliPayShopException;

class ImageUpload extends AliPayBase
{
    /**
     * 图片格式
     * @var string
     */
    private $image_type = '';
    /**
     * 图片名称
     * @var string
     */
    private $image_name = '';
    /**
     * 图片二进制内容
     * @var string
     */
    private $image_content = '';
    /**
     * 图片所属的partnerId
     * @var string
     */
    private $image_pid = '';

    public function __construct(string $appId)
    {
        parent::__construct($appId);
        $this->setMethod('alipay.offline.material.image.upload');
    }

    private function __clone()
    {
    }

    /**
     * @param string $imageType
     * @throws \SyException\AliPay\AliPayShopException
     */
    public function setImageType(string $imageType)
    {
        $length = strlen($imageType);
        if (($length > 0) && ($length <= 8)) {
            $this->biz_content['image_type'] = $imageType;
        } else {
            throw new AliPayShopException('图片格式不合法', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
    }

    /**
     * @param string $imageName
     * @throws \SyException\AliPay\AliPayShopException
     */
    public function setImageName(string $imageName)
    {
        $length = strlen($imageName);
        if (($length > 0) && ($length <= 128)) {
            $this->biz_content['image_name'] = $imageName;
        } else {
            throw new AliPayShopException('图片名称不合法', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
    }

    /**
     * @param string $imageContent
     * @throws \SyException\AliPay\AliPayShopException
     */
    public function setImageContent(string $imageContent)
    {
        if (strlen($imageContent) > 0) {
            $this->biz_content['image_content'] = $imageContent;
        } else {
            throw new AliPayShopException('图片二进制内容不合法', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
    }

    /**
     * @param string $imagePid
     * @throws \SyException\AliPay\AliPayShopException
     */
    public function setImagePid(string $imagePid)
    {
        if (ctype_digit($imagePid) && (strlen($imagePid) <= 16)) {
            $this->biz_content['image_pid'] = $imagePid;
        } else {
            throw new AliPayShopException('图片所属的partnerId不合法', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->biz_content['image_type'])) {
            throw new AliPayShopException('图片格式不能为空', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
        if (!isset($this->biz_content['image_name'])) {
            throw new AliPayShopException('图片名称不能为空', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
        if (!isset($this->biz_content['image_content'])) {
            throw new AliPayShopException('图片二进制内容不能为空', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
