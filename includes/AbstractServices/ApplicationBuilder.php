<?php

namespace W3aliens\PostTypeAndTaxonomyMigrator\AbstractServices;

use W3aliens\PostTypeAndTaxonomyMigrator\Interfaces\AppicationBuilderInterface;

abstract class ApplicationBuilder implements AppicationBuilderInterface {

    public $services = [];

    public function setServicesWithoutHook( $serviceClassNamespace ) {
        if ( ! is_string( $serviceClassNamespace ) ) {
            return;
        }
        array_push( $services, $serviceClassNamespace );
        return $this;
    }

    public function setServicesOnHook( $hook, $serviceClassNamespace, $method = '', $properties = [], $priority = 10, $filterType = 'action' ) {
        if ( ! isset( $this->services[$filterType] ) ) {
            $this->services[$filterType] = [];
        }

        $this->services[$filterType][] = [
            'hook'       => $hook,
            'namespace'  => $serviceClassNamespace,
            'method'     => $method,
            'properties' => $properties,
            'priority'   => $priority
        ];

        return $this;
    }

    public function build() {
        foreach ( $this->services as $hookType => $payload ) {
            $actionType = $hookType == 'action' ? 'add_action' : 'add_filter';

            foreach ( $payload as $params ) {
                $actionType( $params['hook'], [$params['namespace'], $params['method']], $params['priority'], ...$params['properties'] );
            }

            if ( $actionType != 'action' && $actionType != 'filter' ) {
                new $payload();
            }
        }
    }
}