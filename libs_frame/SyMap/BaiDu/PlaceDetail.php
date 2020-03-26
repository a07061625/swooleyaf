<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/10 0010
 * Time: 11:09
 */
namespace SyMap\BaiDu;

use SyConstant\ErrorCode;
use SyException\Map\BaiduMapException;
use SyMap\MapBaseBaiDu;
use SyTool\Tool;

class PlaceDetail extends MapBaseBaiDu
{
    const SCOPE_BASE = 1; //结果详细程度-基本信息
    const SCOPE_DETAIL = 2; //结果详细程度-POI详细信息

    /**
     * poi的uid数组
     * @var array
     */
    private $uids = [];
    /**
     * 结果详细程度
     * @var int
     */
    private $scope = 0;

    public function __construct()
    {
        parent::__construct();
        $this->serviceUri = '/place/v2/detail';
        $this->rspDataKey = 'result';
        $this->reqData['scope'] = self::SCOPE_BASE;
        $this->reqData['timestamp'] = Tool::getNowTime();
    }

    public function __clone()
    {
    }

    /**
     * 添加uid
     * @param string $uid
     * @throws \SyException\Map\BaiduMapException
     */
    public function addUid(string $uid)
    {
        if (count($this->uids) >= 10) {
            throw new BaiduMapException('uid数量超过限制', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        }
        if (ctype_alnum($uid) && (strlen($uid) == 24)) {
            $this->uids[$uid] = 1;
        } else {
            throw new BaiduMapException('uid不合法', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        }
    }

    /**
     * @param int $scope
     * @throws \SyException\Map\BaiduMapException
     */
    public function setScope(int $scope)
    {
        if (in_array($scope, [self::SCOPE_BASE, self::SCOPE_DETAIL], true)) {
            $this->reqData['scope'] = $scope;
        } else {
            throw new BaiduMapException('结果详细程度不合法', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (empty($this->uids)) {
            throw new BaiduMapException('uid不能为空', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        }
        $this->reqData['uids'] = implode(',', array_keys($this->uids));

        return $this->getContent();
    }
}
