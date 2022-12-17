<?php

namespace SyDingTalk\Oapi\Catering;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.catering.mealconfig.get request
 *
 * @author auto create
 *
 * @since 1.0, 2021.03.10
 */
class MealConfigGetRequest extends BaseRequest
{
    /**
     * 获取未来n天的可点餐时间（包括今天）如： 1， 则返回今天和明天的可点餐日期，最大值为13
     */
    private $mealDayOffset;

    public function setMealDayOffset($mealDayOffset)
    {
        $this->mealDayOffset = $mealDayOffset;
        $this->apiParas['meal_day_offset'] = $mealDayOffset;
    }

    public function getMealDayOffset()
    {
        return $this->mealDayOffset;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.catering.mealconfig.get';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->mealDayOffset, 'mealDayOffset');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
