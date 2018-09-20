# PSR-14 TODO

This branch is tracking PSR-14, to identify ways in which we can implement the
standard. When doing so, there are two approaches:

- Minimal, to allow backwards compatibility. This involves: having our
  - Having the `EventInterface` extend one or more relevent event interfaces.
  - Updating the `Event` implementation to implement `StoppableTaskInterface`.
  - Updating the `EventManager` to implement `TaskProcessorInterface` and
    `ListenerProviderInterface`.
- Full implementation. This would involve making the `SharedEventManager` a
  `ListenerProviderInterface` implementation, and modifying the `EventManager`
  to no longer allow attaching events directly, but instead **require** a
  `ListenerProviderInterface` to its constructor.

The former approach can be done immediately, allowing zend-eventmanager to be
used as a drop-in `TaskProcessorInterface` implementation.

The latter would be done for a new major version, and would require consumers to
modify how they interact with the shared event manager and the event manager.
Likely, we would need to do a partial `ListenerProviderInterface` implementation
anyways, to allow for forward compatibility.

As an example, all listener registration in the `EventManager` could instead
proxy to the composed `SharedEventManager` instance; if none is provided during
instantiation, the event manager would create one for internal use.
