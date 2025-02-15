<?php

namespace W3aliens\PostTypeAndTaxonomyMigrator\AbstractServices;

use W3aliens\PostTypeAndTaxonomyMigrator\Interfaces\AppicationBuilderInterface;

abstract class ApplicationBuilder implements AppicationBuilderInterface {

    public $services = [];

    public function setServices( $hook, $serviceClassNamespace, $method = '', $properties = [], $priority = 10, $filterType = 'action' ) {
        if ( $filterType == 'action' ) {
            array_push( $this->services[$filterType], ['hook' => $hook, 'namespace' => $serviceClassNamespace, 'method' => $method, 'properties' => $properties, 'priority' => $priority] );
        }

        if ( $filterType == 'filter' ) {
            array_push( $this->services[$filterType], ['hook' => $hook, 'namespace' => $serviceClassNamespace, 'method' => $method, 'properties' => $properties, 'priority' => $priority] );
        }
        
        return $this;
    }

    public function build() {
        foreach ( $this->services as $hookType => $payload ) {
            if ( $hookType == 'action' ) {
                foreach ( $payload as $params ) {
                    add_action( $params['hook'], [$params['namespace'], $params['method']], $params['priority'], ...$params['properties'] );
                }
            } else {
                foreach ( $payload as $params ) {
                    add_action( $params['hook'], [$params['namespace'], $params['method']], $params['priority'], ...$params['properties'] );
                }
            }
        }
    }
}