<?php

namespace AlibabaCloud\Emr;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getPageCount()
 * @method $this withPageCount($value)
 * @method string getOrderMode()
 * @method $this withOrderMode($value)
 * @method string getBackupPlanId()
 * @method $this withBackupPlanId($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getLimit()
 * @method $this withLimit($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getServiceName()
 * @method $this withServiceName($value)
 * @method string getId()
 * @method $this withId($value)
 * @method string getCurrentSize()
 * @method $this withCurrentSize($value)
 * @method array getBackupId()
 * @method string getClusterId()
 * @method $this withClusterId($value)
 * @method string getMetadataType()
 * @method $this withMetadataType($value)
 * @method string getBizId()
 * @method $this withBizId($value)
 * @method string getStatus()
 * @method $this withStatus($value)
 */
class ListBackups extends Rpc
{
    /**
     * @return $this
     */
    public function withBackupId(array $backupId)
    {
        $this->data['BackupId'] = $backupId;
        foreach ($backupId as $i => $iValue) {
            $this->options['query']['BackupId.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
