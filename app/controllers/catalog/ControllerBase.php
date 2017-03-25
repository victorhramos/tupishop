<?php
namespace TupiShop\Controller\Catalog;

class ControllerBase extends \Phalcon\Mvc\Controller
{
    public function beforeExecuteRoute()
    {
        $template =  $this->dispatcher->getParam('template');
        $this->view->setMainView('catalog/template/' . $this->storeConfig->theme . '/' . $template);
    }

    public function afterExecuteRoute()
    {
    }
}
