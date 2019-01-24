<?php
namespace AliOpen\Core\Regions;

class ProductDomain {
    /**
     * @var string
     */
    private $productName;
    /**
     * @var string
     */
    private $domainName;

    /**
     * AliOpen\Core\Regions\ProductDomain constructor.
     * @param string $product
     * @param string $domain
     */
    public function __construct($product, $domain){
        $this->productName = $product;
        $this->domainName = $domain;
    }

    /**
     * @return string
     */
    public function getProductName(){
        return $this->productName;
    }

    /**
     * @param $productName
     */
    public function setProductName($productName){
        $this->productName = $productName;
    }

    /**
     * @return string
     */
    public function getDomainName(){
        return $this->domainName;
    }

    /**
     * @param $domainName
     */
    public function setDomainName($domainName){
        $this->domainName = $domainName;
    }
}
