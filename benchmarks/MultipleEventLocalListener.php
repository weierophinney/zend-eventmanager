<?php

namespace ZendBench\EventManager;

use Zend\EventManager\EventManager;
use Athletic\AthleticEvent;

class MultipleEventLocalListener extends AthleticEvent
{
    use TraitEventBench;

    public function setUp()
    {
        $this->events = new EventManager();
    }

    /**
     * Attach and trigger the event list
     *
     * @iterations 5000
     */
    public function trigger()
    {
        foreach ($this->getEventList() as $event) {
            $this->events->attach($event, $this->generateCallback());
            $this->events->trigger($event);
        }
    }
}
