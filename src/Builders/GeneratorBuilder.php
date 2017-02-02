<?php


namespace CImrie\Slick\Builders;


use CImrie\ODM\Mapping\Generators\AlphaNumeric;
use CImrie\ODM\Mapping\Generators\Auto;
use CImrie\ODM\Mapping\Generators\Custom;
use CImrie\ODM\Mapping\Generators\Generator;
use CImrie\ODM\Mapping\Generators\Increment;
use CImrie\ODM\Mapping\Generators\Uuid;
use Doctrine\ODM\MongoDB\Id\AbstractIdGenerator;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;

class GeneratorBuilder implements Generator
{
    /**
     * @var Generator
     */
    protected $generator;

    public function __construct()
    {
        $this->auto();
    }

    public function auto()
    {
        $this->generator = new Auto();
        return $this->generator;
    }

    public function increment()
    {
        $this->generator = new Increment();
        return $this->generator;
    }

    public function uuid()
    {
        $this->generator = new Uuid();
        return $this->generator;
    }

    public function alphaNumeric()
    {
        $this->generator = new AlphaNumeric();
        return $this->generator;
    }

    public function custom(AbstractIdGenerator $generator)
    {
        $this->generator = new Custom($generator);
        return $this->generator;
    }

    public function commit(ClassMetadata $classMetadata)
    {
        return $this->generator->commit($classMetadata);
    }
}