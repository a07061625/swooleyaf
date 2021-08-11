<?php

namespace AlibabaCloud\DataworksPublic;

/**
 * @method string getFolderName()
 * @method string getProjectId()
 * @method string getProjectIdentifier()
 * @method string getFolderId()
 */
class UpdateFolder extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFolderName($value)
    {
        $this->data['FolderName'] = $value;
        $this->options['form_params']['FolderName'] = $value;

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
