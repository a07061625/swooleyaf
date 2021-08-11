<?php

namespace AlibabaCloud\Sae;

/**
 * @method string getAppIds()
 * @method string getNamespaceId()
 */
class BatchStopApplications extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v1/sam/app/batchStopApplications';

    /** @var string */
    public $method = 'PUT';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAppIds($value)
    {
        $this->data['AppIds'] = $value;
        $this->options['query']['AppIds'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withNamespaceId($value)
    {
        $this->data['NamespaceId'] = $value;
        $this->options['query']['NamespaceId'] = $value;

        return $this;
    }
}
