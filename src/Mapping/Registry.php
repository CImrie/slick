<?php


namespace CImrie\Slick\Mapping;


class Registry
{
    protected $mappings = [];

    protected $defaultResolver;

    protected $resolvers = [];

    public function __construct(\Closure $defaultMappingResolver = null)
    {
        $this->defaultResolver = $defaultMappingResolver;
    }

    public function addResolver($class, \Closure $resolver)
    {
        $this->resolvers[$class] = $resolver;

        return $this;
    }

    public function getResolver($class)
    {
        if(isset($this->resolvers[$class]))
        {
            return $this->resolvers[$class];
        }

        return null;
    }

    protected function resolve($class)
    {
        if(isset($this->resolvers[$class]))
        {
            $resolver = $this->resolvers[$class];
            $mapping = $resolver($class);
            $this->mappings[$class] = $mapping;

            return $this->mappings[$class];
        }

        if($this->defaultResolver)
        {
            $resolver = $this->defaultResolver;
            $mapping = $resolver($class);
            $this->mappings[$class] = $mapping;

            return $this->mappings[$class];
        }

        return null;
    }

    protected function getOrResolveMapping($class)
    {
        if(isset($this->mappings[$class]))
        {
            return $this->mappings[$class];
        }

        return $this->resolve($class);
    }

    public function get($class)
    {
        if($mapping = $this->getOrResolveMapping($class))
        {
            return $mapping;
        }

        return new $class();
    }
}