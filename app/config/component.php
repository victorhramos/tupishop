<?php

/*
 * Initialize components
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
