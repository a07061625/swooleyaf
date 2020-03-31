<?php
/**
 * 设置跑马灯设置
 * User: 姜伟
 * Date: 2020/3/31 0031
 * Time: 8:53
 */
namespace LiveEducation\BJY\Setting\Live;

use LiveEducation\BJY\Setting\BaseSetting;
use LiveEducation\UtilBJY;
use SyConstant\ErrorCode;
use SyException\LiveEducation\BJYException;

/**
 * Class LiveHorseLampSet
 * @package LiveEducation\BJY\Setting\Live
 */
class LiveHorseLampSet extends BaseSetting
{
    /**
     * 类型 0:关闭 1:固定值 2:昵称
     * @var int
     */
    private $type = 0;
    /**
     * 名称
     * @var string
     */
    private $value = '';
    /**
     * 颜色
     * @var string
     */
    private $color = '';
    /**
     * 字体大小
     * @var int
     */
    private $font_size = 0;
    /**
     * 不透明度
     * @var float
     */
    private $opacity = 0.0;

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/live_setting/setLiveHorseLamp';
    }

    private function __clone()
    {
    }

    /**
     * @param int $type
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setType(int $type)
    {
        if (in_array($type, [0, 1, 2])) {
            $this->reqData['type'] = $type;
        } else {
            throw new BJYException('类型不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
    }

    /**
     * @param string $value
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setValue(string $value)
    {
        $trueValue = trim($value);
        if (strlen($trueValue) > 0) {
            $this->reqData['value'] = $trueValue;
        } else {
            throw new BJYException('名称不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
    }

    /**
     * @param string $color
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setColor(string $color)
    {
        if ((strlen($color) == 7) && ($color{0} == '#')) {
            $this->reqData['color'] = $color;
        } else {
            throw new BJYException('颜色不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
    }

    /**
     * @param int $fontSize
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setFontSize(int $fontSize)
    {
        if ($fontSize > 0) {
            $this->reqData['font_size'] = $fontSize;
        } else {
            throw new BJYException('字体大小不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
    }

    /**
     * @param float $opacity
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setOpacity(float $opacity)
    {
        if (($opacity >= 0) && ($opacity <= 1)) {
            $this->reqData['opacity'] = $opacity;
        } else {
            throw new BJYException('不透明度不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        UtilBJY::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
