<?php

namespace AlibabaCloud\Live;

/**
 * @method string getHtmlUrl()
 * @method $this withHtmlUrl($value)
 * @method string getCasterId()
 * @method $this withCasterId($value)
 * @method string getHtmlContent()
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getHtmlResourceId()
 * @method $this withHtmlResourceId($value)
 * @method string getConfig()
 * @method $this withConfig($value)
 */
class EditHtmlResource extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withHtmlContent($value)
    {
        $this->data['HtmlContent'] = $value;
        $this->options['query']['htmlContent'] = $value;

        return $this;
    }
}
