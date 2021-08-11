<?php

namespace AlibabaCloud\ProductCatalog;

/**
 * @method string getVersionId()
 * @method $this withVersionId($value)
 * @method string getProductId()
 * @method $this withProductId($value)
 * @method string getLimit()
 * @method string getLanguage()
 * @method string getPage()
 */
class ListApis extends Roa
{
    /** @var string */
    public $pathPattern = '/products/v1/public/[ProductId]/versions/[VersionId]/apis/';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLimit($value)
    {
        $this->data['Limit'] = $value;
        $this->options['query']['Limit'] = $value;

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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPage($value)
    {
        $this->data['Page'] = $value;
        $this->options['query']['Page'] = $value;

        return $this;
    }
}
