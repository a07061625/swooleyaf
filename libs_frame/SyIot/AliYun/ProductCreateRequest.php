<?php
/*
 * Licensed to the Apache Software Foundation (ASF) under one
 * or more contributor license agreements.  See the NOTICE file
 * distributed with this work for additional information
 * regarding copyright ownership.  The ASF licenses this file
 * to you under the Apache License, Version 2.0 (the
 * "License"); you may not use this file except in compliance
 * with the License.  You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing,
 * software distributed under the License is distributed on an
 * "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
 * KIND, either express or implied.  See the License for the
 * specific language governing permissions and limitations
 * under the License.
 */
namespace SyIot\AliYun;

use AliOpen\Core\RpcAcsRequest;

class ProductCreateRequest extends RpcAcsRequest
{
    private $dataFormat;
    private $nodeType;
    private $id2;
    private $netType;
    private $productName;
    private $description;
    private $protocolType;
    private $aliyunCommodityCode;
    private $categoryId;

    public function __construct()
    {
        parent::__construct('Iot', '2018-01-20', 'CreateProduct');
        $this->setMethod('POST');
    }

    public function getDataFormat()
    {
        return $this->dataFormat;
    }

    public function setDataFormat($dataFormat)
    {
        $this->dataFormat = $dataFormat;
        $this->queryParameters['DataFormat'] = $dataFormat;
    }

    public function getNodeType()
    {
        return $this->nodeType;
    }

    public function setNodeType($nodeType)
    {
        $this->nodeType = $nodeType;
        $this->queryParameters['NodeType'] = $nodeType;
    }

    public function getId2()
    {
        return $this->id2;
    }

    public function setId2($id2)
    {
        $this->id2 = $id2;
        $this->queryParameters['Id2'] = $id2;
    }

    public function getNetType()
    {
        return $this->netType;
    }

    public function setNetType($netType)
    {
        $this->netType = $netType;
        $this->queryParameters['NetType'] = $netType;
    }

    public function getProductName()
    {
        return $this->productName;
    }

    public function setProductName($productName)
    {
        $this->productName = $productName;
        $this->queryParameters['ProductName'] = $productName;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        $this->queryParameters['Description'] = $description;
    }

    public function getProtocolType()
    {
        return $this->protocolType;
    }

    public function setProtocolType($protocolType)
    {
        $this->protocolType = $protocolType;
        $this->queryParameters['ProtocolType'] = $protocolType;
    }

    public function getAliyunCommodityCode()
    {
        return $this->aliyunCommodityCode;
    }

    public function setAliyunCommodityCode($aliyunCommodityCode)
    {
        $this->aliyunCommodityCode = $aliyunCommodityCode;
        $this->queryParameters['AliyunCommodityCode'] = $aliyunCommodityCode;
    }

    public function getCategoryId()
    {
        return $this->categoryId;
    }

    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;
        $this->queryParameters['CategoryId'] = $categoryId;
    }
}
