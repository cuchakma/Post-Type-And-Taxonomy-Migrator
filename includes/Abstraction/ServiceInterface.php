<?php

namespace W3aliens\PostTypeAndTaxonomyMigrator\Abstraction;

/**
 * Interface For Running Services
 */
interface ServiceInterface {
    public function defineHooks();
    public function run();
}