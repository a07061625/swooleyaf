<?php

namespace AlibabaCloud\Cloudmarketing;

/**
 * @method array getTagIds()
 * @method string getCrowdId()
 * @method $this withCrowdId($value)
 */
class AnalysisCrowd extends Rpc
{
    /**
     * @return $this
     */
    public function withTagIds(array $tagIds)
    {
        $this->data['TagIds'] = $tagIds;
        foreach ($tagIds as $i => $iValue) {
            $this->options['query']['TagIds.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
