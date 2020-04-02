<?php
/**
 * 查询转码回调地址(点播和回放)
 * User: 姜伟
 * Date: 2020/4/1 0001
 * Time: 18:54
 */
namespace LiveEducation\BJY\VOD\VideoAccount;

use LiveEducation\BaseBJY;
use LiveEducation\UtilBJY;

/**
 * Class TransCodeCallbackUrlGet
 * @package LiveEducation\BJY\VOD\VideoAccount
 */
class TransCodeCallbackUrlGet extends BaseBJY
{
    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/video_account/getTranscodeCallbackUrl';
    }

    private function __clone()
    {
    }

    public function getDetail() : array
    {
        UtilBJY::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
