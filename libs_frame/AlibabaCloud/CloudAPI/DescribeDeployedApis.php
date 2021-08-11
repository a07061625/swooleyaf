<?php

namespace AlibabaCloud\CloudAPI;

/**
 * @method string getStageName()
 * @method $this withStageName($value)
 * @method string getGroupId()
 * @method $this withGroupId($value)
 * @method string getEnableTagAuth()
 * @method $this withEnableTagAuth($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getApiName()
 * @method $this withApiName($value)
 * @method string getSecurityToken()
 * @method $this withSecurityToken($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method array getTag()
 * @method string getApiId()
 * @method $this withApiId($value)
 */
class DescribeDeployedApis extends Rpc
{
    /**
     * @return $this
     */
    public function withTag(array $tag)
    {
        $this->data['Tag'] = $tag;
        foreach ($tag as $depth1 => $depth1Value) {
            $this->options['query']['Tag.' . ($depth1 + 1) . '.Value'] = $depth1Value['Value'];
            $this->options['query']['Tag.' . ($depth1 + 1) . '.Key'] = $depth1Value['Key'];
        }

        return $this;
    }
}
