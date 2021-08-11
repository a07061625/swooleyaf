<?php

namespace AlibabaCloud\Imageprocess;

/**
 * @method string getSessionId()
 * @method string getOrgName()
 * @method array getAnswerImageDataList()
 * @method array getAnswerTextList()
 * @method string getDepartment()
 * @method array getAnswerImageURLList()
 * @method string getQuestionType()
 * @method string getOrgId()
 */
class RunMedQA extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSessionId($value)
    {
        $this->data['SessionId'] = $value;
        $this->options['form_params']['SessionId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOrgName($value)
    {
        $this->data['OrgName'] = $value;
        $this->options['form_params']['OrgName'] = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function withAnswerImageDataList(array $answerImageDataList)
    {
        $this->data['AnswerImageDataList'] = $answerImageDataList;
        foreach ($answerImageDataList as $depth1 => $depth1Value) {
            if (isset($depth1Value['AnswerImageData'])) {
                $this->options['form_params']['AnswerImageDataList.' . ($depth1 + 1) . '.AnswerImageData'] = $depth1Value['AnswerImageData'];
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withAnswerTextList(array $answerTextList)
    {
        $this->data['AnswerTextList'] = $answerTextList;
        foreach ($answerTextList as $depth1 => $depth1Value) {
            if (isset($depth1Value['AnswerText'])) {
                $this->options['form_params']['AnswerTextList.' . ($depth1 + 1) . '.AnswerText'] = $depth1Value['AnswerText'];
            }
        }

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDepartment($value)
    {
        $this->data['Department'] = $value;
        $this->options['form_params']['Department'] = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function withAnswerImageURLList(array $answerImageURLList)
    {
        $this->data['AnswerImageURLList'] = $answerImageURLList;
        foreach ($answerImageURLList as $depth1 => $depth1Value) {
            if (isset($depth1Value['AnswerImageURL'])) {
                $this->options['form_params']['AnswerImageURLList.' . ($depth1 + 1) . '.AnswerImageURL'] = $depth1Value['AnswerImageURL'];
            }
        }

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withQuestionType($value)
    {
        $this->data['QuestionType'] = $value;
        $this->options['form_params']['QuestionType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOrgId($value)
    {
        $this->data['OrgId'] = $value;
        $this->options['form_params']['OrgId'] = $value;

        return $this;
    }
}
