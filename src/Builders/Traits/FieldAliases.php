<?php


namespace CImrie\Slick\Builders\Traits;
use CImrie\Slick\Builders\FieldBuilder;

/**
 * Class FieldAliases
 * @package CImrie\Slick\Builders\Traits
 * @method FieldBuilder field(string $name)
 * @method FieldBuilder type(string $type)
 */
trait FieldAliases
{
    /**
     * @param $name
     * @return FieldBuilder
     */
    public function binary($name)
    {
        return $this->field($name)->type('bin');
    }

    /**
     * @param $name
     * @return FieldBuilder
     */
    public function binaryByteArray($name)
    {
        return $this->field($name)->type('bin_bytearray');
    }

    /**
     * @param $name
     * @return FieldBuilder
     */
    public function binaryCustom($name)
    {
        return $this->field($name)->type('bin_custom');
    }

    /**
     * @param $name
     * @return FieldBuilder
     */
    public function md5($name)
    {
        return $this->field($name)->type('bin_md5');
    }

    /**
     * @param $name
     * @return FieldBuilder
     */
    public function uuid($name)
    {
        return $this->field($name)->type('bin_uuid');
    }

    /**
     * @param $name
     * @return FieldBuilder
     */
    public function boolean($name)
    {
        return $this->field($name)->type('boolean');
    }

    /**
     * @param $name
     * @return FieldBuilder
     */
    public function collection($name)
    {
        return $this->field($name)->type('collection');
    }

    /**
     * @param $name
     * @return FieldBuilder
     */
    public function customId($name)
    {
        return $this->field($name)->type('custom_id');
    }

    /**
     * @param $name
     * @return FieldBuilder
     */
    public function date($name)
    {
        return $this->field($name)->type('date');
    }

    /**
     * @param $name
     * @return FieldBuilder
     */
    public function file($name)
    {
        return $this->field($name)->type('file');
    }

    /**
     * @param $name
     * @return FieldBuilder
     */
    public function float($name)
    {
        return $this->field($name)->type('float');
    }

    /**
     * @param $name
     * @return FieldBuilder
     */
    public function hashMap($name)
    {
        return $this->field($name)->type('hash');
    }

    /**
     * @param $name
     * @return FieldBuilder
     */
    public function id($name = 'id')
    {
        return $this->field($name)->type('id')->column('_id')->identifier();
    }

    /**
     * @param $name
     * @return FieldBuilder
     */
    public function integer($name)
    {
        return $this->field($name)->type('int');
    }

    /**
     * @param $name
     * @return FieldBuilder
     */
    public function key($name)
    {
        return $this->field($name)->type('key');
    }

    /**
     * @param $name
     * @return FieldBuilder
     */
    public function objectId($name)
    {
        return $this->field($name)->type('object_id');
    }

    /**
     * @param $name
     * @return FieldBuilder
     */
    public function raw($name)
    {
        return $this->field($name)->type('raw');
    }

    /**
     * @param $name
     * @return FieldBuilder
     */
    public function string($name)
    {
        return $this->field($name)->type('string');
    }

    /**
     * @param $name
     * @return FieldBuilder
     */
    public function timestamp($name)
    {
        return $this->field($name)->type('timestamp');
    }

    /**
     * @param $name
     * @param $arguments
     * @return FieldBuilder
     */
    public function __call($name, $arguments)
    {
        // get the types it could be
        //if the argument count is 1, call $this->field(arg1)->type($method);

        if(count($arguments) === 1)
        {
            return $this->field($arguments[0])->type($name);
        }
    }
}