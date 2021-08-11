<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getEcuId()
 */
class DeleteEcu extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/resource/delete_ecu';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEcuId($value)
    {
        $this->data['EcuId'] = $value;
        $this->options['query']['EcuId'] = $value;

        return $this;
    }
}
