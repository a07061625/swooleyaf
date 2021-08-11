<?php

namespace AlibabaCloud\Live;

/**
 * @method string getOssEndpoint()
 * @method $this withOssEndpoint($value)
 * @method string getOssObject()
 * @method $this withOssObject($value)
 * @method array getScene()
 * @method string getAppName()
 * @method $this withAppName($value)
 * @method string getSecurityToken()
 * @method $this withSecurityToken($value)
 * @method string getOssBucket()
 * @method $this withOssBucket($value)
 * @method string getDomainName()
 * @method $this withDomainName($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getInterval()
 * @method $this withInterval($value)
 */
class AddLiveSnapshotDetectPornConfig extends Rpc
{
    /**
     * @return $this
     */
    public function withScene(array $scene)
    {
        $this->data['Scene'] = $scene;
        foreach ($scene as $i => $iValue) {
            $this->options['query']['Scene.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
