<?php

namespace AlibabaCloud\Ivision;

/**
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getAutoStart()
 * @method $this withAutoStart($value)
 * @method string getNotify()
 * @method $this withNotify($value)
 * @method string getOutput()
 * @method $this withOutput($value)
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getStreamType()
 * @method $this withStreamType($value)
 * @method string getFaceGroupId()
 * @method $this withFaceGroupId($value)
 * @method string getStreamId()
 * @method $this withStreamId($value)
 * @method string getPredictTemplateId()
 * @method $this withPredictTemplateId($value)
 * @method string getDetectIntervals()
 * @method $this withDetectIntervals($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getProbabilityThresholds()
 * @method $this withProbabilityThresholds($value)
 * @method string getModelIds()
 * @method $this withModelIds($value)
 * @method string getModelUserData()
 * @method $this withModelUserData($value)
 */
class CreateStreamPredict extends Rpc
{
    /** @var string */
    public $method = 'POST';
}
