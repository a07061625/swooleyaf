<?php

namespace AlibabaCloud\Emr;

/**
 * @method array getTemplateTagSet()
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 */
class ReleaseClusterByTemplateTagForInternal extends Rpc
{
    /**
     * @return $this
     */
    public function withTemplateTagSet(array $templateTagSet)
    {
        $this->data['TemplateTagSet'] = $templateTagSet;
        foreach ($templateTagSet as $i => $iValue) {
            $this->options['query']['TemplateTagSet.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
