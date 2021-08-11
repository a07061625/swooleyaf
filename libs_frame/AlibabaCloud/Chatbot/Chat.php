<?php

namespace AlibabaCloud\Chatbot;

/**
 * @method string getKnowledgeId()
 * @method $this withKnowledgeId($value)
 * @method string getSenderId()
 * @method $this withSenderId($value)
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getSenderNick()
 * @method $this withSenderNick($value)
 * @method array getPerspective()
 * @method string getRecommend()
 * @method $this withRecommend($value)
 * @method string getSessionId()
 * @method $this withSessionId($value)
 * @method string getTag()
 * @method $this withTag($value)
 * @method string getUtterance()
 * @method $this withUtterance($value)
 */
class Chat extends Rpc
{
    /**
     * @return $this
     */
    public function withPerspective(array $perspective)
    {
        $this->data['Perspective'] = $perspective;
        foreach ($perspective as $i => $iValue) {
            $this->options['query']['Perspective.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
