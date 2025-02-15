<?php

namespace W3aliens\PostTypeAndTaxonomyMigrator\Interfaces;

interface AppicationBuilderInterface {

    /**
     * Service Classes Without Hook
     *
     * @param string $serviceClassNamespace
     * 
     * @return object
     */
    public function setServicesWithoutHook( $serviceClassNamespace );

    /**
     * Attach Services With Hooks Included
     *
     * @param string $hook
     * @param string $serviceClassNamespace
     * @param string $method
     * @param array $properties
     * @param integer $priority
     * @param string $filterType
     * 
     * @return object
     */
    public function setServicesOnHook( $hook, $serviceClassNamespace, $method, $properties = [], $priority = 10, $filterType = 'action' );

    /**
     * Build The Application When All Methods Are Set
     *
     * @return void
     */
    public function build();
}