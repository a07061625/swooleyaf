<?php

namespace SyDingTalk\Oapi\SmartDevice;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.smartdevice.face.feature request
 *
 * @author auto create
 *
 * @since 1.0, 2019.09.04
 */
class FaceFeatureRequest extends BaseRequest
{
    /**
     * 算法模型
     */
    private $modelType;
    /**
     * 模型版本
     */
    private $modelVersion;
    /**
     * 用户id列表
     */
    private $useridList;

    public function setModelType($modelType)
    {
        $this->modelType = $modelType;
        $this->apiParas['model_type'] = $modelType;
    }

    public function getModelType()
    {
        return $this->modelType;
    }

    public function setModelVersion($modelVersion)
    {
        $this->modelVersion = $modelVersion;
        $this->apiParas['model_version'] = $modelVersion;
    }

    public function getModelVersion()
    {
        return $this->modelVersion;
    }

    public function setUseridList($useridList)
    {
        $this->useridList = $useridList;
        $this->apiParas['userid_list'] = $useridList;
    }

    public function getUseridList()
    {
        return $this->useridList;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.smartdevice.face.feature';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->modelType, 'modelType');
        RequestCheckUtil::checkNotNull($this->modelVersion, 'modelVersion');
        RequestCheckUtil::checkNotNull($this->useridList, 'useridList');
        RequestCheckUtil::checkMaxListSize($this->useridList, 20, 'useridList');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
