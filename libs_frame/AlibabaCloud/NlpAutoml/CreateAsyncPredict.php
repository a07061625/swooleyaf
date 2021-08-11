<?php

namespace AlibabaCloud\NlpAutoml;

/**
 * @method string getTopK()
 * @method string getFileType()
 * @method string getDetailTag()
 * @method string getFetchContent()
 * @method string getContent()
 * @method string getFileContent()
 * @method string getProduct()
 * @method string getModelId()
 * @method string getFileUrl()
 * @method string getModelVersion()
 */
class CreateAsyncPredict extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTopK($value)
    {
        $this->data['TopK'] = $value;
        $this->options['form_params']['TopK'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFileType($value)
    {
        $this->data['FileType'] = $value;
        $this->options['form_params']['FileType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDetailTag($value)
    {
        $this->data['DetailTag'] = $value;
        $this->options['form_params']['DetailTag'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFetchContent($value)
    {
        $this->data['FetchContent'] = $value;
        $this->options['form_params']['FetchContent'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withContent($value)
    {
        $this->data['Content'] = $value;
        $this->options['form_params']['Content'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFileContent($value)
    {
        $this->data['FileContent'] = $value;
        $this->options['form_params']['FileContent'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProduct($value)
    {
        $this->data['Product'] = $value;
        $this->options['form_params']['Product'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withModelId($value)
    {
        $this->data['ModelId'] = $value;
        $this->options['form_params']['ModelId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFileUrl($value)
    {
        $this->data['FileUrl'] = $value;
        $this->options['form_params']['FileUrl'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withModelVersion($value)
    {
        $this->data['ModelVersion'] = $value;
        $this->options['form_params']['ModelVersion'] = $value;

        return $this;
    }
}
