<?php

namespace Core\Events;


/**
 * Class Emitter
 *
 * @package Core\Events
 */
class Emitter
{

    /**
     * @var
     */
    private static $_instance;
    /**
     * @var array
     */
    private $listeners = [];

    /**
     * @return Emitter
     */
    public static function getInstance (): Emitter
    {
        if (self::$_instance === null) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Envoie un evenement
     *
     * @param string $event
     * @param array  ...$args
     */
    public function emit (string $event, ...$args)
    {
        if ($this->hasListerner($event)) {
            foreach ($this->listeners[$event] as $listener) {
                call_user_func_array($listener, $args);
            }
        }
    }

    /**
     * Permet d'ecouter un evenement
     *
     * @param string   $event
     * @param callable $callable
     */
    public function on (string $event, callable $callable)
    {
        if (!$this->hasListerner($event)) {
            $this->listeners[$event] = [];
        }
        $this->listeners[$event][] = $callable;
    }

    /**
     * @param string $event
     * @return bool
     */
    private function hasListerner (string $event): bool
    {
        return array_key_exists($event, $this->listeners);
    }

}