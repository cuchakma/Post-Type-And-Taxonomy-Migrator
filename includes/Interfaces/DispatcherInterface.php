<?php

namespace W3aliens\PostTypeAndTaxonomyMigrator\Interfaces;

/**
 * Application Dispatcher Interface
 */
interface DispatcherInterface {
    public function bind( $class, $method, $properties = [] );
    public function unbind( $class );
    public function notifySpecific( $class, $additionProperties = [] );
    public function notifyAll();
}