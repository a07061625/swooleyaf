<?php

namespace AlibabaCloud\Cbn;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getCommunityMatchMode()
 * @method $this withCommunityMatchMode($value)
 * @method string getMapResult()
 * @method $this withMapResult($value)
 * @method array getDestinationRegionIds()
 * @method string getNextPriority()
 * @method $this withNextPriority($value)
 * @method array getDestinationCidrBlocks()
 * @method string getSystemPolicy()
 * @method $this withSystemPolicy($value)
 * @method array getOriginalRouteTableIds()
 * @method array getSourceInstanceIds()
 * @method array getSourceRegionIds()
 * @method string getGatewayZoneId()
 * @method $this withGatewayZoneId($value)
 * @method array getMatchAsns()
 * @method string getPreference()
 * @method $this withPreference($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getPriority()
 * @method $this withPriority($value)
 * @method array getDestinationChildInstanceTypes()
 * @method array getSourceRouteTableIds()
 * @method array getSourceChildInstanceTypes()
 * @method string getCommunityOperateMode()
 * @method $this withCommunityOperateMode($value)
 * @method array getOperateCommunitySet()
 * @method array getRouteTypes()
 * @method string getMatchAddressType()
 * @method $this withMatchAddressType($value)
 * @method string getCidrMatchMode()
 * @method $this withCidrMatchMode($value)
 * @method string getCenId()
 * @method $this withCenId($value)
 * @method string getDescription()
 * @method $this withDescription($value)
 * @method string getSourceInstanceIdsReverseMatch()
 * @method $this withSourceInstanceIdsReverseMatch($value)
 * @method array getDestinationRouteTableIds()
 * @method array getSourceZoneIds()
 * @method string getTransmitDirection()
 * @method $this withTransmitDirection($value)
 * @method array getDestinationInstanceIds()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getDestinationInstanceIdsReverseMatch()
 * @method $this withDestinationInstanceIdsReverseMatch($value)
 * @method array getPrependAsPath()
 * @method string getAsPathMatchMode()
 * @method $this withAsPathMatchMode($value)
 * @method array getMatchCommunitySet()
 * @method string getCenRegionId()
 * @method $this withCenRegionId($value)
 */
class CreateCenRouteMap extends Rpc
{
    /**
     * @return $this
     */
    public function withDestinationRegionIds(array $destinationRegionIds)
    {
        $this->data['DestinationRegionIds'] = $destinationRegionIds;
        foreach ($destinationRegionIds as $i => $iValue) {
            $this->options['query']['DestinationRegionIds.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withDestinationCidrBlocks(array $destinationCidrBlocks)
    {
        $this->data['DestinationCidrBlocks'] = $destinationCidrBlocks;
        foreach ($destinationCidrBlocks as $i => $iValue) {
            $this->options['query']['DestinationCidrBlocks.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withOriginalRouteTableIds(array $originalRouteTableIds)
    {
        $this->data['OriginalRouteTableIds'] = $originalRouteTableIds;
        foreach ($originalRouteTableIds as $i => $iValue) {
            $this->options['query']['OriginalRouteTableIds.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withSourceInstanceIds(array $sourceInstanceIds)
    {
        $this->data['SourceInstanceIds'] = $sourceInstanceIds;
        foreach ($sourceInstanceIds as $i => $iValue) {
            $this->options['query']['SourceInstanceIds.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withSourceRegionIds(array $sourceRegionIds)
    {
        $this->data['SourceRegionIds'] = $sourceRegionIds;
        foreach ($sourceRegionIds as $i => $iValue) {
            $this->options['query']['SourceRegionIds.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withMatchAsns(array $matchAsns)
    {
        $this->data['MatchAsns'] = $matchAsns;
        foreach ($matchAsns as $i => $iValue) {
            $this->options['query']['MatchAsns.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withDestinationChildInstanceTypes(array $destinationChildInstanceTypes)
    {
        $this->data['DestinationChildInstanceTypes'] = $destinationChildInstanceTypes;
        foreach ($destinationChildInstanceTypes as $i => $iValue) {
            $this->options['query']['DestinationChildInstanceTypes.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withSourceRouteTableIds(array $sourceRouteTableIds)
    {
        $this->data['SourceRouteTableIds'] = $sourceRouteTableIds;
        foreach ($sourceRouteTableIds as $i => $iValue) {
            $this->options['query']['SourceRouteTableIds.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withSourceChildInstanceTypes(array $sourceChildInstanceTypes)
    {
        $this->data['SourceChildInstanceTypes'] = $sourceChildInstanceTypes;
        foreach ($sourceChildInstanceTypes as $i => $iValue) {
            $this->options['query']['SourceChildInstanceTypes.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withOperateCommunitySet(array $operateCommunitySet)
    {
        $this->data['OperateCommunitySet'] = $operateCommunitySet;
        foreach ($operateCommunitySet as $i => $iValue) {
            $this->options['query']['OperateCommunitySet.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withRouteTypes(array $routeTypes)
    {
        $this->data['RouteTypes'] = $routeTypes;
        foreach ($routeTypes as $i => $iValue) {
            $this->options['query']['RouteTypes.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withDestinationRouteTableIds(array $destinationRouteTableIds)
    {
        $this->data['DestinationRouteTableIds'] = $destinationRouteTableIds;
        foreach ($destinationRouteTableIds as $i => $iValue) {
            $this->options['query']['DestinationRouteTableIds.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withSourceZoneIds(array $sourceZoneIds)
    {
        $this->data['SourceZoneIds'] = $sourceZoneIds;
        foreach ($sourceZoneIds as $i => $iValue) {
            $this->options['query']['SourceZoneIds.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withDestinationInstanceIds(array $destinationInstanceIds)
    {
        $this->data['DestinationInstanceIds'] = $destinationInstanceIds;
        foreach ($destinationInstanceIds as $i => $iValue) {
            $this->options['query']['DestinationInstanceIds.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withPrependAsPath(array $prependAsPath)
    {
        $this->data['PrependAsPath'] = $prependAsPath;
        foreach ($prependAsPath as $i => $iValue) {
            $this->options['query']['PrependAsPath.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withMatchCommunitySet(array $matchCommunitySet)
    {
        $this->data['MatchCommunitySet'] = $matchCommunitySet;
        foreach ($matchCommunitySet as $i => $iValue) {
            $this->options['query']['MatchCommunitySet.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
