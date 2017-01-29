<?php


namespace CImrie\Slick\Builders;


use CImrie\ODM\Mapping\ClassMetadataBuilder;

interface Builder
{
    public function __construct(ClassMetadataBuilder $metadataBuilder);
    public function build();
}