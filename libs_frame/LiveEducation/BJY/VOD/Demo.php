<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/3/28 0028
 * Time: 13:17
 */
namespace LiveEducation\BJY\VOD;

use LiveEducation\BaseBJY;

/**
 * Class Demo
 * @package LiveEducation\BJY\VOD
 */
class Demo extends BaseBJY
{
    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '';
    }

    private function __clone()
    {
    }

    public function getDetail() : array
    {
        return $this->getContent();
    }
}
