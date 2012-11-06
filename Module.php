<?php
namespace BaconTypedArray;

use Zend\Module\Consumer\AutoloaderProvider;

/**
 * Module providing typed arrays.
 */
class Module implements AutoloaderProvider
{
    /**
     * Get autoloader config.
     *
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}
