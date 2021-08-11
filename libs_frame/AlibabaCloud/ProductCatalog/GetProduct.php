<?php

namespace AlibabaCloud\ProductCatalog;

/**
 * @method string getProductId()
 * @method $this withProductId($value)
 * @method string getLanguage()
 */
class GetProduct extends Roa
{
    /** @var string */
    public $pathPattern = '/products/v1/public/[ProductId]/';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLanguage($value)
    {
        $this->data['Language'] = $value;
        $this->options['query']['Language'] = $value;

        return $this;
    }
}
