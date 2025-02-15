<?php

namespace W3aliens\PostTypeAndTaxonomyMigrator\Interfaces;

interface AppicationBuilderInterface {
    public function setServices( $hook, $serviceClassNamespace, $method, $properties = [], $priority = 10, $filterType = 'action' );
    public function build();
}