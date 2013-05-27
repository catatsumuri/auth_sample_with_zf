<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initDoctype()
    {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $config = new Zend_Config_Ini(APPLICATION_PATH .
                '/configs/application.ini', APPLICATION_ENV);
        Zend_Registry::set("config", $config);
        $view->doctype('HTML5');
        $view->headMeta()->setCharset('UTF-8');

        ZendX_JQuery::enableView($view);
        $view->jQuery()->setVersion('1.7.1')->enable();
    }
}

// vim:set ts=4 sts=4 sw=4 expandtab:
