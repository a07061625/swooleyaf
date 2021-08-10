<?php

namespace AlibabaCloud\Dds;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getEngineVersion()
 * @method $this withEngineVersion($value)
 * @method string getNetworkType()
 * @method $this withNetworkType($value)
 * @method array getReplicaSet()
 * @method string getStorageEngine()
 * @method $this withStorageEngine($value)
 * @method string getSecurityToken()
 * @method $this withSecurityToken($value)
 * @method string getEngine()
 * @method $this withEngine($value)
 * @method string getDBInstanceDescription()
 * @method $this withDBInstanceDescription($value)
 * @method string getPeriod()
 * @method $this withPeriod($value)
 * @method string getRestoreTime()
 * @method $this withRestoreTime($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getSrcDBInstanceId()
 * @method $this withSrcDBInstanceId($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method array getConfigServer()
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getSecurityIPList()
 * @method $this withSecurityIPList($value)
 * @method string getVSwitchId()
 * @method $this withVSwitchId($value)
 * @method array getMongos()
 * @method string getAccountPassword()
 * @method $this withAccountPassword($value)
 * @method string getAutoRenew()
 * @method $this withAutoRenew($value)
 * @method string getVpcId()
 * @method $this withVpcId($value)
 * @method string getZoneId()
 * @method $this withZoneId($value)
 * @method string getProtocolType()
 * @method $this withProtocolType($value)
 * @method string getChargeType()
 * @method $this withChargeType($value)
 */
class CreateShardingDBInstance extends Rpc
{
    /**
     * @return $this
     */
    public function withReplicaSet(array $replicaSet)
    {
        $this->data['ReplicaSet'] = $replicaSet;
        foreach ($replicaSet as $depth1 => $depth1Value) {
            if (isset($depth1Value['ReadonlyReplicas'])) {
                $this->options['query']['ReplicaSet.' . ($depth1 + 1) . '.ReadonlyReplicas'] = $depth1Value['ReadonlyReplicas'];
            }
            if (isset($depth1Value['Storage'])) {
                $this->options['query']['ReplicaSet.' . ($depth1 + 1) . '.Storage'] = $depth1Value['Storage'];
            }
            if (isset($depth1Value['Class'])) {
                $this->options['query']['ReplicaSet.' . ($depth1 + 1) . '.Class'] = $depth1Value['Class'];
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withConfigServer(array $configServer)
    {
        $this->data['ConfigServer'] = $configServer;
        foreach ($configServer as $depth1 => $depth1Value) {
            if (isset($depth1Value['Storage'])) {
                $this->options['query']['ConfigServer.' . ($depth1 + 1) . '.Storage'] = $depth1Value['Storage'];
            }
            if (isset($depth1Value['Class'])) {
                $this->options['query']['ConfigServer.' . ($depth1 + 1) . '.Class'] = $depth1Value['Class'];
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withMongos(array $mongos)
    {
        $this->data['Mongos'] = $mongos;
        foreach ($mongos as $depth1 => $depth1Value) {
            if (isset($depth1Value['Class'])) {
                $this->options['query']['Mongos.' . ($depth1 + 1) . '.Class'] = $depth1Value['Class'];
            }
        }

        return $this;
    }
}
