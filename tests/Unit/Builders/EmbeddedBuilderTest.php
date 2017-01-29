<?php


namespace Tests\Unit\Builders;


use CImrie\ODM\Mapping\ClassMetadataBuilder;
use CImrie\Slick\Builders\EmbedBuilder;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use Tests\Model\Documents\User;
use Tests\TestCase;

class EmbeddedBuilderTest extends TestCase
{
    /**
     * @var EmbedBuilder
     */
    protected $builder;

    protected function setUp()
    {
        parent::setUp();
        $this->metadataBuilder = new ClassMetadataBuilder(
            new ClassMetadata(User::class)
        );
        $this->builder = new EmbedBuilder($this->metadataBuilder);
    }

    /**
     * @test
     */
    public function can_embed_one_document()
    {
        $this->builder
            ->one(User::class)
            ->field('user')
            ->discriminate('type')
                ->with(['user' => User::class])
                ->setDefault('test')
            ;

        $this->builder->build();

        $this->assertEquals(User::class, $this->metadata()->fieldMappings['user']['targetDocument']);
        $this->assertEquals('type', $this->metadata()->fieldMappings['user']['discriminatorField']);
        $this->assertEquals(['user' => User::class], $this->metadata()->fieldMappings['user']['discriminatorMap']);
        $this->assertEquals('test', $this->metadata()->fieldMappings['user']['defaultDiscriminatorValue']);
    }

    /**
     * @test
     */
    public function can_embed_many_documents()
    {
        $this->builder->many(User::class)
            ->field('users');

        $this->builder->build();

        $this->assertEquals(User::class, $this->metadata()->fieldMappings['users']['targetDocument']);
    }
}