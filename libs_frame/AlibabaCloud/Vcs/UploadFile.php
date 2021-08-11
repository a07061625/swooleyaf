<?php

namespace AlibabaCloud\Vcs;

/**
 * @method string getFileType()
 * @method string getCorpId()
 * @method string getFileAliasName()
 * @method string getFileName()
 * @method string getFilePath()
 * @method string getFileContent()
 * @method string getDataSourceId()
 * @method string getMD5()
 */
class UploadFile extends Rpc
{
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
    public function withCorpId($value)
    {
        $this->data['CorpId'] = $value;
        $this->options['form_params']['CorpId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFileAliasName($value)
    {
        $this->data['FileAliasName'] = $value;
        $this->options['form_params']['FileAliasName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFileName($value)
    {
        $this->data['FileName'] = $value;
        $this->options['form_params']['FileName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFilePath($value)
    {
        $this->data['FilePath'] = $value;
        $this->options['form_params']['FilePath'] = $value;

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
    public function withDataSourceId($value)
    {
        $this->data['DataSourceId'] = $value;
        $this->options['form_params']['DataSourceId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMD5($value)
    {
        $this->data['MD5'] = $value;
        $this->options['form_params']['MD5'] = $value;

        return $this;
    }
}
