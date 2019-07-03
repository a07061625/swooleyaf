<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/7/3 0003
 * Time: 9:09
 */
class IndexController extends CommonController
{
    public function init()
    {
        parent::init();
    }

    /**
     * @SyFilter-{"field": "url","explain": "链接","type": "string","rules": {"required": 1,"url": 1}}
     */
    public function checkAction()
    {
        $this->SyResult->setData([
            'msg' => '检测成功',
        ]);
        $this->sendRsp();
    }
}
