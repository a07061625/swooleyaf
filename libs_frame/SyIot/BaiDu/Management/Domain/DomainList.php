<?php
/**
 * 获取权限组列表
 * User: 姜伟
 * Date: 2019/7/17 0017
 * Time: 17:14
 */
namespace SyIot\BaiDu\Management\Domain;

use SyConstant\ErrorCode;
use SyException\Iot\BaiDuIotException;
use SyIot\BaseBaiDu;
use SyIot\UtilBaiDu;

class DomainList extends BaseBaiDu
{
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
     * 排序字段
     *
     * @var string
     */
    private $orderBy = '';
    /**
     * 排序方式
     *
     * @var string
     */
    private $order = '';
    /**
     * 查询关键字
     *
     * @var string
     */
    private $key = '';
    /**
     * 权限组类型
     *
     * @var string
     */
    private $type = '';
    /**
     * 设备名称
     *
     * @var string
     */
    private $deviceName = '';

    public function __construct()
    {
        parent::__construct();
        $this->serviceUri = '/v3/iot/management/domain';
        $this->reqData['pageNo'] = 1;
        $this->reqData['pageSize'] = 10;
        $this->reqData['orderBy'] = 'createTime';
        $this->reqData['order'] = 'desc';
        $this->reqData['type'] = 'ALL';
    }

    private function __clone()
    {
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
     * @param string $orderBy
     *
     * @throws \SyException\Iot\BaiDuIotException
     */
    public function setOrderBy(string $orderBy)
    {
        if (in_array($orderBy, ['name', 'createTime', 'lastUpdatedTime'])) {
            $this->reqData['orderBy'] = $orderBy;
        } else {
            throw new BaiDuIotException('排序字段不合法', ErrorCode::IOT_PARAM_ERROR);
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
     * @param string $key
     *
     * @throws \SyException\Iot\BaiDuIotException
     */
    public function setKey(string $key)
    {
        if (strlen($key) > 0) {
            $this->reqData['key'] = $key;
        } else {
            throw new BaiDuIotException('查询关键字不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    /**
     * @param string $type
     *
     * @throws \SyException\Iot\BaiDuIotException
     */
    public function setType(string $type)
    {
        if (in_array($type, ['ROOT', 'NORMAL', 'ALL'])) {
            $this->reqData['type'] = $type;
        } else {
            throw new BaiDuIotException('权限组类型不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    /**
     * @param string $deviceName
     *
     * @throws \SyException\Iot\BaiDuIotException
     */
    public function setDeviceName(string $deviceName)
    {
        if (ctype_alnum($deviceName)) {
            $this->reqData['deviceName'] = $deviceName;
        } else {
            throw new BaiDuIotException('设备名称不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
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
