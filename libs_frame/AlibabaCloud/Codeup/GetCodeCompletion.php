<?php

namespace AlibabaCloud\Codeup;

/**
 * @method string getIsEncrypted()
 * @method string getFetchKeys()
 * @method string getServiceName()
 * @method $this withServiceName($value)
 */
class GetCodeCompletion extends Roa
{
    /** @var string */
    public $pathPattern = '/api/v2/service/invoke/[ServiceName]';

    /** @var string */
    public $method = 'POST';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIsEncrypted($value)
    {
        $this->data['IsEncrypted'] = $value;
        $this->options['query']['IsEncrypted'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFetchKeys($value)
    {
        $this->data['FetchKeys'] = $value;
        $this->options['query']['FetchKeys'] = $value;

        return $this;
    }
}
