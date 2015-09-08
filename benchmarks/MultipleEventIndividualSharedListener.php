<?php

namespace ZendBench\EventManager;

use Zend\EventManager\SharedEventManager;
use Zend\EventManager\EventManager;
use Athletic\AthleticEvent;

class MultipleEventIndividualSharedListener extends AthleticEvent
{
    use TraitEventBench;

    private $sharedEvents;

    private $events;

    public function setUp()
    {
        $identifiers = $this->getIdentifierList();
        $this->sharedEvents = new SharedEventManager();
        foreach ($this->getEventList() as $event) {
            $this->sharedEvents->attach($identifiers[0], $event, $this->generateCallback());
        }
        $this->events = new EventManager();
        $this->events->setSharedManager($this->sharedEvents);
        $this->events->setIdentifiers($identifiers[0]);
    }

    /**
     * Trigger the event list
     *
     * @iterations 5000
     */
    public function trigger()
    {
        foreach ($this->getEventList() as $event) {
            $this->events->trigger($event);
        }
    }
}
