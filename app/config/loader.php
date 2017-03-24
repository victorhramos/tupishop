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
            "Shop\\Library" => $config->application->libraryDir,
            "Shop\\Controller\\Catalog" => $config->application->controllersDir . '/catalog/',
            "Shop\\Controller\\Backoffice" => $config->application->controllersDir . '/backoffice/',
            "Shop\\Model\\Catalog" => $config->application->modelsDir . '/catalog/',
            "Shop\\Model\\Backoffice" => $config->application->modelsDir . '/backoffice/',
            "Shop\\Component" => $config->application->componentsDir,
    ])
    ->register();

require_once BASE_PATH . '/vendor/autoload.php';
