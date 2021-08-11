<?php

namespace AlibabaCloud\Cms;

/**
 * @method array getGroupIds()
 * @method array getTag()
 */
class RemoveTags extends Rpc
{
    /**
     * @return $this
     */
    public function withGroupIds(array $groupIds)
    {
        $this->data['GroupIds'] = $groupIds;
        foreach ($groupIds as $i => $iValue) {
            $this->options['query']['GroupIds.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withTag(array $tag)
    {
        $this->data['Tag'] = $tag;
        foreach ($tag as $depth1 => $depth1Value) {
            if (isset($depth1Value['Value'])) {
                $this->options['query']['Tag.' . ($depth1 + 1) . '.Value'] = $depth1Value['Value'];
            }
            if (isset($depth1Value['Key'])) {
                $this->options['query']['Tag.' . ($depth1 + 1) . '.Key'] = $depth1Value['Key'];
            }
        }

        return $this;
    }
}
