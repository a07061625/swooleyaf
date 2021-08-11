<?php

namespace AlibabaCloud\DataworksPublic;

/**
 * @method string getMigrationId()
 * @method string getProjectId()
 */
class StartMigration extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMigrationId($value)
    {
        $this->data['MigrationId'] = $value;
        $this->options['form_params']['MigrationId'] = $value;

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
