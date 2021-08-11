<?php

namespace AlibabaCloud\Scsp;

/**
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getDataIdStart()
 * @method $this withDataIdStart($value)
 * @method string getDataIdEnd()
 * @method $this withDataIdEnd($value)
 * @method string getDataId()
 * @method $this withDataId($value)
 * @method string getHourId()
 * @method $this withHourId($value)
 * @method string getMinuteId()
 * @method $this withMinuteId($value)
 * @method string getPhoneNumbers()
 * @method $this withPhoneNumbers($value)
 * @method string getHavePhoneNumbers()
 * @method $this withHavePhoneNumbers($value)
 * @method string getPageNo()
 * @method $this withPageNo($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 */
class GetCallsPerDay extends Rpc
{
    /** @var string */
    public $method = 'GET';
}
