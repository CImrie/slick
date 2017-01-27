<?php


namespace CImrie\Slick\Builders;


use CImrie\ODM\Mapping\ClassMetadataBuilder;
use CImrie\ODM\Mapping\Field;

class FieldBuilder extends AbstractBuilder
{
    /**
     * @var string
     */
    protected $fieldName;

    /**
     * @var Field
     */
    protected $field;

    public function __construct(ClassMetadataBuilder $metadataBuilder)
    {
        parent::__construct($metadataBuilder);
        $this->field = new Field();
    }

    public function field($name)
    {
        $this->field->name($name);
        $this->fieldName = $name;
        $this->updateMapping();

        return $this;
    }

    public function type($type)
    {
        $this->field->type($type);
        $this->updateMapping();

        return $this;
    }

    public function nullable()
    {
        $this->field->nullable(true);
        $this->updateMapping();

        return $this;
    }

    public function strategy($strategy)
    {
        $this->field->strategy($strategy);
        $this->updateMapping();

        return $this;
    }

    public function column($name)
    {
        $this->field->columnName($name);
        $this->updateMapping();

        return $this;
    }

    public function alsoLoad($property)
    {
        $this->field->alsoLoad($property);
        $this->updateMapping();

        return $this;
    }

    public function doNotSave()
    {
        $this->field->dontSave(true);
        $this->updateMapping();

        return $this;
    }

    public function readOnly()
    {
        $this->doNotSave();

        return $this;
    }

    private function updateMapping()
    {
        $this->metadataBuilder->getClassMetadata()->fieldMappings[$this->fieldName] = $this->field->asArray();

        return $this;
    }
}