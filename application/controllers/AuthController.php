<?php

class AuthController extends Zend_Controller_Action
{
    private $_userModel;

    public function init()
    {
        $this->_userModel = new Application_Model_DbTable_User;
    }

    private function _login()
    {
        $username = $this->getRequest()->getPost('username');
        $password = $this->getRequest()->getPost('password');

        $notEmpty = new Zend_Validate_NotEmpty();
        if ($notEmpty->isValid($username) === false) {
            return "Login ID is empty";
        }
        if ($notEmpty->isValid($password) === false) {
            return "Password is empty";
        }

        $adapter = new Zend_Auth_Adapter_DbTable();
        $adapter->setTableName('user');
        $adapter->setIdentityColumn('account');
        $adapter->setCredentialColumn('password');
        $adapter->setIdentity($username);
        $adapter->setCredential(md5($password)); // or Using credentialTreatment

        $auth    = Zend_Auth::getInstance();
        $result  = $auth->authenticate($adapter);
        if ($result->isValid()) {
            $storage = $auth->getStorage();
            $row = $adapter->getResultRowObject(array('id', 'account'));
            $storage->write($row);
            $this->_helper->redirector("index", "dashboard", "default");
            // }}}
        }
        return "認証に失敗しました";
    }

    public function logoutAction()
    {
        $auth = Zend_Auth::getInstance();
        Zend_Session::destroy();
        $this->_helper->redirector('login', 'auth', 'default');
    }

    public function loginAction()
    {
        $error = null;
        if ($this->getRequest()->isPost()) {
            $error = $this->_login();
        }
        // Set path query into the view
        if (!$path = $this->getRequest()->getQuery('path')) {
            $path = $this->getRequest()->getPost('path');
        }

        $this->view->path  = $path;
        $this->view->error = $error;
    }

    public function indexAction()
    {
        // Simply redirect to login form
        $this->_helper->redirector("login", "auth", "default");
    }

}
// {{{ Modeline
// vim:set ts=4 sts=4 sw=4 expandtab:
// vim600: fdm=marker
// }}}
