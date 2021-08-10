<?php

namespace AlibabaCloud\Dts;

/**
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getMigrationModeDataInitialization()
 * @method string getMigrationJobId()
 * @method $this withMigrationJobId($value)
 * @method string getPageNum()
 * @method $this withPageNum($value)
 * @method string getAccountId()
 * @method $this withAccountId($value)
 * @method string getMigrationModeDataSynchronization()
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getMigrationModeStructureInitialization()
 */
class DescribeMigrationJobDetail extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMigrationModeDataInitialization($value)
    {
        $this->data['MigrationModeDataInitialization'] = $value;
        $this->options['query']['MigrationMode.DataInitialization'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMigrationModeDataSynchronization($value)
    {
        $this->data['MigrationModeDataSynchronization'] = $value;
        $this->options['query']['MigrationMode.DataSynchronization'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMigrationModeStructureInitialization($value)
    {
        $this->data['MigrationModeStructureInitialization'] = $value;
        $this->options['query']['MigrationMode.StructureInitialization'] = $value;

        return $this;
    }
}
