<?php

namespace AlibabaCloud\EHPC;

/**
 * @method array getRepo()
 * @method string getDBServerInfo()
 * @method $this withDBServerInfo($value)
 * @method string getClusterId()
 * @method $this withClusterId($value)
 * @method string getDefaultRepoLocation()
 * @method $this withDefaultRepoLocation($value)
 * @method string getDBPassword()
 * @method $this withDBPassword($value)
 * @method string getDBType()
 * @method $this withDBType($value)
 * @method string getDBUsername()
 * @method $this withDBUsername($value)
 * @method string getPullUpdateTimeout()
 * @method $this withPullUpdateTimeout($value)
 * @method string getImageExpirationTimeout()
 * @method $this withImageExpirationTimeout($value)
 */
class ModifyImageGatewayConfig extends Rpc
{
    /**
     * @return $this
     */
    public function withRepo(array $repo)
    {
        $this->data['Repo'] = $repo;
        foreach ($repo as $depth1 => $depth1Value) {
            if (isset($depth1Value['Auth'])) {
                $this->options['query']['Repo.' . ($depth1 + 1) . '.Auth'] = $depth1Value['Auth'];
            }
            if (isset($depth1Value['Location'])) {
                $this->options['query']['Repo.' . ($depth1 + 1) . '.Location'] = $depth1Value['Location'];
            }
            if (isset($depth1Value['URL'])) {
                $this->options['query']['Repo.' . ($depth1 + 1) . '.URL'] = $depth1Value['URL'];
            }
        }

        return $this;
    }
}
