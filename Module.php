<?php
/**
* BaconTypedArray
*
* @link      http://github.com/Bacon/BaconTypedArray For the canonical source repository
* @copyright 2012 Ben 'DASPRiD' Scholzen
* @license   http://opensource.org/licenses/BSD-2-Clause Simplified BSD License
*/

namespace BaconTypedArray;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;

/**
 * Module providing typed arrays.
 */
class Module implements AutoloaderProviderInterface
{
    /**
     * getAutoloaderConfig(): defined by AutoloaderProviderInterface.
     *
     * @see    AutoloaderProviderInterface::getAutoloaderConfig()
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
