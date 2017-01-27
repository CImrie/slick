<?php


namespace CImrie\Slick\Builders\Traits;


trait FieldAliases
{
    public function binary($name)
    {
        return $this->field($name)->type('bin');
    }

    public function binaryByteArray($name)
    {
        return $this->field($name)->type('bin_bytearray');
    }

    public function binaryCustom($name)
    {
        return $this->field($name)->type('bin_custom');
    }

    public function md5($name)
    {
        return $this->field($name)->type('bin_md5');
    }

    public function uuid($name)
    {
        return $this->field($name)->type('bin_uuid');
    }

    public function boolean($name)
    {
        return $this->field($name)->type('boolean');
    }

    public function collection($name)
    {
        return $this->field($name)->type('collection');
    }

    public function customId($name)
    {
        return $this->field($name)->type('custom_id');
    }

    public function date($name)
    {
        return $this->field($name)->type('date');
    }

    public function file($name)
    {
        return $this->field($name)->type('file');
    }

    public function float($name)
    {
        return $this->field($name)->type('float');
    }

    public function hashMap($name)
    {
        return $this->field($name)->type('hash');
    }

    public function id($name)
    {
        return $this->field($name)->type('id')->strategy('INCREMENT');
    }

    public function integer($name)
    {
        return $this->field($name)->type('int');
    }

    public function key($name)
    {
        return $this->field($name)->type('key');
    }

    public function objectId($name)
    {
        return $this->field($name)->type('object_id');
    }

    public function raw($name)
    {
        return $this->field($name)->type('raw');
    }

    public function string($name)
    {
        return $this->field($name)->type('string');
    }

    public function timestamp($name)
    {
        return $this->field($name)->type('timestamp');
    }
}