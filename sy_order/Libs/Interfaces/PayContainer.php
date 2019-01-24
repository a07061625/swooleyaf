<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/9/18 0018
 * Time: 14:49
 */
namespace Interfaces;

use Constant\Project;
use Interfaces\Impl\Pay\OrderGoods;
use Tool\BaseContainer;

class PayContainer extends BaseContainer {
    public function __construct() {
        $this->registryMap = [
            Project::ORDER_PAY_TYPE_GOODS,
        ];

        $this->bind(Project::ORDER_PAY_TYPE_GOODS, function () {
            return new OrderGoods();
        });
    }
}