<?php

namespace AlibabaCloud\DataworksPublic;

/**
 * @method string getVisibility()
 * @method $this withVisibility($value)
 * @method string getCaption()
 * @method $this withCaption($value)
 * @method string getNewOwnerId()
 * @method $this withNewOwnerId($value)
 * @method string getTableGuid()
 * @method $this withTableGuid($value)
 * @method string getAddedLabels()
 * @method string getRemovedLabels()
 * @method string getEnvType()
 * @method $this withEnvType($value)
 * @method string getTableName()
 * @method $this withTableName($value)
 * @method string getProjectId()
 * @method $this withProjectId($value)
 * @method string getCategoryId()
 * @method $this withCategoryId($value)
 */
class UpdateMetaTable extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAddedLabels($value)
    {
        $this->data['AddedLabels'] = $value;
        $this->options['form_params']['AddedLabels'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withRemovedLabels($value)
    {
        $this->data['RemovedLabels'] = $value;
        $this->options['form_params']['RemovedLabels'] = $value;

        return $this;
    }
}
