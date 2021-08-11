<?php

namespace AlibabaCloud\Drds;

/**
 * @method string getEncode()
 * @method $this withEncode($value)
 * @method array getRdsInstance()
 * @method string getType()
 * @method $this withType($value)
 * @method string getPassword()
 * @method $this withPassword($value)
 * @method array getRdsSuperAccount()
 * @method string getAccountName()
 * @method $this withAccountName($value)
 * @method string getDrdsInstanceId()
 * @method $this withDrdsInstanceId($value)
 * @method string getDbInstanceIsCreating()
 * @method $this withDbInstanceIsCreating($value)
 * @method array getInstDbName()
 * @method string getDbName()
 * @method $this withDbName($value)
 * @method string getDbInstType()
 * @method $this withDbInstType($value)
 */
class CreateDrdsDB extends Rpc
{
    /**
     * @return $this
     */
    public function withRdsInstance(array $rdsInstance)
    {
        $this->data['RdsInstance'] = $rdsInstance;
        foreach ($rdsInstance as $i => $iValue) {
            $this->options['query']['RdsInstance.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withRdsSuperAccount(array $rdsSuperAccount)
    {
        $this->data['RdsSuperAccount'] = $rdsSuperAccount;
        foreach ($rdsSuperAccount as $depth1 => $depth1Value) {
            if (isset($depth1Value['Password'])) {
                $this->options['query']['RdsSuperAccount.' . ($depth1 + 1) . '.Password'] = $depth1Value['Password'];
            }
            if (isset($depth1Value['AccountName'])) {
                $this->options['query']['RdsSuperAccount.' . ($depth1 + 1) . '.AccountName'] = $depth1Value['AccountName'];
            }
            if (isset($depth1Value['DbInstanceId'])) {
                $this->options['query']['RdsSuperAccount.' . ($depth1 + 1) . '.DbInstanceId'] = $depth1Value['DbInstanceId'];
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withInstDbName(array $instDbName)
    {
        $this->data['InstDbName'] = $instDbName;
        foreach ($instDbName as $depth1 => $depth1Value) {
            foreach ($depth1Value['ShardDbName'] as $i => $iValue) {
                $this->options['query']['InstDbName.' . ($depth1 + 1) . '.ShardDbName.' . ($i + 1)] = $iValue;
            }
            if (isset($depth1Value['DbInstanceId'])) {
                $this->options['query']['InstDbName.' . ($depth1 + 1) . '.DbInstanceId'] = $depth1Value['DbInstanceId'];
            }
        }

        return $this;
    }
}
