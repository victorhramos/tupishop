<?php
namespace Shop\Controller\Catalog;

class IndexController extends ControllerBase
{
    public function indexAction()
    {
        s($this->customer->Addresses->toArray());
        die();
    }
}
