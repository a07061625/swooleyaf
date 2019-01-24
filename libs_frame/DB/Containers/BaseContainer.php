<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/3/5 0005
 * Time: 12:04
 */
namespace DB\Containers;

use SplObserver;

abstract class BaseContainer implements \SplSubject {
    protected $_model = null;

    private $_observers = null;
    private $_subjectObj = null;

    public function __construct(){
        $this->_observers = new \SplObjectStorage();
    }

    /**
     * 设置观察者模式中被观察者的标识对象
     * @param object|array $subjectObj
     */
    public function setSubjectObj($subjectObj) {
        $this->_subjectObj = $subjectObj;
    }

    public function attach(SplObserver $observer) {
        $this->_observers->attach($observer);
    }

    public function detach(SplObserver $observer) {
        $this->_observers->detach($observer);
    }

    public function detachAll(){
        $this->_observers->removeAll($this->_observers);
    }

    /**
     * 判断是否存在对应的观察者对象
     * @param \SplObserver $observer 观察者对象
     * @return bool
     */
    public function existObserver(SplObserver $observer) : bool {
        return $this->_observers->contains($observer);
    }

    public function notify() {
        $this->_observers->rewind();

        if(is_null($this->_subjectObj)){
            while ($this->_observers->valid()) {
                $this->_observers->current()->update($this);
                $this->_observers->next();
            }
        } else {
            while ($this->_observers->valid()) {
                $this->_observers->current()->update($this, $this->_subjectObj);
                $this->_observers->next();
            }
        }
    }

    abstract public function getModel();
}