<?php
/**
 * 私域用户备案
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:38
 */

namespace SyPromotion\TBK\Common;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;
use SyTool\Tool;

/**
 * Class PublisherInfoSave
 *
 * @package SyPromotion\TBK\Common
 */
class PublisherInfoSave extends BaseTBK
{
    /**
     * 来源
     *
     * @var string
     */
    private $relation_from = '';
    /**
     * 线下场景
     *
     * @var string
     */
    private $offline_scene = '';
    /**
     * 线上场景
     *
     * @var string
     */
    private $online_scene = '';
    /**
     * 邀请码
     *
     * @var string
     */
    private $inviter_code = '';
    /**
     * 类型
     *
     * @var int
     */
    private $info_type = 0;
    /**
     * 渠道备注
     *
     * @var string
     */
    private $note = '';
    /**
     * 线下备案注册信息
     *
     * @var array
     */
    private $register_info = [];

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.sc.publisher.info.save');
        $this->reqData['info_type'] = 1;
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setRelationFrom(string $relationFrom)
    {
        if (\strlen($relationFrom) > 0) {
            $this->reqData['relation_from'] = $relationFrom;
        } else {
            throw new TBKException('来源不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setOfflineScene(string $offlineScene)
    {
        if (\in_array($offlineScene, ['1', '2', '3', '4'])) {
            $this->reqData['offline_scene'] = $offlineScene;
        } else {
            throw new TBKException('线下场景不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setOnlineScene(string $onlineScene)
    {
        if (\in_array($onlineScene, ['1', '2', '3'])) {
            $this->reqData['online_scene'] = $onlineScene;
        } else {
            throw new TBKException('线上场景不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setInviterCode(string $inviterCode)
    {
        if (\strlen($inviterCode) > 0) {
            $this->reqData['inviter_code'] = $inviterCode;
        } else {
            throw new TBKException('邀请码不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setInfoType(int $infoType)
    {
        if ($infoType > 0) {
            $this->reqData['info_type'] = $infoType;
        } else {
            throw new TBKException('类型不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setNote(string $note)
    {
        if (\strlen($note) > 0) {
            $this->reqData['note'] = $note;
        } else {
            throw new TBKException('渠道备注不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setRegisterInfo(array $registerInfo)
    {
        $phoneNumber = \is_string($registerInfo['phoneNumber']) ? trim($registerInfo['phoneNumber']) : '';
        if (0 == \strlen($phoneNumber)) {
            throw new TBKException('电话号码不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        $province = \is_string($registerInfo['province']) ? trim($registerInfo['province']) : '';
        if (0 == \strlen($province)) {
            throw new TBKException('省不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        $city = \is_string($registerInfo['city']) ? trim($registerInfo['city']) : '';
        if (0 == \strlen($city)) {
            throw new TBKException('市不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        $location = \is_string($registerInfo['location']) ? trim($registerInfo['location']) : '';
        if (0 == \strlen($location)) {
            throw new TBKException('区县街道不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        $detailAddress = \is_string($registerInfo['detailAddress']) ? trim($registerInfo['detailAddress']) : '';
        if (0 == \strlen($detailAddress)) {
            throw new TBKException('详细地址不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        $this->reqData['register_info'] = Tool::jsonEncode($registerInfo, JSON_UNESCAPED_UNICODE);
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['inviter_code'])) {
            throw new TBKException('邀请码不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
