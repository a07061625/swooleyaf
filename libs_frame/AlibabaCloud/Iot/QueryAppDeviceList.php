<?php

namespace AlibabaCloud\Iot;

/**
 * @method array getTagList()
 * @method array getProductKeyList()
 * @method string getIotInstanceId()
 * @method $this withIotInstanceId($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getCurrentPage()
 * @method $this withCurrentPage($value)
 * @method array getCategoryKeyList()
 * @method string getApiProduct()
 * @method string getApiRevision()
 * @method string getAppKey()
 * @method $this withAppKey($value)
 */
class QueryAppDeviceList extends Rpc
{
    /**
     * @return $this
     */
    public function withTagList(array $tagList)
    {
        $this->data['TagList'] = $tagList;
        foreach ($tagList as $depth1 => $depth1Value) {
            if (isset($depth1Value['TagName'])) {
                $this->options['query']['TagList.' . ($depth1 + 1) . '.TagName'] = $depth1Value['TagName'];
            }
            if (isset($depth1Value['TagValue'])) {
                $this->options['query']['TagList.' . ($depth1 + 1) . '.TagValue'] = $depth1Value['TagValue'];
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withProductKeyList(array $productKeyList)
    {
        $this->data['ProductKeyList'] = $productKeyList;
        foreach ($productKeyList as $i => $iValue) {
            $this->options['query']['ProductKeyList.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withCategoryKeyList(array $categoryKeyList)
    {
        $this->data['CategoryKeyList'] = $categoryKeyList;
        foreach ($categoryKeyList as $i => $iValue) {
            $this->options['query']['CategoryKeyList.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withApiProduct($value)
    {
        $this->data['ApiProduct'] = $value;
        $this->options['form_params']['ApiProduct'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withApiRevision($value)
    {
        $this->data['ApiRevision'] = $value;
        $this->options['form_params']['ApiRevision'] = $value;

        return $this;
    }
}
