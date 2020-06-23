<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/6/23 0023
 * Time: 15:07
 */
namespace SyMessageHandler\Consumers\Wx;

use SyConstant\Project;
use SyMessageHandler\ConsumerBase;
use SyMessageHandler\ConsumerInterface;

/**
 * Class AccountMessageCustom
 * @package SyMessageHandler\Consumers\Wx
 */
class AccountMessageCustom extends ConsumerBase implements ConsumerInterface
{
    public function __construct()
    {
        parent::__construct(Project::MESSAGE_HANDLER_TYPE_WX_ACCOUNT_MESSAGE_CUSTOM);
    }
}
