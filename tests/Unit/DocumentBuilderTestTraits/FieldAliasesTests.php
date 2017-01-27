<?php


namespace Tests\Unit\DocumentBuilderTestTraits;


trait FieldAliasesTests
{
    /**
     * @test
     */
    public function can_set_aliases()
    {
        $this->runTypeTest('binary', 'bin');
        $this->runTypeTest('binaryByteArray', 'bin_bytearray');
        $this->runTypeTest('binaryCustom', 'bin_custom');
        $this->runTypeTest('md5', 'bin_md5');
        $this->runTypeTest('uuid', 'bin_uuid');
        $this->runTypeTest('boolean', 'boolean');
        $this->runTypeTest('collection', 'collection');
        $this->runTypeTest('customId', 'custom_id');
        $this->runTypeTest('date', 'date');
        $this->runTypeTest('file', 'file');
        $this->runTypeTest('float', 'float');
        $this->runTypeTest('hashMap', 'hash');
        $this->runTypeTest('id', 'id');
        $this->runTypeTest('integer', 'int');
        $this->runTypeTest('key', 'key');
        $this->runTypeTest('objectId', 'object_id');
        $this->runTypeTest('raw', 'raw');
        $this->runTypeTest('string', 'string');
        $this->runTypeTest('timestamp', 'timestamp');
    }

    /**
     * @test
     */
    public function id_auto_increments()
    {
        $this->runTypeTest('id', 'id');
        $this->assertEquals('INCREMENT', $this->metadata()->fieldMappings['custom']['strategy']);
    }

    private function runTypeTest($method, $type)
    {
        $this->assertBuilder($this->builder->{$method}('custom'));
        $this->assertType($type);
    }

    private function assertType($type)
    {
        $this->assertEquals($type, $this->metadata()->fieldMappings['custom']['type']);
    }
}