<?php
/**
 * This file contains a class for defining a spark.
 */

/**
 * This class defines a spark. That is, it contains information about
 *  a spark's name, the version, and dependency information
 */
class Spark_specification {

    /**
     * The registered name of a spark. This is purely informational.
     * @var string
     */
    public $name = '';

    /**
     * The version information for this spark
     * @var string Must be in the format x.x.x
     */
    public $version = '';

    /**
     * An array of dependencies, which are also
     * @var array[array] array (
     *  array('name1', 'x.x.x'),
     *  array('name2', 'x.x.x'),
     * )
     */
    public $dependencies = array();

    /**
     * Validate this spark. Throws an exception if things look broken
     * @throws SpecificationException
     */
    public function validate()
    {
        $this->_validateName($this->name);
        $this->_validateVersion($this->version);
        $this->_validateDependencies($this->dependencies);
    }

    /**
     * Validate a version string
     * @throws SpecificationException
     * @param string $version
     */
    private function _validateVersion($version)
    {
        /* Validate the version */
        $versions = explode('.', $version);

        if(count($versions) != 3)
        {
            throw new SpecificationException("The spark version must be in the format of x.x.x: {$version}");
        }

        foreach($versions as $v)
        {
            if(!is_int($v) || $v < 1)
            {
                throw new SpecificationException("Each component of the versions string must be a positive integer: {$version}");
            }
        }
    }

    /**
     * Validate a Spark name
     * @throws SpecificationException
     * @param string $name
     */
    private function _validateName($name)
    {
        /* Validate the name of the spark */
        if(is_string($name))
        {
            throw new SpecificationException("The name of the specification must be a string: {$name}");
        }

        if(strlen($name) == 0)
        {
            throw new SpecificationException("The name of this spark must be greater than 1 character long: {$name}");
        }
    }

    /**
     * Validate dependency information
     * @throws SpecificationException
     * @param array $dependencies
     */
    private function _validateDependencies($dependencies)
    {
        /* Validate the dependencies */
        if(!is_array($dependencies))
        {
            throw new SpecificationException("The dependency information should be an array.");
        }

        foreach($dependencies as $d)
        {
            if(!is_array($d))
            {
                throw new SpecificationException("Each dependency in the dependency array should be described as an array.");
            }

            if(count($d) != 2)
            {
                throw new SpecificationException("Each dependency in the dependency array should consist of 2 elements: name and version");
            }

            $this->_validateName($d[0]);

            $this->_validateVersion($d[1]);
        }
    }
}

/**
 * An exception class for Spark validation exceptions
 */
class SpecificationException extends Exception { }