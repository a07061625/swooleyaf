<?php
namespace AliOpen\Core\Regions;

class Endpoint {
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $regionIds;
    /**
     * @var string
     */
    private $productDomains;

    /**
     * AliOpen\Core\Regions\Endpoint constructor.
     * @param $name
     * @param $regionIds
     * @param $productDomains
     */
    public function __construct($name, $regionIds, $productDomains){
        $this->name = $name;
        $this->regionIds = $regionIds;
        $this->productDomains = $productDomains;
    }

    /**
     * @return string
     */
    public function getName(){
        return $this->name;
    }

    /**
     * @param $name
     */
    public function setName($name){
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getRegionIds(){
        return $this->regionIds;
    }

    /**
     * @param $regionIds
     */
    public function setRegionIds($regionIds){
        $this->regionIds = $regionIds;
    }

    /**
     * @return string
     */
    public function getProductDomains(){
        return $this->productDomains;
    }

    /**
     * @param $productDomains
     */
    public function setProductDomains($productDomains){
        $this->productDomains = $productDomains;
    }
}
