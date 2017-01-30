<?php


namespace CImrie\Slick\Builders;


use CImrie\ODM\Mapping\ClassMetadataBuilder;
use CImrie\ODM\Mapping\Field;
use CImrie\ODM\Mapping\Index;
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
    protected $isUnique = false;

    public function __construct(ClassMetadataBuilder $metadataBuilder)
    {
        parent::__construct($metadataBuilder);
        $this->field = new Field();
    }

    /**
     * @param $name
     * @return $this
     */
    public function field($name)
    {
        $this->field->name($name);
        $this->fieldName = $name;

        return $this;
    }

    /**
     * @return $this
     * @throws \Exception
     */
    public function identifier()
    {
        if(!$this->fieldName)
        {
            throw new \Exception("No field name is set on Field mapping, yet you have tried to set it as the identifier. Make sure to set the field name before making it an ID field.");
        }

        $this->isIdentifier = true;

        return $this;
    }

    /**
     * @param $type
     * @return $this
     */
    public function type($type)
    {
        $this->field->type($type);

        return $this;
    }

    /**
     * @return $this
     */
    public function nullable()
    {
        $this->field->nullable(true);

        return $this;
    }

    /**
     * @param $strategy
     * @return $this
     */
    public function strategy($strategy)
    {
        $this->field->strategy($strategy);

        return $this;
    }

    /**
     * @param $name
     * @return $this
     */
    public function column($name)
    {
        $this->field->columnName($name);

        return $this;
    }

    /**
     * @param $property
     * @return $this
     */
    public function alsoLoad($property)
    {
        $this->field->alsoLoad($property);

        return $this;
    }

    /**
     * @return $this
     */
    public function doNotSave()
    {
        $this->field->dontSave(true);

        return $this;
    }

    /**
     * @return $this
     */
    public function readOnly()
    {
        $this->doNotSave();

        return $this;
    }

    /**
     * @return $this
     */
    public function unique()
    {
        $this->isUnique = true;

        return $this;
    }

    /**
     * @return ClassMetadataBuilder
     */
    public function build()
    {
        $this->metadataBuilder->addField($this->field);

        if($this->isIdentifier)
        {
            $this->metadataBuilder->getClassMetadata()->setIdentifier($this->fieldName);
            $this->strategy('AUTO');
        }

        if($this->isUnique)
        {
            $this->metadataBuilder->getClassMetadata()->addIndex(
                (new Index())
                    ->key($this->fieldName)
                    ->asArray()
            );
        }

        return $this->metadataBuilder;
    }
}