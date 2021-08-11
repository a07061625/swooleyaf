<?php

namespace AlibabaCloud\Iqa;

/**
 * @method string getDictionaryFileUrl()
 * @method string getProjectId()
 * @method string getDictionaryData()
 */
class UploadDictionary extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDictionaryFileUrl($value)
    {
        $this->data['DictionaryFileUrl'] = $value;
        $this->options['form_params']['DictionaryFileUrl'] = $value;

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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDictionaryData($value)
    {
        $this->data['DictionaryData'] = $value;
        $this->options['form_params']['DictionaryData'] = $value;

        return $this;
    }
}
