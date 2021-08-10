<?php

namespace AlibabaCloud\Sas;

/**
 * @method string getRepoId()
 * @method $this withRepoId($value)
 * @method string getFuzzyMaliciousName()
 * @method $this withFuzzyMaliciousName($value)
 * @method string getRepoNamespace()
 * @method $this withRepoNamespace($value)
 * @method string getSourceIp()
 * @method $this withSourceIp($value)
 * @method string getImageDigest()
 * @method $this withImageDigest($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getLang()
 * @method $this withLang($value)
 * @method string getImageTag()
 * @method $this withImageTag($value)
 * @method string getCurrentPage()
 * @method $this withCurrentPage($value)
 * @method string getRepoName()
 * @method $this withRepoName($value)
 * @method string getRepoInstanceId()
 * @method $this withRepoInstanceId($value)
 * @method string getImageLayer()
 * @method $this withImageLayer($value)
 * @method string getLevels()
 * @method $this withLevels($value)
 * @method array getUuids()
 * @method string getRepoRegionId()
 * @method $this withRepoRegionId($value)
 */
class DescribeGroupedMaliciousFiles extends Rpc
{
    /**
     * @return $this
     */
    public function withUuids(array $uuids)
    {
        $this->data['Uuids'] = $uuids;
        foreach ($uuids as $i => $iValue) {
            $this->options['query']['Uuids.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
