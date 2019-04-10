<?php
/**
 * @see       https://github.com/zendframework/zend-eventmanager for the canonical source repository
 * @copyright Copyright (c) 2019 Zend Technologies USA Inc. (https://www.zend.com)
 * @license   https://github.com/zendframework/zend-eventmanager/blob/master/LICENSE.md New BSD License
 */

namespace Zend\EventManager;

/**
 * Forwards-compatibility shim for the PSR-14 StoppableEventInterface
 *
 * This interface can be mixed into the `Event` instance to make it
 * forwards-compatible with PSR-14.
 */
interface StoppableEventInterface
{
    /**
     * @return bool
     */
    public function isPropagationStopped();
}
