<?php

namespace AlibabaCloud\Retailcloud;

/**
 * @method string getDBName()
 * @method string getDBInstanceId()
 */
class DeleteDatabase extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDBName($value)
    {
        $this->data['DBName'] = $value;
        $this->options['form_params']['DBName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDBInstanceId($value)
    {
        $this->data['DBInstanceId'] = $value;
        $this->options['form_params']['DBInstanceId'] = $value;

        return $this;
    }
}
