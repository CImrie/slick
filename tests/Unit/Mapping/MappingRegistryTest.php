<?php


namespace Tests\Unit\Mapping;


use CImrie\Odm\Tests\Unit\Repositories\CallOnce;
use CImrie\Slick\Mapping\DocumentMapping;
use CImrie\Slick\Mapping\Registry;
use CImrie\Slick\Slick;
use Mockery as m;

class MappingRegistryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function can_set_default_resolver()
    {
        $callOnce = m::mock(CallOnce::class);
        $callOnce->shouldReceive('yep')->once();

        $registry = new Registry(function() use ($callOnce) { $callOnce->yep(); });

        $mappingClass = Dummy::class;

        $registry->get($mappingClass);
    }

    /**
     * @test
     */
    public function can_add_a_resolver_for_a_mapping_class()
    {
        $registry = new Registry();
        $registry->addResolver(Dummy::class, $callback = function() { return 'hello'; });

        $this->assertEquals($callback, $registry->getResolver(Dummy::class));
    }

    /**
     * @test
     */
    public function can_resolve_from_a_specifically_set_resolver()
    {
        $registry = new Registry();
        $registry->addResolver(Dummy::class, $callback = function() { return 'hello'; });

        $this->assertEquals('hello', $one = $registry->get(Dummy::class));
        $this->assertEquals('hello', $two = $registry->get(Dummy::class)); // assert again as should pull same mapping instance
        $this->assertEquals($one, $two);
    }

    /**
     * @test
     */
    public function no_resolvers_set_at_start()
    {
        $registry = new Registry();
        $this->assertNull($registry->getResolver(Dummy::class));
    }

    /**
     * @test
     */
    public function call_class_constructor_and_get_mapping_file_even_without_resolver()
    {
        $registry = new Registry();

        $this->assertInstanceOf(Dummy::class, $registry->get(Dummy::class));
    }

    protected function tearDown()
    {
        parent::tearDown();
        m::close();
    }
}

class DummyDoc {}

class Dummy extends DocumentMapping {
    public static function mapFor()
    {
        return DummyDoc::class;
    }

    public function map(Slick $builder)
    {
        // TODO: Implement map() method.
    }

}