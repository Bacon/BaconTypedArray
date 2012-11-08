<?php
/**
* BaconTypedArray
*
* @link      http://github.com/Bacon/BaconTypedArray For the canonical source repository
* @copyright 2012 Ben 'DASPRiD' Scholzen
* @license   http://opensource.org/licenses/BSD-2-Clause Simplified BSD License
*/

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
