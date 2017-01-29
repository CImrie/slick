<?php


namespace Tests\Unit\Mapping;


use CImrie\Slick\Mapping\SlickDriver;
use Doctrine\Common\Persistence\Mapping\ClassMetadata;
use Mockery as m;

class SlickDriverTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SlickDriver
     */
    protected $driver;

    protected function setUp()
    {
        parent::setUp();
        $this->driver = new SlickDriver();
    }

    /**
     * @test
     */
    public function can_set_builder_factory()
    {
        $builder = function(){return 'hello';};
        $this->driver->setBuilderFactory($builder);


        $builtResult = $this->driver->getBuilder(m::mock(ClassMetadata::class));
        $this->assertEquals('hello', $builtResult);
    }
}