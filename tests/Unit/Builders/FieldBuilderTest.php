<?php


namespace Tests\Unit\Builders;



use CImrie\ODM\Mapping\ClassMetadataBuilder;
use CImrie\Slick\Builders\FieldBuilder;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use Tests\Model\Documents\User;
use Tests\TestCase;

class FieldBuilderTest extends TestCase
{
    /**
     * @var ClassMetadata
     */
    protected $metadataBuilder;

    /**
     * @var FieldBuilder
     */
    protected $builder;

    protected function setUp()
    {
        parent::setUp();
        $this->metadataBuilder = new ClassMetadataBuilder(
            new ClassMetadata(User::class)
        );

        $this->builder = new FieldBuilder($this->metadataBuilder);
        $this->builder->field('name');
    }

    /**
     * @test
     */
    public function can_add_field_mapping()
    {
        $this->assertEquals('name', $this->metadata()->fieldMappings['name']['fieldName']);
    }

    /**
     * @test
     */
    public function can_set_type()
    {
        $this->assertBuilder($this->builder->type('string'));
        $this->assertEquals('string', $this->metadata()->fieldMappings['name']['type']);
    }

    /**
     * @test
     */
    public function can_set_nullable()
    {
        $this->assertBuilder($this->builder->nullable());
        $this->assertTrue($this->metadata()->fieldMappings['name']['nullable']);
    }

    /**
     * @test
     */
    public function can_set_strategy()
    {
        $this->assertBuilder($this->builder->strategy('none'));
        $this->assertEquals('none', $this->metadata()->fieldMappings['name']['strategy']);
    }

    /**
     * @test
     */
    public function can_set_column_name_in_database()
    {
        $this->assertBuilder($this->builder->column('test_name'));
        $this->assertEquals('test_name', $this->metadata()->fieldMappings['name']['name']);
    }

    /**
     * @test
     */
    public function can_set_fallback_also_load_columns_from_database()
    {
        $this->assertBuilder($this->builder
            ->alsoLoad('fullName')
            ->alsoLoad('facebookName')
        );

        $this->assertEquals(['fullName', 'facebookName'], $this->metadata()->fieldMappings['name']['alsoLoadFields']);
    }

    /**
     * @test
     */
    public function can_set_to_read_only()
    {
        $this->assertBuilder($this->builder->readOnly());
        $this->assertEquals(true, $this->metadata()->fieldMappings['name']['notSaved']);
    }

}