<?php
class IndexController extends CommonController
{
    public function init()
    {
        parent::init();
    }

    public function checkAction()
    {
        $this->SyResult->setData([
            'msg' => '检测成功',
        ]);
        $this->sendRsp();
    }
}
