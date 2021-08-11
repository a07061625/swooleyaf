<?php

namespace AlibabaCloud\Cms;

/**
 * @method array getWebhookParameters()
 * @method array getContactParameters()
 * @method array getSlsParameters()
 * @method string getRuleName()
 * @method $this withRuleName($value)
 * @method array getMnsParameters()
 * @method array getFcParameters()
 */
class PutEventRuleTargets extends Rpc
{
    /**
     * @return $this
     */
    public function withWebhookParameters(array $webhookParameters)
    {
        $this->data['WebhookParameters'] = $webhookParameters;
        foreach ($webhookParameters as $depth1 => $depth1Value) {
            if (isset($depth1Value['Protocol'])) {
                $this->options['query']['WebhookParameters.' . ($depth1 + 1) . '.Protocol'] = $depth1Value['Protocol'];
            }
            if (isset($depth1Value['Method'])) {
                $this->options['query']['WebhookParameters.' . ($depth1 + 1) . '.Method'] = $depth1Value['Method'];
            }
            if (isset($depth1Value['Id'])) {
                $this->options['query']['WebhookParameters.' . ($depth1 + 1) . '.Id'] = $depth1Value['Id'];
            }
            if (isset($depth1Value['Url'])) {
                $this->options['query']['WebhookParameters.' . ($depth1 + 1) . '.Url'] = $depth1Value['Url'];
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withContactParameters(array $contactParameters)
    {
        $this->data['ContactParameters'] = $contactParameters;
        foreach ($contactParameters as $depth1 => $depth1Value) {
            if (isset($depth1Value['Level'])) {
                $this->options['query']['ContactParameters.' . ($depth1 + 1) . '.Level'] = $depth1Value['Level'];
            }
            if (isset($depth1Value['Id'])) {
                $this->options['query']['ContactParameters.' . ($depth1 + 1) . '.Id'] = $depth1Value['Id'];
            }
            if (isset($depth1Value['ContactGroupName'])) {
                $this->options['query']['ContactParameters.' . ($depth1 + 1) . '.ContactGroupName'] = $depth1Value['ContactGroupName'];
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withSlsParameters(array $slsParameters)
    {
        $this->data['SlsParameters'] = $slsParameters;
        foreach ($slsParameters as $depth1 => $depth1Value) {
            if (isset($depth1Value['Project'])) {
                $this->options['query']['SlsParameters.' . ($depth1 + 1) . '.Project'] = $depth1Value['Project'];
            }
            if (isset($depth1Value['Id'])) {
                $this->options['query']['SlsParameters.' . ($depth1 + 1) . '.Id'] = $depth1Value['Id'];
            }
            if (isset($depth1Value['Region'])) {
                $this->options['query']['SlsParameters.' . ($depth1 + 1) . '.Region'] = $depth1Value['Region'];
            }
            if (isset($depth1Value['LogStore'])) {
                $this->options['query']['SlsParameters.' . ($depth1 + 1) . '.LogStore'] = $depth1Value['LogStore'];
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withMnsParameters(array $mnsParameters)
    {
        $this->data['MnsParameters'] = $mnsParameters;
        foreach ($mnsParameters as $depth1 => $depth1Value) {
            if (isset($depth1Value['Id'])) {
                $this->options['query']['MnsParameters.' . ($depth1 + 1) . '.Id'] = $depth1Value['Id'];
            }
            if (isset($depth1Value['Region'])) {
                $this->options['query']['MnsParameters.' . ($depth1 + 1) . '.Region'] = $depth1Value['Region'];
            }
            if (isset($depth1Value['Queue'])) {
                $this->options['query']['MnsParameters.' . ($depth1 + 1) . '.Queue'] = $depth1Value['Queue'];
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withFcParameters(array $fcParameters)
    {
        $this->data['FcParameters'] = $fcParameters;
        foreach ($fcParameters as $depth1 => $depth1Value) {
            if (isset($depth1Value['FunctionName'])) {
                $this->options['query']['FcParameters.' . ($depth1 + 1) . '.FunctionName'] = $depth1Value['FunctionName'];
            }
            if (isset($depth1Value['ServiceName'])) {
                $this->options['query']['FcParameters.' . ($depth1 + 1) . '.ServiceName'] = $depth1Value['ServiceName'];
            }
            if (isset($depth1Value['Id'])) {
                $this->options['query']['FcParameters.' . ($depth1 + 1) . '.Id'] = $depth1Value['Id'];
            }
            if (isset($depth1Value['Region'])) {
                $this->options['query']['FcParameters.' . ($depth1 + 1) . '.Region'] = $depth1Value['Region'];
            }
        }

        return $this;
    }
}
