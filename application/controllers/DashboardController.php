<?php

class DashboardController extends Zend_Controller_Action
{

    private $_userinfo;

    public function init()
    {
        parent::init();
        $auth    	= Zend_Auth::getInstance();
        $storage 	= $auth->getStorage();
        $this->_userinfo = $storage->read();
        $this->view->userinfo = $this->_userinfo;
    }

    public function indexAction()
    {
        // action body
    }


}

// {{{ Modeline
// vim:set ts=4 sts=4 sw=4 expandtab:
// vim600: fdm=marker
// }}}
