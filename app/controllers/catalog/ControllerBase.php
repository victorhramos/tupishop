<?php
namespace Shop\Controller\Catalog;

use Phalcon\Mvc\Controller;
use Shop\Model\Catalog\Customer;

class ControllerBase extends Controller
{
    public $customer;

    public function beforeExecuteRoute()
    {
        $this->setCustomer();
    }

    public function setCustomer()
    {
        if ($this->session->has('customer')) {
            $customer = Customer::findFirst($this->session->get('customer'));
        } else {
            $customer = false;
        }

        $this->customer = $customer;
    }
}
