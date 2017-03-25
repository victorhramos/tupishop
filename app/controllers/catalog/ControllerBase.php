<?php
namespace TupiShop\Controller\Catalog;

use Phalcon\Mvc\Controller;
use TupiShop\Model\Catalog\Customer;

class ControllerBase extends Controller
{
    public $customer;

    public function beforeExecuteRoute()
    {
        $this->setCustomer();
        $this->setCart();
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

    public function setCart()
    {
        $cart = \TupiShop\Model\Catalog\Cart::findFirstBySessionId($this->session->getId());

        if ($cart && $this->customer && $cart->customerId != $this->customer->customerId) {
            $cart->customerId = $this->customer->customerId;
        } elseif ($cart && !$this->customer) {
            $cart->customerId = null;
        } elseif (!$cart && $this->customer) {
            $cart = new \TupiShop\Model\Catalog\Cart();
            $cart->customerId = $this->customer->customerId;
            $cart->sessionId = $this->session->getId();
            $cart->createdAt = date('Y-m-d H:i:s');
            $cart->updatedAt = date('Y-m-d H:i:s');
        } elseif (!$cart && !$this->customer) {
            $cart = new \TupiShop\Model\Catalog\Cart();
            $cart->customerId = null;
            $cart->sessionId = $this->session->getId();
            $cart->createdAt = date('Y-m-d H:i:s');
            $cart->updatedAt = date('Y-m-d H:i:s');
        }

        $cart->save();

        $this->cart = $cart;
    }
}
