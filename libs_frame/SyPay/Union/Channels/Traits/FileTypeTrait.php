<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/20 0020
 * Time: 10:06
 */
namespace SyPay\Union\Channels\Traits;

use SyConstant\ErrorCode;
use SyException\Pay\UnionException;

/**
 * Class FileTypeTrait
 *
 * @package SyPay\Union\Channels\Traits
 */
trait FileTypeTrait
{
    /**
     * @param string $fileType
     *
     * @throws \SyException\Pay\UnionException
     */
    public function setFileType(string $fileType)
    {
        if (ctype_digit($fileType) && (strlen($fileType) == 2)) {
            $this->reqData['fileType'] = $fileType;
        } else {
            throw new UnionException('文件类型不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }
}
