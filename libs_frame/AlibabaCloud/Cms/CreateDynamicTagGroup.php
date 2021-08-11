<?php

namespace AlibabaCloud\Cms;

/**
 * @method string getEnableSubscribeEvent()
 * @method $this withEnableSubscribeEvent($value)
 * @method string getMatchExpressFilterRelation()
 * @method $this withMatchExpressFilterRelation($value)
 * @method string getEnableInstallAgent()
 * @method $this withEnableInstallAgent($value)
 * @method array getMatchExpress()
 * @method array getContactGroupList()
 * @method array getTemplateIdList()
 * @method string getTagKey()
 * @method $this withTagKey($value)
 */
class CreateDynamicTagGroup extends Rpc
{
    /**
     * @return $this
     */
    public function withMatchExpress(array $matchExpress)
    {
        $this->data['MatchExpress'] = $matchExpress;
        foreach ($matchExpress as $depth1 => $depth1Value) {
            if (isset($depth1Value['TagValue'])) {
                $this->options['query']['MatchExpress.' . ($depth1 + 1) . '.TagValue'] = $depth1Value['TagValue'];
            }
            if (isset($depth1Value['TagValueMatchFunction'])) {
                $this->options['query']['MatchExpress.' . ($depth1 + 1) . '.TagValueMatchFunction'] = $depth1Value['TagValueMatchFunction'];
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withContactGroupList(array $contactGroupList)
    {
        $this->data['ContactGroupList'] = $contactGroupList;
        foreach ($contactGroupList as $i => $iValue) {
            $this->options['query']['ContactGroupList.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withTemplateIdList(array $templateIdList)
    {
        $this->data['TemplateIdList'] = $templateIdList;
        foreach ($templateIdList as $i => $iValue) {
            $this->options['query']['TemplateIdList.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
