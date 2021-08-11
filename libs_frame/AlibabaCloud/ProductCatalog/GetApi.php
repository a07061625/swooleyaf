<?php

namespace AlibabaCloud\ProductCatalog;

/**
 * @method string getVersionId()
 * @method $this withVersionId($value)
 * @method string getProductId()
 * @method $this withProductId($value)
 * @method string getReader()
 * @method string getLanguage()
 * @method string getApiId()
 * @method $this withApiId($value)
 */
class GetApi extends Roa
{
    /** @var string */
    public $pathPattern = '/products/v1/public/[ProductId]/versions/[VersionId]/apis/[ApiId]';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withReader($value)
    {
        $this->data['Reader'] = $value;
        $this->options['query']['Reader'] = $value;

        return $this;
    }

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
