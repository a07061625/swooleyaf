<?php

namespace AlibabaCloud\DataworksPublic;

/**
 * @method string getOwner()
 * @method string getFileTypes()
 * @method string getProjectIdentifier()
 * @method string getPageNumber()
 * @method string getFileFolderPath()
 * @method string getPageSize()
 * @method string getKeyword()
 * @method string getProjectId()
 * @method string getUseType()
 */
class ListFiles extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOwner($value)
    {
        $this->data['Owner'] = $value;
        $this->options['form_params']['Owner'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFileTypes($value)
    {
        $this->data['FileTypes'] = $value;
        $this->options['form_params']['FileTypes'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProjectIdentifier($value)
    {
        $this->data['ProjectIdentifier'] = $value;
        $this->options['form_params']['ProjectIdentifier'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPageNumber($value)
    {
        $this->data['PageNumber'] = $value;
        $this->options['form_params']['PageNumber'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFileFolderPath($value)
    {
        $this->data['FileFolderPath'] = $value;
        $this->options['form_params']['FileFolderPath'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPageSize($value)
    {
        $this->data['PageSize'] = $value;
        $this->options['form_params']['PageSize'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withKeyword($value)
    {
        $this->data['Keyword'] = $value;
        $this->options['form_params']['Keyword'] = $value;

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
    public function withUseType($value)
    {
        $this->data['UseType'] = $value;
        $this->options['form_params']['UseType'] = $value;

        return $this;
    }
}
