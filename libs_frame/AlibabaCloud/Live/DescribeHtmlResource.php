<?php

namespace AlibabaCloud\Live;

/**
 * @method string getHtmlUrl()
 * @method string getCasterId()
 * @method $this withCasterId($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getHtmlResourceId()
 * @method $this withHtmlResourceId($value)
 */
class DescribeHtmlResource extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withHtmlUrl($value)
    {
        $this->data['HtmlUrl'] = $value;
        $this->options['query']['htmlUrl'] = $value;

        return $this;
    }
}
