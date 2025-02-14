<?php

namespace W3aliens\PostTypeAndTaxonomyMigrator\AbstractServices;

use W3aliens\PostTypeAndTaxonomyMigrator\Interfaces\DispatcherInterface;

/**
 * Dispatcher Class For Application
 */
abstract class GenericDispatcher implements DispatcherInterface {
    public $services;

    /**
     * Bind/Attach Service Class
     *
     * @param string $class
     * @param string $method
     * @param string $properties
     * @return void
     */
    public function bind( $class, $method, $properties = [] ) {
        $this->services[$class] = ['method' => $method, 'properties' => $properties];
    }

    /**
     * Un-bind/Un-attach Subscriber Service Class
     *
     * @param string $class
     * @return void
     */
    public function unbind( $class ) {
        unset( $this->services[$class] );
    }

    /**
     * Notify A Single Subscriber
     *
     * @param string $class
     * @param array $additionProperties
     *
     * @return void
     */
    public function notifySpecific( $class, $additionProperties = [] ) {
        call_user_func_array( [$this->services[$class], $this->services[$class]['method']], [ ...$this->services[$class]['properties']] );
    }

    /**
     * Notify All Subscribers
     *
     * @return void
     */
    public function notifyAll() {
        foreach ( $this->services as $service => $properties ) {
            call_user_func_array( [$service, $properties['method']], $properties['properties'] );
        }
    }
}