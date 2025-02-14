<?php

use W3aliens\PostTypeAndTaxonomyMigrator\Traits;

/**
 * Singleton Class For Single Life Cycle
 */
trait Singleton {

    protected static $instances = [];

    /**
     * Create a single object instance for any class that extends(Single Life Cycle).
     *
     * @since 3.0.0
     * @param mixed ...$args
     *
     * @return static
     *
     * @suppress PHP0441
     */
    public static function get_instance( ...$args ) {
        $class = get_called_class();

        if ( ! isset( static::$instances[$class] ) || static::$instances[$class] == null ) {
            static::$instances[$class] = new static( ...$args );
        }

        return static::$instances[$class];
    }

    public function __clone() {
        throw new Exception( "Cannot Clone A Singleton Class" );
    }

    public function __wakeup() {
        throw new Exception( "Cannot Unserialize A Singleton Class" );
    }
}