<?php
/**
 * 批量操作
 * User: 姜伟
 * Date: 2019/11/22 0022
 * Time: 12:37
 */
namespace SyObjectStorage\Kodo\Object;

use SyCloud\QiNiu\Util;
use SyConstant\ErrorCode;
use SyException\ObjectStorage\KodoException;
use SyObjectStorage\BaseKodo;

class FileBatch extends BaseKodo
{
    /**
     * 操作列表
     *
     * @var array
     */
    private $opList = [];

    public function __construct(string $accessKey)
    {
        parent::__construct($accessKey);
        $this->setServiceHost('rs.qiniu.com');
        $this->serviceUri = '/batch';
        $this->reqHeader['Content-Type'] = 'application/x-www-form-urlencoded';
    }

    private function __clone()
    {
    }

    /**
     * @param array $optionList
     *
     * @throws \SyException\ObjectStorage\KodoException
     */
    public function setOptionList(array $optionList)
    {
        if (empty($optionList)) {
            throw new KodoException('操作列表不能为空', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
        }

        $this->opList = [];
        foreach ($optionList as $eOption) {
            if (is_string($eOption) && ($eOption[0] == '/')) {
                $this->opList[] = $eOption;
            }
        }
        array_unique($this->opList);
    }

    public function getDetail() : array
    {
        if (empty($this->opList)) {
            throw new KodoException('操作列表不能为空', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
        }

        $bodyStr = '';
        foreach ($this->opList as $eOption) {
            $bodyStr .= '&op=' . urlencode($eOption);
        }
        $body = substr($bodyStr, 1);
        $this->reqHeader['Authorization'] = 'QBox ' . Util::createAccessToken($this->accessKey, $this->serviceUri, $body);
        $this->curlConfigs[CURLOPT_POST] = true;
        $this->curlConfigs[CURLOPT_POSTFIELDS] = $body;

        return $this->getContent();
    }
}
