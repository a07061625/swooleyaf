<?php

namespace SyDingTalk\Corp\SmartDevice;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.corp.smartdevice.addface request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.03
 */
class AddFaceRequest extends BaseRequest
{
    /**
     * 识别用户数据
     */
    private $faceVo;

    public function setFaceVo($faceVo)
    {
        $this->faceVo = $faceVo;
        $this->apiParas['face_vo'] = $faceVo;
    }

    public function getFaceVo()
    {
        return $this->faceVo;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.corp.smartdevice.addface';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
