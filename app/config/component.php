<?php

/**
 * Default Components
 */

/**
 * Store Configurations
 */
$di->setShared('storeConfig', function () {
    $configs = \TupiShop\Model\Catalog\Config::find();
    $storeConfig = new stdClass();

    foreach ($configs as $config) {
        $storeConfig->{$config->key} = $config->value;
    }

    return $storeConfig;
});

/**
 * Customer Component
 */
$di->setShared('customer', function() use ($di){
    $session = $di->getSession();

    if ($session->has('customer')) {
        $customer = \TupiShop\Model\Catalog\Customer::findFirst($session->get('customer'));
    } else {
        $customer = false;
    }

    return $customer;
});

$di->setShared('cart', function() use ($di){
    $session = $di->getSession();
    $customer = \TupiShop\Model\Catalog\Customer::findFirst($session->get('customer'));

    $cart = \TupiShop\Model\Catalog\Cart::findFirstBySessionId($session->getId());

    if ($cart && $customer && $cart->customerId != $customer->customerId) {
        $cart->customerId = $customer->customerId;
    } elseif ($cart && !$customer) {
        $cart->customerId = null;
    } elseif (!$cart && $customer) {
        $cart = new \TupiShop\Model\Catalog\Cart();
        $cart->customerId = $customer->customerId;
        $cart->sessionId = $this->session->getId();
        $cart->createdAt = date('Y-m-d H:i:s');
        $cart->updatedAt = date('Y-m-d H:i:s');
    } elseif (!$cart && !$customer) {
        $cart = new \TupiShop\Model\Catalog\Cart();
        $cart->customerId = null;
        $cart->sessionId = $this->session->getId();
        $cart->createdAt = date('Y-m-d H:i:s');
        $cart->updatedAt = date('Y-m-d H:i:s');
    }

    $cart->save();

    return $cart;
});

/*
 * Initialize dynamic components
 */
$di->setShared('component', function () use ($di, $config) {
    $files = new \RecursiveIteratorIterator(
        new \RecursiveDirectoryIterator(realpath($config->application->componentsDir)),
            \RecursiveIteratorIterator::LEAVES_ONLY
        );

    $components = [];
    foreach ($files as $file) {
        if (is_file($file) && substr($file, -3, 3) == 'php') {
            $class = '\\TupiShop\\Component\\' . str_replace('.php', '', basename($file));
            $name = strtolower(str_replace(['Component', '.php'], '', basename($file)));

            $components[$name] = new $class();
        }
    }

    $obj = new stdClass();

    foreach ($components as $key => $obje) {
        $obj->{$key} = $obje;
    }

    return $obj;
});
