<?php

namespace AlibabaCloud\Iqa;

/**
 * @method string getDocumentData()
 * @method string getDocumentFileUrl()
 * @method string getProjectId()
 */
class UploadDocument extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDocumentData($value)
    {
        $this->data['DocumentData'] = $value;
        $this->options['form_params']['DocumentData'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDocumentFileUrl($value)
    {
        $this->data['DocumentFileUrl'] = $value;
        $this->options['form_params']['DocumentFileUrl'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProjectId($value)
    {
        $this->data['ProjectId'] = $value;
        $this->options['form_params']['ProjectId'] = $value;

        return $this;
    }
}
