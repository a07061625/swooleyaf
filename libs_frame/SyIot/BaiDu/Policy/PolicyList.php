<?php
/**
 * 获取policy列表
 * User: 姜伟
 * Date: 2019/7/17 0017
 * Time: 17:14
 */
namespace SyIot\BaiDu\Policy;

use SyConstant\ErrorCode;
use SyException\Iot\BaiDuIotException;
use SyIot\BaseBaiDu;
use SyIot\UtilBaiDu;

class PolicyList extends BaseBaiDu
{
    /**
     * endpoint名称
     *
     * @var string
     */
    private $endpointName = '';
    /**
     * principal名称
     *
     * @var string
     */
    private $principalName = '';
    /**
     * 排序方式
     *
     * @var string
     */
    private $order = '';
    /**
     * 排序字段
     *
     * @var string
     */
    private $orderBy = '';
    /**
     * 页码
     *
     * @var int
     */
    private $pageNo = 1;
    /**
     * 每页个数
     *
     * @var int
     */
    private $pageSize = 0;
    /**
     * 模糊查询内容
     *
     * @var string
     */
    private $q = '';

    public function __construct()
    {
        parent::__construct();
        $this->reqData['order'] = 'desc';
        $this->reqData['orderBy'] = 'createTime';
        $this->reqData['pageNo'] = 1;
        $this->reqData['pageSize'] = 50;
    }

    private function __clone()
    {
    }

    /**
     * @param string $endpointName
     *
     * @throws \SyException\Iot\BaiDuIotException
     */
    public function setEndpointName(string $endpointName)
    {
        if (ctype_alnum($endpointName)) {
            $this->endpointName = $endpointName;
            $this->serviceUri = '/v1/endpoint/' . $endpointName . '/policy';
        } else {
            throw new BaiDuIotException('endpoint名称不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    /**
     * @param string $principalName
     *
     * @throws \SyException\Iot\BaiDuIotException
     */
    public function setPrincipalName(string $principalName)
    {
        if (ctype_alnum($principalName)) {
            $this->reqData['principalName'] = $principalName;
        } else {
            throw new BaiDuIotException('principal名称不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    /**
     * @param string $order
     *
     * @throws \SyException\Iot\BaiDuIotException
     */
    public function setOrder(string $order)
    {
        if (in_array($order, ['asc', 'desc'])) {
            $this->reqData['order'] = $order;
        } else {
            throw new BaiDuIotException('排序方式不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    /**
     * @param string $orderBy
     *
     * @throws \SyException\Iot\BaiDuIotException
     */
    public function setOrderBy(string $orderBy)
    {
        if (in_array($orderBy, ['createTime', 'name'])) {
            $this->reqData['orderBy'] = $orderBy;
        } else {
            throw new BaiDuIotException('排序字段不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    /**
     * @param int $pageNo
     *
     * @throws \SyException\Iot\BaiDuIotException
     */
    public function setPageNo(int $pageNo)
    {
        if ($pageNo > 0) {
            $this->reqData['pageNo'] = $pageNo;
        } else {
            throw new BaiDuIotException('页码不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    /**
     * @param int $pageSize
     *
     * @throws \SyException\Iot\BaiDuIotException
     */
    public function setPageSize(int $pageSize)
    {
        if (($pageSize > 0) && ($pageSize <= 200)) {
            $this->reqData['pageSize'] = $pageSize;
        } else {
            throw new BaiDuIotException('每页个数不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    /**
     * @param string $query
     *
     * @throws \SyException\Iot\BaiDuIotException
     */
    public function setQuery(string $query)
    {
        if (strlen($query) > 0) {
            $this->reqData['q'] = $query;
        } else {
            throw new BaiDuIotException('模糊查询内容不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (strlen($this->endpointName) == 0) {
            throw new BaiDuIotException('endpoint名称不能为空', ErrorCode::IOT_PARAM_ERROR);
        }

        $this->reqHeader['Authorization'] = UtilBaiDu::createSign([
            'req_method' => self::REQ_METHOD_GET,
            'req_uri' => $this->serviceUri,
            'req_params' => $this->reqData,
            'req_headers' => [
                'host',
            ],
        ]);
        $this->curlConfigs[CURLOPT_URL] = $this->serviceProtocol . '://' . $this->serviceDomain . $this->serviceUri . '?' . http_build_query($this->reqData);

        return $this->getContent();
    }
}
