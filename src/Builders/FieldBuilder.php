<?php


namespace CImrie\Slick\Builders;


use CImrie\ODM\Mapping\ClassMetadataBuilder;
use CImrie\ODM\Mapping\Field;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadataInfo;

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
    protected $isIdentifier = false;

    public function __construct(ClassMetadataBuilder $metadataBuilder)
    {
        parent::__construct($metadataBuilder);
        $this->field = new Field();
    }

    public function field($name)
    {
        $this->field->name($name);
        $this->fieldName = $name;

        return $this;
    }

    public function identifier()
    {
        if(!$this->fieldName)
        {
            throw new \Exception("No field name is set on Field mapping, yet you have tried to set it as the identifier. Make sure to set the field name before making it an ID field.");
        }

        $this->isIdentifier = true;

        return $this;
    }

    public function type($type)
    {
        $this->field->type($type);

        return $this;
    }

    public function nullable()
    {
        $this->field->nullable(true);

        return $this;
    }

    public function strategy($strategy)
    {
        $this->field->strategy($strategy);

        return $this;
    }

    public function column($name)
    {
        $this->field->columnName($name);

        return $this;
    }

    public function alsoLoad($property)
    {
        $this->field->alsoLoad($property);

        return $this;
    }

    public function doNotSave()
    {
        $this->field->dontSave(true);

        return $this;
    }

    public function readOnly()
    {
        $this->doNotSave();

        return $this;
    }

    public function build()
    {
        $this->metadataBuilder->addField($this->field);

        if($this->isIdentifier)
        {
            $this->metadataBuilder->getClassMetadata()->setIdentifier($this->fieldName);
            $this->strategy('AUTO');
        }

        return $this->metadataBuilder;
    }
}