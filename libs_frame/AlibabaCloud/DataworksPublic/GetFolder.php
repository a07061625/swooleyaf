<?php

namespace AlibabaCloud\DataworksPublic;

/**
 * @method string getFolderPath()
 * @method string getProjectId()
 * @method string getProjectIdentifier()
 * @method string getFolderId()
 */
class GetFolder extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFolderPath($value)
    {
        $this->data['FolderPath'] = $value;
        $this->options['form_params']['FolderPath'] = $value;

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
    public function withFolderId($value)
    {
        $this->data['FolderId'] = $value;
        $this->options['form_params']['FolderId'] = $value;

        return $this;
    }
}
