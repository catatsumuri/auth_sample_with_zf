<?php

class IndexController extends Zend_Controller_Action
{
    private $_userinfo;

    public function init()
    {
        parent::init();
        $auth    	= Zend_Auth::getInstance();
        $storage 	= $auth->getStorage();
        $this->_userinfo = $storage->read();

        if ($this->userinfo) {
            $this->_helper->redirector('index', 'dashboard');
        } else {
            $this->_helper->redirector('login', 'auth');
        }
    }

    public function indexAction()
    {
        // action body
    }


}

// vim:set ts=4 sts=4 sw=4 expandtab:
