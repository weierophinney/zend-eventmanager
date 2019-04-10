<?php
/**
 * @see       https://github.com/zendframework/zend-eventmanager for the canonical source repository
 * @copyright Copyright (c) 2019 Zend Technologies USA Inc. (https://www.zend.com)
 * @license   https://github.com/zendframework/zend-eventmanager/blob/master/LICENSE.md New BSD License
 */

namespace ZendTest\EventManager\ListenerProvider;

use Closure;
use Zend\EventManager\ListenerProvider\AbstractListenerSubscriber;
use Zend\EventManager\ListenerProvider\PrioritizedListenerAttachmentInterface;

class AbstractListenerSubscriberTest extends ListenerSubscriberTraitTest
{
    /**
     * {@inheritDoc}
     */
    public function createProvider(callable $attachmentCallback)
    {
        return new class($attachmentCallback) extends AbstractListenerSubscriber {
            /** @var callable */
            private $attachmentCallback;

            public function __construct(callable $attachmentCallback)
            {
                $this->attachmentCallback = $attachmentCallback;
            }

            public function attach(PrioritizedListenerAttachmentInterface $provider, $priority = 1)
            {
                $attachmentCallback = $this->attachmentCallback->bindTo($this, $this);
                $attachmentCallback($provider, $priority);
            }
        };
    }
}
