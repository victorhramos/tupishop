<?php

$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader
    ->registerDirs([
            $config->application->controllersDir,
            $config->application->modelsDir,
            $config->application->libraryDir
    ])
    ->registerNamespaces([
            "TupiShop\\Library" => $config->application->libraryDir,
            "TupiShop\\Controller\\Catalog" => $config->application->controllersDir . '/catalog/',
            "TupiShop\\Controller\\Backoffice" => $config->application->controllersDir . '/backoffice/',
            "TupiShop\\Model\\Catalog" => $config->application->modelsDir . '/catalog/',
            "TupiShop\\Model\\Backoffice" => $config->application->modelsDir . '/backoffice/',
            "TupiShop\\Component" => $config->application->componentsDir,
    ])
    ->register();

require_once BASE_PATH . '/vendor/autoload.php';
