<?php
/**
 * 初始化终端节点
 * User: 姜伟
 * Date: 2019/1/2 0002
 * Time: 14:19
 */
$endpointData = file_get_contents(__DIR__ . '/endpoints.json');
$totalPoints = SyTool\Tool::jsonDecode($endpointData);
$endpoints = [];
foreach ($totalPoints as $eEndpoint) {
    $productDomains = [];
    foreach ($eEndpoint['Products'] as $eProduct) {
        $productDomains[$eProduct['ProductName']] = new \AliOpen\Core\Regions\ProductDomain($eProduct['ProductName'], $eProduct['DomainName']);
    }

    $endpoints[$eEndpoint['RegionId']] = new \AliOpen\Core\Regions\Endpoint($eEndpoint['RegionId'], [
        0 => $eEndpoint['RegionId'],
    ], $productDomains);
}
\AliOpen\Core\Regions\EndpointProvider::setEndpoints($endpoints);
